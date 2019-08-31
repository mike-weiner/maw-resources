<?php
/*
 * Plugin Name: MAW-Resources
 * Plugin URI: https://thetechsurge.com/
 * Description: A plugin to create a custom post type to display resources on your website.
 * Author: Michael Weiner
 * Author URI: https://thetechsurge.com/
 * Version: 0.1
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


/*
 *
 * START: Include Custom Page Layout for the Resources Post Type
 *
 */
function maw_resources_page_template( $maw_resources_single_template ) {
    global $post;

    if ( $post -> post_type == 'maw-resources') {
        $maw_resources_single_template = plugin_dir_path(__FILE__) . '/includes/template-overrides/single-maw-resources.php';
    }
    return $maw_resources_single_template;
}
//add_filter( 'single_template', 'maw_resources_page_template' );
/*
 *
 * END: Include Custom Page Layout for the Resources Post Type
 *
 */
