<?php

/**
 * -----------------------------------------------------------------------------
 * Plugin Name: Send me your position
 * Description: ClassicPress plugin to add a button that sends your position via WhatsApp
 * Version: 0.0.5
 * Author: Gieffe edizioni srl
 * Author URI: https://www.gieffeedizioni.it/classicpress
 * Plugin URI: https://github.com/xxsimoxx/send-me-your-position
 * Text Domain: smyp
 * Domain Path: /languages
 * -----------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.txt.
 * -----------------------------------------------------------------------------
 * Copyright © 2019 - Simone Fioravanti
 * -----------------------------------------------------------------------------
 */

namespace XXSimoXX\SMYP;

// Add auto updater
// https://codepotent.com/classicpress/plugins/update-manager/
require_once( 'classes/UpdateClient.class.php' );

defined( 'ABSPATH' ) || exit;

class SendPosition {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [$this, 'register_script'], 5 );
		add_shortcode( 'smyp', [$this, 'button_shortcode'] );
		add_action( 'plugins_loaded', [$this, 'load_textdomain'] );
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'smyp', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
	}

	public function register_script() {
		wp_register_script( 'smyp-script', plugins_url( '/scripts/smyp.js', __FILE__ ), array(), '1.0.1', true );
		wp_register_style( 'smyp-style', plugins_url( '/styles/smyp.css', __FILE__ ), array(), '1.0.1', 'all' );
	}

	private function sanitize_wa_phone( $phone ){
	
		// delete spaces
		$phone = str_replace( " ","", $phone );
		
		// check that number is in international format
		if ( ! preg_match ( '/^\+[0-9]+$/', $phone ) ){
			return FALSE;
		} else {
			// Remove the starting + or +00 to conform to WhatsApp API
			return preg_replace ( '/^\+0*/', '', $phone );
		}
	}	
	
	/**
	*
	* Shortcode syntax
	* [smyp wa="+1 555 4567" askname=1]button text[/smyp]
	*
	*/
	public function button_shortcode( $atts, $content = null ) {
		$values = shortcode_atts( array(
			'wa'   		=> "",
			'askname'	=> 1
		), $atts );
		
		// Let's sanitize and validate phone number
		$wa = $this->sanitize_wa_phone( $values['wa'] );
		
		// If something is wrong with the number...		
		if ( FALSE === $wa ) {
			// Let's warn only admins/editors
			if ( current_user_can( 'edit_posts' ) ){
				return esc_attr__( 'Please check your [smyp] shortcode. The "wa" attribute must be set and must be in international format (only you can see this message).', 'smyp' ) . '<a href="' . get_edit_post_link() . '">' . esc_html__( 'Edit post.', 'smyp' ). '</a>';
			} else {
				return "";
			}
		} else {
			
			// Localize and pass parameters to JavaScript
			$js_params = array(
				'person_message' => esc_attr__( 'Please enter your name.', 'smyp' ),
				'geo_error'      => esc_attr__( 'Sorry, can\'t get your position!', 'smyp' ),
				'geo_prompt'     => esc_attr__( 'Be sure to let me know your position!', 'smyp' ),
				'wa'             => $wa,
				'askname'        => (bool) $values['askname']
			);
			wp_localize_script( 'smyp-script', 'js_params', $js_params );
			
			// Enqueue styles and scripts if they are not already
			if( ! wp_script_is( "smyp-script", "enqueued" ) ){ 
				wp_enqueue_script('smyp-script'); 
			}
			if( ! wp_style_is( "smyp-style", "enqueued" ) ){ 
				wp_enqueue_style('smyp-style'); 
			}
			
			// Return the button
			return '<div class="smyp-container"><button class="smyp-button smyp-button-wa" onclick="smypSend()">' . $content . '</button><div id="smyp-message"></div></div>';
		}
	}
	
}

new SendPosition;