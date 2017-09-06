<?php 

/* 
Plugin Name: Oxygen Typekit
Author: Soflyy
Author URI: https://oxygenapp.com
Description: Adds an option to use Typekit fonts in your designs
Version: 1.0
Text Domain: oxygen
*/

define("OXTK_VERSION", "1.0");
define("OXTK_OXYGEN_REQUIRED_VERSION", "1.4");
define("OXTK_PATH", 	plugin_dir_path( __FILE__ ) );
define("OXTK_URI", 	plugin_dir_url( __FILE__ ) );

Class OxygenTypekit {

	function __construct() {

		if ( $this->versions_is_ok() ) {
			
			// add scripts and styles
			add_action( 'oxygen_enqueue_scripts', array( $this, 'enqueue_script' ) );

			add_action( 'admin_menu', array( $this, 'add_typekit_page' ) );
			add_action( 'ct_builder_ng_init', array( $this, 'init_typekit' ) );

			include_once 'includes/edd-updater/edd-updater.php';
		}
	}

	
	/**
	 * Check if Oxygen main plugin installed and version is supported
	 *
	 * @since 1.0
	 * @author Ilya K.
	 */

	function versions_is_ok() {

		if ( ! defined("CT_VERSION") ) {
			add_action( 'admin_notices', array( $this, 'oxygen_not_found' ) );
			return false;
		}

		if ( version_compare( CT_VERSION, OXTK_OXYGEN_REQUIRED_VERSION ) >= 0) {
	    	return true;
		}
		else {
			add_action( 'admin_notices', array( $this, 'oxygen_wrong_version' ) );
			return false;
		}
	}


	/**
	 * Admin notice if Oxygen main plugin not found active
	 *
	 * @since 1.0
	 * @author Ilya K.
	 */

	function oxygen_not_found() {
		
		$classes = 'notice notice-error';
		$message = __( 'Can\'t start Oxygen Typekit add-on. Oxygen main plugin not found activate in your install.', 'oxygen' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', $classes, $message ); 
	}


	/**
	 * Admin notice if Oxygen main plugin version is not compatible
	 *
	 * @since 1.0
	 * @author Ilya K.
	 */

	function oxygen_wrong_version() {
		
		$classes = 'notice notice-error';
		$message = __( 'Your Oxygen version is not supported by Oxygen Typekit add-on. Minimal required Oxygen version is:', 'oxygen' );

		printf( '<div class="%1$s"><p>%2$s <b>%3$s</b></p></div>', $classes, $message, OXTK_OXYGEN_REQUIRED_VERSION ); 
	}

	
	/**
	 * Add scripts
	 *
	 * @since 1.0
	 * @author Ilya K.
	 */

	function enqueue_script() {
		
		if ( $kit_id = get_option( 'ct_typekit_kit_id', '') ) {
			
			wp_enqueue_script   ( 'oxygen-adobe-typekit', 'https://use.typekit.net/'.$kit_id.'.js');
			wp_add_inline_script( 'oxygen-adobe-typekit', 'try{Typekit.load({ async: true });}catch(e){}');
		}
	}


	/**
	 * Add Typekit sub-menu
	 * 
	 * @since 1.2
	 */

	function add_typekit_page() {
		add_submenu_page( 	'ct_dashboard_page', 
							'Typekit', 
							'Typekit', 
							'manage_options', 
							'ct_typekit', 
							array( $this, 'typekit_page_callback' ) );
	}


	/**
	 * Callback to show Typekit settings page
	 *
	 * @since 1.2
	 */

	function typekit_page_callback() {
		require_once 'includes/typekit-page.view.php';
	}


	/**
	 * Output Typekit fonts if user set the Typekit kit
	 *
	 * @since 1.0
	 */

	function init_typekit() {

		$token  = get_option("ct_typekit_token", "");
		$kit_id = get_option("ct_typekit_kit_id", "");

		if(empty($kit_id) || empty($token)) {
			echo "typeKitFonts=[];";
		}
		else {
			// Get Typekit fonts
			$response = wp_remote_get( 'https://typekit.com/api/v1/json/kits/'.$kit_id.'?token='.$token, 
				array( 	'timeout' => 120, 
						'httpversion' => '1.1' ) );

			$response = json_decode( $response["body"], true );

			//var_dump( $response );

			if ( isset( $response["kit"] ) && $response["kit"] && is_array( $response["kit"]["families"] ) ) {

				$fonts = [];

				foreach ( $response["kit"]["families"] as $family ) {
					$fonts[] = array(
							"slug" => $family["slug"],
							"name" => $family["name"]
						);	
				}

				$output = json_encode( $fonts );
				$output = htmlspecialchars( $output, ENT_QUOTES );

				echo "typeKitFonts=$output;";
			}
			else {
				echo "typeKitFonts=[];";	
			}
		}
	}

}

/**
 * Init Selector Detector add-on after Oxygen main plugin loaded
 */

function oxygen_typekit_init() {
	// Instantiate the plugin
	$oxygenTypekitInstance = new OxygenTypekit();
}
add_action( 'plugins_loaded', 'oxygen_typekit_init' );