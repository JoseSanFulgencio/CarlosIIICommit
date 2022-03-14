<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CarlosIIICommit
 * @subpackage CarlosIIICommit/includes
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
 * @since      1.0.0
 * @package    CarlosIIICommit
 * @subpackage CarlosIIICommit/includes
 * @author     Jose <8686470@alu.murciaeduca.es>
 */
class CarlosIIICommit {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      CarlosIIICommit_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $CarlosIIICommit    The string used to uniquely identify this plugin.
	 */
	protected $CarlosIIICommit;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'CarlosIIICommit_VERSION' ) ) {
			$this->version = CarlosIIICommit_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->CarlosIIICommit = 'CarlosIIICommit';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_commit_types();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - CarlosIIICommit_Loader. Orchestrates the hooks of the plugin.
	 * - CarlosIIICommit_i18n. Defines internationalization functionality.
	 * - CarlosIIICommit_Admin. Defines all hooks for the admin area.
	 * - CarlosIIICommit_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-CarlosIIICommit-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-CarlosIIICommit-i18n.php';

		/**
		 * The class responsible for defining new commit type
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-CarlosIIICommit-commit-type.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-CarlosIIICommit-admin.php';

        /**
         * The class responsible for defining shortcode.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-CarlosIIICommit-shortcode.php';

		/**
         * La clase responsable de la definición del widget de subscripción.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-CarlosIIICommitWidgetSuscribeInstitutions.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-CarlosIIICommit-public.php';

		/**
		* La clase responsable de gestionar las opciones.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-CarlosIIICommit-options.php';

		$this->loader = new CarlosIIICommit_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the CarlosIIICommit_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new CarlosIIICommit_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new CarlosIIICommit_Admin( $this->get_CarlosIIICommit(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $plugin_shortcode = new CarlosIIICommit_shortcode();
        $this->loader->add_action( 'init', $plugin_shortcode, 'CarlosIIICommit_shortcode_init' );
		$this->loader->add_action( 'admin_menu', $plugin_options, 'CarlosIIICommit_options_menu' );
		$this->loader->add_action( 'admin_init', $plugin_options, 'CarlosIIICommitRegistraOpciones');

       // Creando una entrada nueva en el menú Commit
        $plugin_options = new CarlosIIICommit_Options();

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new CarlosIIICommit_Public( $this->get_CarlosIIICommit(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	
	/**
     * Register Commit Type.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_commit_types() {
        // Register custom post types
        $Commit_Type = new CarlosIIICommit_commit_type();
    }


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_CarlosIIICommit() {
		return $this->CarlosIIICommit;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    CarlosIIICommit_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
