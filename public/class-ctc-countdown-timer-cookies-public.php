<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       macrosinexcel.com
 * @since      1.0.0
 *
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/public
 * @author     Jerbik <jerbiun@gmail.com>
 */
class Ctc_Countdown_Timer_Cookies_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ctc_Countdown_Timer_Cookies_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ctc_Countdown_Timer_Cookies_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ctc-countdown-timer-cookies-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ctc_Countdown_Timer_Cookies_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ctc_Countdown_Timer_Cookies_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ctc-countdown-timer-cookies-public.js', array( 'jquery' ), $this->version, false );

                
	}

        /**
	 * Display the countdown in front 
 	 *
	 * @since    1.0.0
	 * @access   public
         * @param    array $attrs 
	 */
        public function display_countdown_timer_cookie($attrs){
            
            //check countdown attribut id
             
            if(empty($attrs) || !isset($attrs['id']))
                return esc_html_e('Specify the countdown id please!',$this->plugin_name);
            
            
            $ctc_id  = (int)$attrs['id'];
            //get countdown options 
            $ctc_options = get_post_meta($ctc_id,'_ctc_countdown_options',true);
            
            $ctc_options['_ctc_message'] = __('<h2>This offre is expired!</h2>',$this->plugin_name);
             //check options of countdown exist
            if(is_array($ctc_options) && !empty($ctc_options)){
            $ctc_options['_ctc_id']  = $ctc_id;
            ob_start();
            include 'partials/ctc-countdown-timer-cookies-public-display.php';
            return ob_get_clean();
            }else{
                return esc_html_e('Countdown does not exist!',$this->plugin_name);
            }
        }
}
