<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.femora.pro/
 * @since             0.9.5
 * @package           Femora_compress
 *
 * @wordpress-plugin
 * Plugin Name:       Femora Compress
 * Plugin URI:        https://www.femora.pro/
 * Description:       Super compresses JPG and PNG images with the best quality for the web and the smallest size
 * Version:           0.9.5
 * Author:            FemoraPro
 * Author URI:        https://www.wpospeed.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       femora-compress
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.9.5 and use SemVer - https://semver.org
 */
define('FEMORA_COMPRESS_VERSION', '0.9.6');
define('FEMORA_COMPRESS_PATH', plugin_dir_path(__FILE__));
define('FEMORA_COMPRESS_UPLOAD_PATH', wp_upload_dir()['basedir']);
define('FEMORA_COMPRESS_UPLOAD_URL', wp_upload_dir()['baseurl']);
define('FEMORA_COMPRESS_SITE_URL', get_site_url());
define('FEMORA_COMPRESS_DIR_URL', plugin_dir_url(__FILE__));
define('FEMORA_COMPRESS_DOMINIO', get_site_url());
define('FEMORA_COMPRESS_DB_PREFIX', $wpdb->prefix);

require_once(FEMORA_COMPRESS_PATH . 'admin/db-femora.php');
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/femora-compress-activator.php
 */
function activate_femora_compress()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-femora-compress-activator.php';
	Femora_Compress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/femora-compress-deactivator.php
 */
function deactivate_femora_compress()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-femora-compress-deactivator.php';
	Femora_Compress_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_femora_compress');
register_deactivation_hook(__FILE__, 'deactivate_femora_compress');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-femora-compress.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.9.5
 */
function run_femora_compress()
{

	$plugin = new Femora_compress();
	$plugin->run();
}
run_femora_compress();
