<?php

/*
 * Clase para llenar la tabla Femora en el administrador con los datos correspondientes
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sistemao_femora()
{
    if (substr_count(strtoupper(php_uname()), 'WINDOWS') > 0)
        return true;
    return false;
}

if (sistemao_femora()) {
    $ruta = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']);
} else {
    $ruta = $_SERVER['DOCUMENT_ROOT'];
}

$request = $_REQUEST;
global $wpdb;

$pathrespaldo = FEMORA_COMPRESS_UPLOAD_URL . '/femora_respaldo/';
$tablename = $wpdb->prefix . 'femora_pending_images';
$all_imgfemora_data = $wpdb->get_results("SELECT * FROM `$tablename` ORDER BY `$tablename`.`size` DESC");
$totalData = $wpdb->num_rows;

$data = array();
$totalfid = array();
foreach ($all_imgfemora_data as $femora_imagenes) {
    $data_img = $femora_imagenes;
    $totalfid = $data_img->id;
    $path = $data_img->path;
    $size = $data_img->size;
    $compressed_size = $data_img->compressed_size;
    $optimized = $data_img->optimized;
    $webp = $data_img->webp;
    $formato = explode('.', wp_basename($path))[count(explode('.', wp_basename($path))) - 1];

    $sub_array = array();
    $sub_array[] = $totalfid;
    $imagen1url = get_url_imagen($ruta, $path);
    $sub_array[] = '<a target="_blank" href="' . $imagen1url . '">' . $imagen1url . '</a>'; // Aca se debe enviar la URL Completa
    $sub_array[] = $formato;
    $sub_array[] = $this->formatSizeUnits($size);
    if ($compressed_size > 0) {
        $pathrespaldocomplemento = "_femora_respaldo_." . formato_imagen($imagen1url);
        $imagenrespaldo = $pathrespaldo . $totalfid . $pathrespaldocomplemento;
        $sub_array[] = $this->formatSizeUnits($compressed_size);
        if ($webp == 0) {
            $sub_array[] = '<p><a href="#ex1" rel="modal:open" onclick="femoracomparador(' . "'$imagen1url'" . ",'$imagenrespaldo'" . ')">Compare</a></p>';
        } else {
            $imagen1url = str_ireplace('.' . formato_imagen($imagen1url), '.webp', $imagen1url);
            $sub_array[] = '<p><a href="#ex1" rel="modal:open" onclick="femoracomparador(' . "'$imagen1url'" . ",'$imagenrespaldo'" . ')">Compare</a></p>';
        }
        $sub_array[] = number_format((($size - $compressed_size) / $size) * 100, 2, ',', ' ') . "%";
    } else {
        $sub_array[] = 'Not Optimized';
        $sub_array[] = 'Optimize';
        $sub_array[] = '0%';
    }

    $data[] = $sub_array;
}

$json_data = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalData),
    "data" => $data
);

echo json_encode($json_data);
wp_die(); //to remove that 0 response

function formato_imagen($imagen)
{
    //Devuelve el formato de la imagen
    $formatoimagen = explode('.', strtoupper($imagen));
    return $formatoimagen[count($formatoimagen) - 1];
}

function get_url_imagen($ruta, $path){
    $path =  str_replace(str_replace('\\','\\\\',$ruta), '', $path);
    $path =  str_replace($ruta, '', $path);
    $imagen = '//' . str_replace('\\', '/', $_SERVER['SERVER_NAME'] . str_replace($ruta, '', $path)) . '';
    return $imagen;
}

