<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.femora.pro
 * @since     0.9.5
 *
 * @package    Femora_compress
 * @subpackage Femora_Compress/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since     0.9.5
 * @package    Femora_compress
 * @subpackage Femora_Compress/includes
 * @author     Cristian Angel Sanchez Gutierrez <cristian246@gmail.com>
 */
class Femora_Compress_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since   0.9.5
	 */
	public static function activate() {
		$cont = ob_get_contents();
		if (!empty($cont))
			file_put_contents(temp_file, $cont);
	}

}
