<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.femora.pro
 * @since     0.9.5
 *
 * @package    Femora_compress
 * @subpackage Femora_Compress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Femora_compress
 * @subpackage Femora_Compress/admin
 * @author     Cristian Angel Sanchez Gutierrez <cristian246@gmail.com>
 */
class Femora_Compress_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since   0.9.5
	 * @access   private
	 * @var      string    $femora_compress    The ID of this plugin.
	 */
	private $femora_compress;

	/**
	 * The version of this plugin.
	 *
	 * @since   0.9.5
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   0.9.5
	 * @param      string    $femora_compress       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($femora_compress, $version)
	{

		$this->femora_compress = $femora_compress;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since   0.9.5
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in femora_compress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Femora_Compress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_style($this->femora_compress . '_datatables', plugin_dir_url(__FILE__) . 'libraries/css/datatables.css');
		wp_enqueue_style($this->femora_compress . '_datatables');
		wp_register_style($this->femora_compress . '_datatables', plugin_dir_url(__FILE__) . 'libraries/css/jquery.dataTables.css');
		wp_enqueue_style($this->femora_compress . '_datatables');

		//CSS to modal
		wp_register_style($this->femora_compress . '_modal', plugin_dir_url(__FILE__) . 'libraries/css/jquery.modal.min.css');
		wp_enqueue_style($this->femora_compress . '_modal');
		//CSS to comparator 
		wp_register_style($this->femora_compress . '_twentytwenty', plugin_dir_url(__FILE__) . 'libraries/comparador/css/twentytwenty.css');
		wp_enqueue_style($this->femora_compress . '_twentytwenty');

		//CSS Plugins Femora Compress
		wp_enqueue_style($this->femora_compress, plugin_dir_url(__FILE__) . 'css/femora-compress-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since   0.9.5
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Femora_Compress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Femora_Compress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script($this->femora_compress . '-datatables', plugin_dir_url(__FILE__) . 'libraries/js/datatables.js', array('jquery'), '1.10.18', true);
		wp_enqueue_script($this->femora_compress . '-datatables');

		wp_register_script($this->femora_compress, plugin_dir_url(__FILE__) . 'js/femora-compress-admin.js', array('jquery'), $this->version, true);
		wp_localize_script($this->femora_compress, 'femora_ajax', array('fill_table' => admin_url('admin-ajax.php?action=fill_table')));
		wp_localize_script($this->femora_compress, 'femora_utiliti', array('femora_setting' => admin_url('admin-ajax.php?action=femora_setting')));
		wp_localize_script($this->femora_compress, 'femora_backup', array('get_backup_list' => admin_url('admin-ajax.php?action=get_backup_list')));
		wp_localize_script($this->femora_compress, 'femora_dump_backup', array('dump_backup' => admin_url('admin-ajax.php?action=dump_backup')));
		wp_localize_script($this->femora_compress, 'femora_statistics', array('statistics' => admin_url('admin-ajax.php?action=statistics')));
		wp_localize_script($this->femora_compress, 'femora_send_data', array('send_data' => admin_url('admin-ajax.php?action=send_data')));
		wp_localize_script($this->femora_compress, 'femora_opt', array('femora_optimize' => admin_url('admin-ajax.php?action=femora_optimize')));
		wp_localize_script($this->femora_compress, 'femora_search', array('search' => admin_url('admin-ajax.php?action=search')));
		wp_localize_script($this->femora_compress, 'femora_insert', array('insert_img' => admin_url('admin-ajax.php?action=insert_img')));
		wp_enqueue_script($this->femora_compress);


		wp_enqueue_script($this->femora_compress . '-twentytwenty' , plugin_dir_url(__FILE__) . 'libraries/comparador/js/jquery.twentytwenty.js', array('jquery'), $this->version, true);
		wp_enqueue_script($this->femora_compress . '-twentytwenty');

		wp_enqueue_script($this->femora_compress . '-event' , plugin_dir_url(__FILE__) . 'libraries/comparador/js/jquery.event.move.js', array('jquery'), $this->version, true);
		wp_enqueue_script($this->femora_compress . '-event');

		wp_register_script($this->femora_compress . '-femora-modal', plugin_dir_url(__FILE__) . 'libraries/js/jquery.modal.min.js', array('jquery'), $this->version, true);
		wp_enqueue_script($this->femora_compress . '-femora-modal');

		
		wp_enqueue_script($this->femora_compress . '-goalProgress', plugin_dir_url(__FILE__) . 'libraries/js/goalProgress.js', array('jquery'), $this->version, true);

		wp_register_script($this->femora_compress . '-jquery-dataTables', plugin_dir_url(__FILE__) . 'libraries/js/jquery.dataTables.min.js');
		wp_enqueue_script($this->femora_compress . '-jquery-dataTables');

		wp_register_script($this->femora_compress . '-dataTables-responsive', plugin_dir_url(__FILE__) . 'libraries/js/dataTables.responsive.min.js', array('jquery'), $this->version, true);
		wp_enqueue_script($this->femora_compress . '-dataTables-responsive');
	}

	/**
	 * View error in admin area.
	 *
	 * @since   0.9.5
	 */
	public function femora_pre_output1($action)
	{

		if (is_admin() && file_exists(temp_file)) {
			$cont = file_get_contents(temp_file);
			if (!empty($cont)) {
				echo '<div class="error"> Error Message:' . $cont . '</div>';
				@unlink(temp_file);
			}
		}
	}

	/**
	 * Add custom favicon.
	 *
	 * @since   0.9.5
	 */
	public function femora_compress_favicon()
	{
		echo '<style>
		.dashicons-femora {
			background-image: url("' . FEMORA_COMPRESS_DIR_URL . '/assets/images/femora-icon.png");
			background-repeat: no-repeat;
			background-position: center; 
			background-size: 16px;
		}
		</style>';
	}

	/**
	 * Add admin menu.
	 *
	 * @since   0.9.5
	 */
	public function crear_menu_femora_compress()
	{
		require_once plugin_dir_path(__FILE__) . 'partials/femora-compress-admin-display.php';
		require_once plugin_dir_path(__FILE__) . 'partials/femora-compress-admin-settings.php';
		
		add_menu_page('Femora', 'Femora Compress', 'manage_options', 'femora_compress', 'femora_backend_dashboard', 'dashicons-femora');
		add_submenu_page('femora_compress', 'Configuración', 'Configuración', 'manage_options', 'femora_configuracion', 'femora_configuracion');
	}

	/**
	 * 
	 * Search user Femora
	 */
	public function fill_table()
	{
		/**
		 * Función para llenar tabla con información de imagenes en Femora Compress
		 **/
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-fill-table.php';
		
	}

	function get_backup_list()
	{
		/*
     * Obtener lista de imágenes que están respaldadas
     */
		//global $wpdb;
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-list-backup.php';
	}

	function dump_backup()
	{
		/*
     * Obtener lista de imágenes que están respaldadas
     */
		//global $wpdb;
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-dump-backup.php';
	}
	function femora_optimize()
	{
		//llamada a enviardatos
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-optimize-images.php';
	}
	/*function send_data()
	{
		//llamada a enviardatos
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-send-data.php';
	}*/
	function statistics()
	{
		//llamada a estadisticas
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-statistics.php';
	}
	function search()
	{
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-search.php';
	}
	function insert_img()
	{
		global $wpdb;
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-insert-image.php';
	}
	function femora_setting()
	{
		require_once plugin_dir_path(__FILE__) . 'partials/function-femora-compress-setting.php';
	}

	function formatSizeUnits($bytes)
	{
		/* if ($bytes >= 1073741824) {
			$bytes = number_format(($bytes / 1073741824), 2) . " GB";
			} else if ($bytes >= 1048576) {
			$bytes = number_format(($bytes / 1048576), 2) . " MB";
			} else if ($bytes >= 1024) {
			$bytes = number_format(($bytes / 1024), 2) . " KB";
			} else if ($bytes > 1) {
			$bytes = $bytes . " bytes";
			} else if ($bytes == 1) {
			$bytes = $bytes . " byte";
			} else {
			$bytes = "0 bytes";
			} */
		$bytes = number_format(($bytes / 1048576), 3) . " MB";
		return $bytes;
	}

	
}
