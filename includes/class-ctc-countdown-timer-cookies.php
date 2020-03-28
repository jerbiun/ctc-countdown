<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       macrosinexcel.com
 * @since      1.0.0
 *
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/includes
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
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/includes
 * @author     Jerbik <jerbiun@gmail.com>
 */
class Ctc_Countdown_Timer_Cookies {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ctc_Countdown_Timer_Cookies_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

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
		if ( defined( 'CTC_COUNTDOWN_TIMER_COOKIES_VERSION' ) ) {
			$this->version = CTC_COUNTDOWN_TIMER_COOKIES_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ctc-countdown-timer-cookies';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ctc_Countdown_Timer_Cookies_Loader. Orchestrates the hooks of the plugin.
	 * - Ctc_Countdown_Timer_Cookies_i18n. Defines internationalization functionality.
	 * - Ctc_Countdown_Timer_Cookies_Admin. Defines all hooks for the admin area.
	 * - Ctc_Countdown_Timer_Cookies_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ctc-countdown-timer-cookies-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ctc-countdown-timer-cookies-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ctc-countdown-timer-cookies-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ctc-countdown-timer-cookies-public.php';

		$this->loader = new Ctc_Countdown_Timer_Cookies_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ctc_Countdown_Timer_Cookies_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ctc_Countdown_Timer_Cookies_i18n();

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

		$plugin_admin = new Ctc_Countdown_Timer_Cookies_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

                //register new custom post type 'ctc_countdown'
                $this->loader->add_action( 'init',$plugin_admin, 'create_post_type_ctc_countdown'  );
                
                //save options of custom post type 'ctc_countdown'
                $this->loader->add_action( 'save_post',  $plugin_admin,'ctc_countdown_save_metaboxes' , 1, 2 );
 
                //add new column in the list of countdown
                $this->loader->add_filter( 'manage_edit-ctc_countdown_columns',$plugin_admin, 'add_ctc_countdown_columns' ) ;
                $this->loader->add_action('manage_ctc_countdown_posts_custom_column', $plugin_admin, 'ctc_countdown_column_content');

                //hook button reset all users data
                $this->loader->add_action('wp_ajax_nopriv_ctc_reset_countdown', $plugin_admin, 'ctc_reset_countdown');
                $this->loader->add_action('wp_ajax_ctc_reset_countdown', $plugin_admin, 'ctc_reset_countdown');


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ctc_Countdown_Timer_Cookies_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
                
                //add short for the front use
                add_shortcode('ctctimer',array($plugin_public,'display_countdown_timer_cookie'));


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
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ctc_Countdown_Timer_Cookies_Loader    Orchestrates the hooks of the plugin.
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
