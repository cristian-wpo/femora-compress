<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $wpdb;
//recibo el arreglo con las imagenes
// Good idea to make sure things are set before using them
$imagenes_volcar = isset($_POST['listarespaldo']) ? (array) $_POST['listarespaldo'] : array();

// Any of the WordPress data sanitization functions can be used here
$imagenes_volcar = array_map('esc_attr', $imagenes_volcar);

$tablename = FEMORA_COMPRESS_DB_PREFIX . 'femora_pending_images';

$consulta = '';
$ult_valor = '';
//process all backup, necessary
foreach ($imagenes_volcar as $valor) {
    //si el id es un número y mayor que 0 lo asigno en la consulta
    //echo $valor;
    if ($valor > 0){
        $consulta .= trim(explode('_', $valor)[0]) . ' OR `id` = ';
        //echo explode('_', $valor)[0] . ' OR `id` = ';
        $ult_valor = trim(explode('_', $valor)[0]);
    }
        
}

//preparo y envío la consulta para obtener las imágenes en la base de datos
$consulta = trim($consulta, ' OR `id` = ');
print_r($consulta);
$arreglo_imagenes = $wpdb->get_results("SELECT * FROM `$tablename` WHERE `id` = $consulta");

$consulta = '';
//una vez con la lista de las imágenes preparo la consulta para asignarlas a no optimizadas y mover el respaldo a su posición original
foreach ($arreglo_imagenes as $valor) {
    if (file_exists(FEMORA_COMPRESS_UPLOAD_PATH . '/femora_respaldo/' . $valor->id . '_femora_respaldo_.' . formato_imagen($valor->path))) {
        if (copy(FEMORA_COMPRESS_UPLOAD_PATH . '/femora_respaldo/' . $valor->id . '_femora_respaldo_.' . formato_imagen($valor->path), $valor->path)) {
            // echo 'respaldo recuperado... ';
        }
    }
    $id = $valor->id;
    $consulta .= "`$tablename`.`id` = '$id' OR ";
}

$consulta = trim($consulta, ' OR ');
$wpdb->query("UPDATE `$tablename` SET `compressed_size` = '0', `optimized` = '' WHERE $consulta");

function formato_imagen($imagen){
    $formatoimagen = explode('.', strtoupper($imagen));
    //Devuelve el formato de la imagen
    return $formatoimagen[count($formatoimagen) - 1];
}
