<?php
/**
Plugin Name: JGC Image Widget
Description: A simple plugin that creates a widget to add images to your sidebars.
Version: 1.1.3
Author: GalussoThemes
Author URI: https://galussothemes.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: jgc-image-widget
Domain Path: /languages

JGC Image Widget is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

JGC Image Widget is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with JGC Image Widget. If not, see https://www.gnu.org/licenses/gpl-2.0.html.

/**
 *
 * @package JGC Image Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'jgcwiw_load_textdomain' );
/**
 * Load text domain.
 *
 * @since 1.0.0
 */
function jgcwiw_load_textdomain() {

	load_plugin_textdomain( 'jgc-image-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );

}

require_once plugin_dir_path( __FILE__ ) . 'inc/jgc-widget-image-widget.php';
