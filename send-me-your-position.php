<?php

/**
 * -----------------------------------------------------------------------------
 * Plugin Name: Utility Plugin - Namespaced OO
 * Description: A better solution to placing code-snips in the theme's functions.php file. This version of the plugin contains namespaced, object-oriented code.
 * Version: 1.0.0
 * Author: Code Potent
 * Author URI: https://codepotent.com
 * Plugin URI: https://codepotent.com/classicpress-plugins/
 * Text Domain: codepotent-utility-plugin-namespaced-oo
 * Domain Path: /languages
 * -----------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.txt.
 * -----------------------------------------------------------------------------
 * Copyright © 2019 - CodePotent
 * -----------------------------------------------------------------------------
 *           ____          _      ____       _             _
 *          / ___|___   __| | ___|  _ \ ___ | |_ ___ _ __ | |_
 *         | |   / _ \ / _` |/ _ \ |_) / _ \| __/ _ \ '_ \| __|
 *         | |__| (_) | (_| |  __/  __/ (_) | ||  __/ | | | |_
 *          \____\___/ \__,_|\___|_|   \___/ \__\___|_| |_|\__|.com
 *
 * -----------------------------------------------------------------------------
 * Purpose
 *
 * This plugin provides a container for code-snips that might otherwise be added
 * to your theme's functions.php file. You can treat this file as though it were
 * your functions.php file – just add your code-snips here instead. Placing your
 * code-snips here also allows you to activate and deactivate them, the same way
 * you can with any plugin. For more information, see: https://bit.ly/2VSE6k3
 * -----------------------------------------------------------------------------
 */

namespace YourOwnPrefix\UtilityPlugin;

class Utility {

	// Add actions and filters to this method.
	public function __construct() {
		add_filter('admin_footer_text', [$this, 'custom_footer_text']);
	}

	// A function that returns a string of custom text.
	public function custom_footer_text($text) {
		$text = esc_html__('Built with endorphins and adrenaline!', 'codepotent-utility-plugin-namespaced-oo');
		return $text;
	}

}

new Utility;