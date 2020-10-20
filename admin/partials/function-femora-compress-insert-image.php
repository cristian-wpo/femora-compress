<?php
$f_ruta_imagen = $_POST['femora_imagen'];
$f_ruta_imagen_decode = json_decode(json_encode($f_ruta_imagen, true));
$imagenes = '';
/*
 * Agregar todas las imagenes en una cadena para hacer un solo insert MySQL
 */
 $datos = [];
	//if (get_bloginfo('version') == '5.0.8'){
		foreach ($f_ruta_imagen_decode as $valor) {
			$tamano = filesize($valor);
			$fecha = gmdate('Y-m-d h:i:s \G\M\T', time());
			
			$datos[] = array(
				'date' => $fecha,
				'path' => $valor,
				'size' => $tamano
			);
			
		}

	femora_agregar_img_db_array($datos, $wpdb);
	
	
	function femora_agregar_img_db_array($imagenes, $wpdb) {
		try {
			$tablename = $wpdb->prefix . 'femora_pending_images';
			foreach ( $imagenes as $femora )
				$wpdb->insert( $tablename, $femora );
		} catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}
	
//agrego (-separador-) como solución temporal a los eventos de error que regresa la base de datos al no agregar duplicados
	if ($_POST['femora_imagen']) {
		echo '(-separador-)1';
	} else {
		echo '(-separador-)0';
	}
die();
