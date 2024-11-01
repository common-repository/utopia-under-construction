<?php
/*
Plugin Name: Utopia
Plugin URI: https://demo.krasotaiskusstva.com/utopia
Description: Animated/Illustrated Under construction plug-in for WordPress
Version: 1.3.0
Author: Moskva Yigit
Author URI: http://www.moskvayigit.com
License: GPL2+
*/

global $ki_id;
$ki_id = "Utopia_";
require_once('assets/framework/framework.php');
require_once('assets/check.php');
if ( ! class_exists( 'Utopia_UCP' ) ) {	
    class Utopia_UCP extends SeedProd_Framework {
	
		private $coming_soon_rendered = false; 
        
        /**
         *  Extend the base construct and add plugin specific hooks
         */
        function __construct(){
			global $ki_id;
            $options = get_option($ki_id . 'utopia_ucp_options');
            parent::__construct();
			
			if (!empty( $options[$ki_id.'comingsoon_enabled'] )):
				if ($options[$ki_id.'comingsoon_enabled']!="no")
					$this->coming_soon_rendered = true;
				else
					$this->coming_soon_rendered = false;
			endif;
           
		   
            add_action('template_redirect', array(&$this,'render_comingsoon_page'),12);
            if ($this->coming_soon_rendered)
				add_action( 'admin_bar_menu',array( &$this, 'admin_bar_menu' ), 1000 );
			
			
        }

        /**
        * Display admin bar when active
        */

        function admin_bar_menu(){
            global $wp_admin_bar;

            /* Add the main siteadmin menu item */
                $wp_admin_bar->add_menu( array(
                    'id'     => 'debug-bar',
                    'href' => admin_url().'options-general.php?page=Utopia_coming_soon',
                    'parent' => 'top-secondary',
                    'title'  => apply_filters( 'debug_bar_title', __('Coming Soon Mode Active', 'Utopia-coming-soon-page') ),
                    'meta'   => array( 'class' => 'ucsp-mode-active' ),
                ) );
        }
        
        /**
         * Display the coming soon page
         */
        function render_comingsoon_page() {
				$allow = false;
				if (!is_user_logged_in()&&($this->coming_soon_rendered)) {
					$allow = true;
					//echo "TES " . $this->coming_soon_rendered;
					//exit();
				}
			
					
	            if(!is_admin()){
	                if(!is_feed()){	
	                    if ( $allow || (isset($_GET['cs_preview']) && $_GET['cs_preview'] == 'true')) {
							$file = plugin_dir_path(__FILE__).'template.php';
	                        include($file);
							exit();
	                    }
	                }
	            }
        }
        
       
        
        function plugin_action_links($links, $file) {
            $plugin_file = 'utopia-under-construction/utopia-under-construction.php';
            if ($file == $plugin_file) {
                $settings_link = '<a href="options-general.php?page=Utopia_coming_soon">Settings</a>';
                array_push($links, $settings_link);
            }
            return $links;
        }

         function add_frontent_scripts() {
				
        }
        
        // End of Class					
    }
}

/**
 * Config
 */
$KI_UCP = new Utopia_UCP();
$KI_UCP->plugin_base_url = plugins_url('',dirname(__FILE__));
$KI_UCP->plugin_version = '0.1';
$KI_UCP->plugin_type = 'free';
$KI_UCP->plugin_short_url = 'https://demo.krasotaiskusstva.com/utopia';
$KI_UCP->plugin_name = __('Utopia Coming Soon', 'Utopia-coming-soon-page');
$KI_UCP->menu[] = array("type" => "add_options_page",
                         "page_name" => esc_html__("Utopia Coming Soon", 'Utopia-coming-soon-page'),
                         "menu_name" => esc_html__("Utopia Coming Soon", 'Utopia-coming-soon-page'),
                         "capability" => "manage_options",
                         "menu_slug" => $ki_id . "coming_soon",
                         "callback" => array($KI_UCP,'option_page'),
                        );
                        
/**
 *  Do not replace validate_function. Create unique id and copy menu slug 
 * from menu config. Create 'validate_function' if using custom validation.
 */
$KI_UCP->options[] = array( "type" => "setting",
                "id" => $ki_id . "utopia_ucp_options",
				"menu_slug" => $ki_id . "coming_soon"
				);

/**
 * Create unique id,label, create 'desc_callback' if you need custom description, attach
 * to a menu_slug from menu config.
 */
$KI_UCP->options[] = array( "type" => "section",
                "id" => $ki_id . "section_coming_soon",
				"label" => esc_html__("Settings", 'Utopia-coming-soon-page'),	
				"menu_slug" => $ki_id . "coming_soon");


/**
 * Choose type, id, label, attache to a section and setting id.
 * Create 'callback' function if you are creating a custom field.
 * Optional desc, default value, class, option_values, pattern
 * Types image,textbox,select,textarea,radio,checkbox,color,custom
 */
$KI_UCP->options[] = array( "type" => "select",
                "id" => $ki_id . "comingsoon_enabled",
				"label" => esc_html__("Enable", 'Utopia-coming-soon-page'),
				"desc" => sprintf(__("<a href='%s/?cs_preview=true&1'>Preview</a>", 'Utopia-coming-soon-page'),home_url()),
                "option_values" => array('no'=>__('No', 'Utopia-coming-soon-page'),'yes'=>__('Yes', 'Utopia-coming-soon-page')),
				"section_id" => $ki_id . "section_coming_soon",
				"setting_id" => $ki_id . "utopia_ucp_options",
				);

$cartoon_array = array();
		for ($k=1;$k<11;$k++) {
			if ($k<10)
				$string = '0'.$k. '.png';
			else
				$string = $k. '.png';
	
		$cartoon_array[$string] = $string;
}

$KI_UCP->options[] = array( "type" => "select_image",
                "id" => $ki_id . "cartoon",
				"label" => esc_html__("Cartoon Logo", 'Utopia-coming-soon-page'),
				"desc" => esc_html__("", 'Utopia-coming-soon-page'),
				"option_values" => $cartoon_array,
				"section_id" => $ki_id . "section_coming_soon",
				"setting_id" => $ki_id . "utopia_ucp_options",
				);

$KI_UCP->options[] = array( "type" => "datepicker",
                "id" => $ki_id ."launch_date",
				"label" => esc_html__("Launch Date", 'Utopia-coming-soon-page'),
				"desc" => esc_html__("Enter start date. It must be more than : ". date('Y-m-d'), 'Utopia-coming-soon-page'),
				"section_id" => $ki_id . "section_coming_soon",
				"setting_id" => $ki_id . "utopia_ucp_options",
				);
$KI_UCP->options[] = array( "type" => "textarea",
                "id" => $ki_id ."message",
				"label" => esc_html__("Message", 'Utopia-coming-soon-page'),
				"desc" => esc_html__("Enter the message.", 'Utopia-coming-soon-page'),
				"section_id" => $ki_id . "section_coming_soon",
				"setting_id" => $ki_id . "utopia_ucp_options",
				);
 ?>