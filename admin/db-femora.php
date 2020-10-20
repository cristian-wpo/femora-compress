<?php

/*
 * Crear la base de datos
 */

/*
  Copyright (C) 2019 Cristian Angel Sanchez Gutierrez

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

if (!defined('ABSPATH')) {
    exit;
}
/*
 * Declaración de variables
 */

//function crear_tablas_db_femora() {
    global $wpdb;
    //define('FEMORA_COMPRESS_DB_PREFIX', $wpdb->prefix);
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
    $table1 = FEMORA_COMPRESS_DB_PREFIX . 'femora_pending_images';
    $wpdb_collate_femora = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table1 (
	id int AUTO_INCREMENT,
	date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
	path varchar(180) NOT NULL,
	size int UNSIGNED DEFAULT '0' NOT NULL,
	compressed_size int UNSIGNED DEFAULT '0' NOT NULL,
	optimized text NOT NULL,
        webp int(1) NOT NULL,
        PRIMARY  KEY  (id),
        UNIQUE KEY path (path)    
	)$wpdb_collate_femora;";


    $table = FEMORA_COMPRESS_DB_PREFIX . 'femora_usage_statistics';
    $sql .= "CREATE TABLE $table (
	id int AUTO_INCREMENT,
	start_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
	qty_images int DEFAULT '0' NOT NULL,
	original_size decimal(18, 2) UNSIGNED DEFAULT '0.00' NOT NULL,
	compressed_size decimal(18, 2) UNSIGNED DEFAULT '0.00' NOT NULL,
	end_date datetime DEFAULT CURRENT_TIMESTAMP     NOT NULL,
        PRIMARY  KEY  (id)
	)$wpdb_collate_femora;";

//foreach ($sql as $valor) {
    //creamos la tabla
    dbDelta($sql);
//}

    //$wpdb->query("ALTER TABLE `$table1` ADD UNIQUE KEY `path` (`path`)");
//}
