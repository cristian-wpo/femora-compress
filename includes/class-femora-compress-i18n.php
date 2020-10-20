<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.femora.pro
 * @since     0.9.5
 *
 * @package    Femora_compress
 * @subpackage Femora_Compress/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since     0.9.5
 * @package    Femora_compress
 * @subpackage Femora_Compress/includes
 * @author     Cristian Angel Sanchez Gutierrez <cristian246@gmail.com>
 */
class Femora_Compress_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since   0.9.5
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'femora-compress',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
