<?php
/*
 * Plugin Name: MAW Resources
 * Plugin URI: https://www.michaelweiner.org/
 * Description: A plugin to create a custom 'Resource' post type to display resources on your website.
 * Author: Michael Weiner
 * Author URI: https://www.michaelweiner.org/
 * Version: 1.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit plugin if it is being accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Call in all dependencies to other files
 */
require_once plugin_dir_path(__FILE__) . 'maw-cmb2-fields.php';
require_once plugin_dir_path(__FILE__) . 'maw-resources-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'maw-resources-post-type.php';


/*
 *
 * START: Register Stylesheets
 *
 */
function maw_custom_resources_stylesheet() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style1', $plugin_url . 'includes/styles/resources.css' );
}
add_action( 'wp_enqueue_scripts', 'maw_custom_resources_stylesheet' );
/*
 *
 * END: Register Stylesheets
 *
 */