<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       macrosinexcel.com
 * @since      1.0.0
 *
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ctc_Countdown_Timer_Cookies
 * @subpackage Ctc_Countdown_Timer_Cookies/admin
 * @author     Jerbik <jerbiun@gmail.com>
 */
class Ctc_Countdown_Timer_Cookies_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
            global $post_type;
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
                 if($post_type  == 'ctc_countdown')
             {
		wp_enqueue_style( $this->plugin_name, 
                        plugin_dir_url( __FILE__ ) . 'css/ctc-countdown-timer-cookies-admin.css', array(), $this->version, 'all' );
             }
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
             
             global $post_type;
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
                 
             if($post_type  == 'ctc_countdown')
             {
 		wp_enqueue_script( $this->plugin_name, 
                        plugin_dir_url( __FILE__ ) . 'js/ctc-countdown-timer-cookies-admin.js', array( 'jquery' ), $this->version, false );
             }
	}
        /**
	 * Register new custom post type 'crc_countdown'
 	 *
	 * @since    1.0.0
 	 */
        public function create_post_type_ctc_countdown(){
           $labels = array(
            'name' => __('Ctc Countdown',$this->plugin_name),
            'singular_name' => __('Ctc Countdown',$this->plugin_name),
            'menu_name' => __('Ctc Countdown',$this->plugin_name),
            'all_items' => __('Countdown List',$this->plugin_name),
            'view_item' => __('View',$this->plugin_name),
            'add_new_item' => __('Add new Countdown',$this->plugin_name),
            'add_new' => __('Add Countdown',$this->plugin_name),
            'edit_item' => __('Edit Countdown',$this->plugin_name),
            'update_item' => __('Update Countdown',$this->plugin_name),
            'search_items' => __('Search Countdown',$this->plugin_name),
            'not_found' => __('Not Countdown Found',$this->plugin_name),
            'not_found_in_trash' => __('Not found in Trash',$this->plugin_name),
        );


        $args = array(
            'label' =>  'ctc_countdown' ,
            'labels' => $labels,
            'supports' => array('title'),
            'hierarchical' => false,
            'public' => false,
            'show_in_menu' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'ctc_countdown'),
             'show_ui' => true,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-backup',
            'register_meta_box_cb' => array($this,'ctc_countdown_add_metaboxes'),

        );

         register_post_type('ctc_countdown', $args);
        }
         /**
	 * Register metabox for settings of custom post type ctc_countdown
 	 *
	 * @since    1.0.0
 	 */
           function ctc_countdown_add_metaboxes()
        {
              //etabox options of countdown
            add_meta_box(
		'ctc_countdown_option',
		__('Countdown Options',$this->plugin_name),
		array( $this,'ctc_countdown_options_create_admin_page'),
		'ctc_countdown',
		'normal'
            );
            
            //metabox shortcode preview
            add_meta_box(
		'ctc_countdown_shortcode',
		__('Countdown Shortcode',$this->plugin_name),
		array( $this,'ctc_countdown_shortcode_page'),
		'ctc_countdown',
		'side'
            );
        }
          /**
	 * Main metabox options of countdown
 	 *
	 * @since    1.0.0
	 * @access   public
         * @param    Object post
	 */
        public function ctc_countdown_options_create_admin_page($post) {
           
            //get options of countdown 
            $ctc_options  = get_post_meta($post->ID,'_ctc_countdown_options',true);
                            
		include 'partials/ctc-countdown-timer-cookies-admin-display.php';
        }
         /**
	 * Side metabox to show the shortcode of countdown
 	 *
	 * @since    1.0.0
	 * @access   public
         * @param    Object post
	 */
        public function ctc_countdown_shortcode_page($post) {
            echo __('<p>Copy this shortcode and paste it into your post,page...<p>',$this->plugin_name);
            echo '<h1>[ctctimer id="'.$post->ID.'"]</h1>';
        }
         /**
	 * Save metabox options of custom post type
 	 *
	 * @since    1.0.0
	 * @access   public
         * @param    int post_id
	 */
        
        function ctc_countdown_save_metaboxes( $post_id ) {
    
            //checking some data before saving
            $ctc_countdown_nonce  = sanitize_text_field(isset($_POST['ctc_countdown_nonce'])?$_POST['ctc_countdown_nonce']:'' );
 	if ( $ctc_countdown_nonce === '' ) {
        return;
        }
        if ( ! wp_verify_nonce( $ctc_countdown_nonce, 'ctc_countdown_nonce' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        
        
        
        $ctc_days  = sanitize_text_field(isset($_POST['ctc_days'])?$_POST['ctc_days']:'');
        $ctc_hours  = sanitize_text_field(isset($_POST['ctc_hours'])?$_POST['ctc_hours']:'');
        $ctc_minutes  = sanitize_text_field(isset($_POST['ctc_minutes'])?$_POST['ctc_minutes']:'');
        $ctc_secondes  = sanitize_text_field(isset($_POST['ctc_secondes'])?$_POST['ctc_secondes']:'');
        $ctc_redirect  = sanitize_text_field(isset($_POST['ctc_redirect'])?$_POST['ctc_redirect']:'');
        $ctc_reset = get_post_meta($post_id,'_ctc_countdown_reset',true);
         
        //validate some data
         if(!preg_match('/^\d+$/', $ctc_days)) $ctc_days = 0;
         if(!preg_match('/^\d+$/', $ctc_hours)) $ctc_hours = 0;
         if(!preg_match('/^\d+$/', $ctc_minutes)) $ctc_minutes = 0;
         if(!preg_match('/^\d+$/', $ctc_secondes)) $ctc_secondes = 0;
         
        $ctc_options_data = array(
            '_ctc_days'  => $ctc_days,
            '_ctc_hours'  => $ctc_hours,
            '_ctc_minutes'  => $ctc_minutes,
            '_ctc_secondes'  => $ctc_secondes,
            '_ctc_redirect'  => $ctc_redirect,
            '_ctc_url_redirect'  => get_permalink($ctc_redirect),
            '_ctc_reset'  => $ctc_reset == '' ? 0 : $ctc_reset
        );
        
        update_post_meta($post_id,'_ctc_countdown_options',$ctc_options_data);
        
}
        
        /**
	 * Add new custom columns 
 	 *
	 * @since    1.0.0
	 * @access   public
         * @param    array $columns
	 */

function add_ctc_countdown_columns($columns)
{
      $new_columns = array();
                    if (is_admin()) {
                        foreach ($columns as $column_name => $column_info) {

                            $new_columns[$column_name] = $column_info;

                            if ('title' === $column_name) {
                                $new_columns['ctc_shortcode'] = 'Shortcode';
                            }
                             
                        }
                        return $new_columns;
                    }
                    return $columns;

}
        /**
	 * Content for the  new custom columns 
 	 *
	 * @since    1.0.0
	 * @access   public
         * @param    array $column
	 */
        function ctc_countdown_column_content($column)
        {
            global $post;
            if($column === 'ctc_shortcode')
            {
                echo  '[ctctimer id='.$post->ID.']';
            }
        }
        /**
	 * Reset all users data
 	 *
	 * @since    1.0.0
	 * @access   public
 	 */
        function ctc_reset_countdown()
        {
            
            $post_id = sanitize_text_field(isset($_REQUEST['post_id'])?$_REQUEST['post_id']:'');
            
            if($post_id === '')
                return;
            
            $ctc_options = get_post_meta($post_id,'_ctc_countdown_options',true);
            $ctc_options['_ctc_reset']  =  $ctc_options['_ctc_reset']+1;
            update_post_meta($post_id,'_ctc_countdown_options',$ctc_options);
            
        }
 

}
