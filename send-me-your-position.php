<?php

/**
 * -----------------------------------------------------------------------------
 * Plugin Name: Send me your position 2
 * Description: ClassicPress plugin to add a button that sends your position via WhatsApp
 * Version: 0.0.1
 * Author: Gieffe edizioni srl
 * Author URI: https://www.gieffeedizioni.it/classicpress
 * Plugin URI: https://github.com/xxsimoxx/send-me-your-position
 * Text Domain: smyp
 * Domain Path: /languages
 * GitHub Plugin URI: xxsimoxx/send-me-your-position
 * -----------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.txt.
 * -----------------------------------------------------------------------------
 * Copyright © 2019 - Simone Fioravanti
 * -----------------------------------------------------------------------------
 */

namespace xxsimoxx\smyp;

defined( 'ABSPATH' ) || exit;

class Send_Position {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [$this, 'register_script'] );
		add_shortcode( 'smyp', [$this, 'button_shortcode'] );
	}

	public function register_script() {
		wp_register_script( 'smyp-script', plugins_url( '/scripts/smyp.js', __FILE__ ), array(), '1.0.0', true );
		wp_register_style( 'smyp-style', plugins_url( '/styles/smyp.css', __FILE__ ), array(), '1.0.0', 'all' );
		// wp_enqueue_script('smyp-script'); <-funziona
		// wp_enqueue_style('smyp-style');

		//		echo"<script>console.log('register')</script>";

	}

	public function button_shortcode( $atts, $content = null ) {
		//wp_enqueue_script('smyp-script');
		wp_enqueue_style('smyp-style');
		//if( ! wp_style_is( "smyp-style", $list = 'enqueued' ) ) { wp_enqueue_style('smyp-style'); }

		//if( ! wp_style_is( "smyp-style", $list = 'enqueued' ) ) { wp_enqueue_style('smyp-style'); }
		//if( ! wp_script_is( "smyp-script", $list = 'enqueued' ) ) { wp_enqueue_script('smyp-script'); }
		return '<button class="smyp-button" onclick="smypSend()">' . $content .'</button>';
	}

}

new Send_Position;