<?php
/*
 * Plugin Name: MAW Resources
 * Plugin URI: https://www.michaelweiner.org/
 * Description: A plugin to create a custom post type to display resources on your website.
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


/*
 *
 * START: Include Custom Single Page Layout for the Resources Post Type
 *
 */
function maw_resources_single_page_template( $maw_resources_single_template ) {
    global $post;

    if ( $post -> post_type == 'maw-resources') {
        $maw_resources_single_template = plugin_dir_path(__FILE__) . '/includes/template-overrides/single-maw-resources.php';
    }
    return $maw_resources_single_template;
}
add_filter( 'single_template', 'maw_resources_single_page_template' );
/*
 *
 * END: Include Custom Single Page Layout for the Resources Post Type
 *
 */


/*
 *
 * START: Include Custom Archive Page Layout for the Resources Post Type
 *
 */
function maw_resources_archive_page_template( $maw_resources_single_template ) {
    global $post;

    if ( $post -> post_type == 'maw-resources') {
        $maw_resources_archive_template = plugin_dir_path(__FILE__) . '/includes/template-overrides/archive-maw-resources.php';
    }
    return $maw_resources_archive_template;
}
add_filter( 'archive_template', 'maw_resources_archive_page_template' );
/*
 *
 * END: Include Custom Archive Page Layout for the Resources Post Type
 *
 */


/*
 *
 * START: Sort Resources By Date Custom Field on Archive Page
 *
 */
function sort_by_date_on_archive_for_mw_resources( $query ) {
    if ( is_post_type_archive( 'maw-resources') ) {
       $query->set('meta_key', 'maw-resource-publish-date');
       $query->set('orderby', 'meta_value');
       $query->set('order', 'DESC');
       return;
    }
 }
 add_filter( 'pre_get_posts', 'sort_by_date_on_archive_for_mw_resources', 1);
/*
 *
 * END: Include Custom Archive Page Layout for the Resources Post Type
 *
 */


/*
 *
 * START: Set Posts Per Page on Archive Template for maw-resources
 *
 */
function post_per_archive_page_maw_resources( $query ) {
    if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'maw-resources' ) ) {
		$query->set( 'posts_per_page', '25' );
	}

}
add_action( 'pre_get_posts', 'post_per_archive_page_maw_resources' );
/*
 *
 * END: Set Posts Per Page on Archive Template for maw-resources
 *
 */