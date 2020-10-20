<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.femora.pro
 * @since     0.9.5
 *
 * @package    Femora_compress
 * @subpackage femora_compress/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since     0.9.5
 * @package    Femora_compress
 * @subpackage femora_compress/includes
 * @author     Cristian A. Sanchez G. <cristian246@gmail.com>
 */
class Femora_compress
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since   0.9.5
	 * @access   protected
	 * @var      Femora_compress_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since   0.9.5
	 * @access   protected
	 * @var      string    $femora_compress    The string used to uniquely identify this plugin.
	 */
	protected $femora_compress;

	/**
	 * The current version of the plugin.
	 *
	 * @since   0.9.5
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since   0.9.5
	 */
	public function __construct()
	{
		if (defined('FEMORA_COMPRESS_VERSION')) {
			$this->version = FEMORA_COMPRESS_VERSION;
		} else {
			$this->version = '0.9.5';
		}
		$this->femora_compress = 'femora-compress';

		$this->load_dependencies();
		//$this->set_locale();
		$this->define_admin_hooks();
		//$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Femora_Compress_Loader. Orchestrates the hooks of the plugin.
	 * - Femora_Compress_i18n. Defines internationalization functionality.
	 * - Femora_Compress_Admin. Defines all hooks for the admin area.
	 * - Femora_Compress_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since   0.9.5
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-femora-compress-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-femora-compress-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-femora-compress-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-femora-compress-public.php';

		$this->loader = new Femora_Compress_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Femora_Compress_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since   0.9.5
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Femora_Compress_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since   0.9.5
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$femora_admin = new Femora_Compress_Admin($this->get_femora_compress(), $this->get_version());

		$this->loader->add_action("admin_head", $femora_admin, "femora_compress_favicon");
		$this->loader->add_action('admin_enqueue_scripts', $femora_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $femora_admin, 'enqueue_scripts');
		$this->loader->add_action("admin_menu", $femora_admin, "crear_menu_femora_compress");
		
		//add functions
		$this->loader->add_action("wp_ajax_fill_table", $femora_admin, "fill_table");
		$this->loader->add_action("wp_ajax_statistics", $femora_admin, "statistics");
		$this->loader->add_action("wp_ajax_femora_setting", $femora_admin, "femora_setting");
		$this->loader->add_action("wp_ajax_get_backup_list", $femora_admin, "get_backup_list");
		$this->loader->add_action("wp_ajax_dump_backup", $femora_admin, "dump_backup");
		$this->loader->add_action("wp_ajax_send_data", $femora_admin, "send_data");
		$this->loader->add_action("wp_ajax_femora_optimize", $femora_admin, "femora_optimize");
		$this->loader->add_action("wp_ajax_search", $femora_admin, "search");
		$this->loader->add_action("wp_ajax_insert_img", $femora_admin, "insert_img");

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since   0.9.5
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Femora_Compress_Public($this->get_femora_compress(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since   0.9.5
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since    0.9.5
	 * @return    string    The name of the plugin.
	 */
	public function get_femora_compress()
	{
		return $this->femora_compress;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since    0.9.5
	 * @return    Femora_Compress_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since    0.9.5
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
