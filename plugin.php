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
 * START: Sort Resources Post Type in Alphabetical Order on Admin Page
 *
 */
function maw_sort_resources_post_by_title($query) {

    if($query->is_admin) { // Check to see if the query is coming from an admin page

        if ($query->get('post_type') == 'maw-resources') // Check to make sure that this query only targets certain post types
        {
            $query->set('orderby', 'title'); // Order by Title
            $query->set('order', 'ASC'); // Order the list in ascending order
        }
    }
    return $query; // Return the custom query
}
add_filter('pre_get_posts', 'maw_sort_resources_post_by_title');
/*
 *
 * END: Sort Resources Post Type in Alphabetical Order on Admin Page
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


/*
 *
 * START: Custom Post Type 'maw-resources'
 * https://developer.wordpress.org/reference/functions/register_post_type/#parameters
 *
 */
function maw_resources_custom_post_type() {
    $supports = array(
        'title', // Post title
        'editor', // Post content
        'author', // Post author
        //'thumbnail', // Featured images
        //'excerpt', // Post excerpt
        'custom-fields', // Custom fields
        //'comments', // Post comments
        'revisions', // Post revisions
        'post-formats', // Post formats
    );

    $labels = array(
        'name' => _x('Resources', 'plural'),
        'singular_name' => _x('Resource', 'singular'),
        'menu_name' => _x('Resources', 'admin menu'),
        'name_admin_bar' => _x('Resources', 'admin bar'),
        'add_new' => _x('Add New Resource', 'add new'),
        'add_new_item' => __('Add New Resource'),
        'new_item' => __('New Resource'),
        'edit_item' => __('Edit Resource'),
        'view_item' => __('View Resource'),
        'all_items' => __('All Resources'),
        'search_items' => __('Search Resources'),
        'not_found' => __('No Resources Found.'),
    );

    $args = array(
        'labels' => $labels,
        'description' => 'A custom post type to display resources.',
        'public' => true,
        'hierarchical' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true, // Set this to be false to hide the single and archive page
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => $supports,
        'has_archive' => true,
        'rewrite' => array('slug' => 'maw-resources'),
        'query_var' => true,
        'taxonomies' => array( 'category', 'post_tag' ),
    );
    register_post_type('maw-resources', $args); // Register our post type with Wordpress
}
add_action('init', 'maw_resources_custom_post_type');
/*
 *
 * END: Custom Post Type 'maw-resources'
 *
 */


/*
 *
 * START: Disable comments on 'maw-resources' post type
 *
 */
function maw_resources_post_type_disable_comments( $post_id ) {
    $post_type = get_post_type( $post_id );
    if ( $post_type == 'maw-resources' ) {
        return false;
    }
}
add_filter( 'comments_open', 'my_prefix_comments_open', 10 , 1 );
/*
 *
 * END: Disable comments on 'maw-resources' post type
 *
 */


/*
 *
 * START: Custom Shortcode
 * https://developer.wordpress.org/reference/classes/wp_query/
 *
 */
function maw_resources_posts_shortcode($atts) {

    extract(shortcode_atts(array(
        'cat'     => '',
        'ignore_sticky_posts' => false,
        'num'     => '5',
        'order'   => 'ASC',
        'orderby' => 'title',
        'offset'  => '0',
        'meta_key' => '',
        'post_type' => 'maw-resources',
        'tag' => '',
    ), $atts));

    $args = array(
        'cat'            => $cat,
        'meta_key' => $meta_key,
        'posts_per_page' => $num,
        'offset'         =>  $offset,
        'order'          => $order,
        'orderby'        => $orderby,
        'post_type'      => $post_type,
        'tag'            => $tag,
    );

    $maw_output = ''; // Establish variable to print

    $maw_query = new WP_Query( $args );
    if( $maw_query->have_posts() ){

        $maw_output .= '<div class="maw_container"><div class="maw_header"><div class="maw_title">Name</div><div class="maw_link">Link</div><br class="maw_clear"></div>';

        while( $maw_query->have_posts() ){
            $maw_query->the_post();

            $maw_post_id = get_the_ID(); // Get the id of the resource
            $maw_resource_url = get_post_meta($maw_post_id, 'maw-resource-url', true); // Store the resource URL

            if ($maw_resource_url != null) { // If the resource does not have a URL (use our $maw_resource_url variable) then do not display it
                $maw_output .= '<div class="maw_item"><div class="maw_title"><b>'. get_the_title() .'</b> <?php if (get_the_author() != null) {?> <br /> <em>Published By: '. get_the_author() .'</em> <?php } ?></div><div class="maw_link"><a href="'. get_post_meta($maw_post_id, 'maw-resource-url', true) .'" title="View Resource" target="_blank">View Resource</a><br></div><br class="maw_clear"></div>';
            } else {
                $maw_output .= '<div class="maw_item"><div class="maw_title"><b>'. get_the_title() .'</b> <?php if (get_the_author() != null) {?> <br /> <em>Published By: '. get_the_author() .'</em> <?php } ?></div><br class="maw_clear"></div>';
            }
        }
        $maw_output .= '</div>';
    } else {
        $maw_output .= '<div><p class="maw_empty_message">We are sorry. There are no posts that fit your criteria to display.</p></div>';
    }
    wp_reset_postdata();

    return $maw_output;

}
add_shortcode('maw_resources', 'maw_resources_posts_shortcode');
/*
 *
 * END: Custom Shortcode
 *
 */


/*
 *
 * START: CMB2
 *
 */
function maw_cmb2_metaboxes_initialize()
{
    // Establish prefix to use for all fields
    $maw_prefix = 'maw-';

    /*
     * Initiate Metabox Area on Post/Page
     */
    $maw_article_cmb_area = new_cmb2_box(array(
        'id' => $maw_prefix . 'resource_metabox',
        'title' => __('Resource Information', 'cmb2'),
        'object_types' => array('maw-resources'), // Set what pages/posts this metabox area is available on
        'context' => 'normal',
        'priority' => 'high', // Set priority of metabox area
        'show_names' => true, // Show field names on the left
        'closed' => false, // Keep the metabox closed by default
    ));

    /*
    * Date of publication date selector to 'Resource' metabox area
    */
    $maw_article_cmb_area->add_field( array(
        'name' => 'Publication Date of Resource',
        'id'   => $maw_prefix . 'resource-publish-date',
        'type' => 'text_date_timestamp',
        // 'timezone_meta_key' => 'wiki_test_timezone',
        // 'date_format' => 'l jS \of F Y',
    ) );

    /*
     * Add URL text field with URL type to 'Resource' metabox area
     */
    $maw_article_cmb_area->add_field(array(
        'name' => __('Link to Resource', 'cmb2'),
        'desc' => __('Enter the link to the resource.', 'cmb2'),
        'id' => $maw_prefix . 'resource-url',
        'type' => 'text_url', // Set type of field
        // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
    ));

    /*
     * Add Short description field to 'Resource" metabox area
     */
    $maw_article_cmb_area->add_field(array(
        'name' => __('Short Description', 'cmb2'),
        'desc' => __('Enter a short description of what this resource is.', 'cmb2'),
        'id' => $maw_prefix . 'resource-description',
        'type' => 'textarea_small', // Set type of field
    ));
}
add_action( 'cmb2_admin_init', 'maw_cmb2_metaboxes_initialize' );
/*
 *
 * END: CMB2
 *
 */
