<?php
/**
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
 * Remove this before going live
 * <div class="maw_date">Date</div>
 * <div class="maw_date">'. get_the_date('m-d-Y') .'</div>
 *
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
 * Custom Post Type Start
 * https://developer.wordpress.org/reference/functions/register_post_type/#parameters
 *
 * */
function maw_resources_custom_post_type() {
    $supports = array(
        'title', // Post title
        'editor', // Post content
        'author', // Post author
        'thumbnail', // Featured images
        'excerpt', // Post excerpt
        'custom-fields', // Custom fields
        'comments', // Post comments
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
        'publicly_queryable' => true,
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
 * END: Custom Post Type 'Developer Notes'
 *
 * */


/*
 *
 * START: Custom Shortcode
 *
 */

// Register Stylesheets
function maw_custom_resources_stylesheet() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style1', $plugin_url . 'includes/styles/resources.css' );
}
add_action( 'wp_enqueue_scripts', 'maw_custom_resources_stylesheet' );

// Create custom shortcode
function maw_resources_posts_shortcode($atts) {

    extract(shortcode_atts(array(
        'cat'     => '',
        'tag' => '',
        'num'     => '5',
        'order'   => 'ASC',
        'orderby' => 'title',
        'post_status' => 'publish',
        'post_type' => 'maw-resources',
    ), $atts));

    $args = array(
        'cat'            => $cat,
        'tag'            => $tag,
        'posts_per_page' => $num,
        'order'          => $order,
        'orderby'        => $orderby,
        'post_status'    => $post_status,
        'post_type'      => $post_type,
    );

    $output = ''; // Establish variable to print

    $query = new WP_Query( $args );
    if( $query->have_posts() ){

        $output .= '<div class="maw_container"><div class="maw_header"><div class="maw_title">Resource</div><div class="maw_link">Content</div><br class="maw_clear"></div>';

        while( $query->have_posts() ){
            $query->the_post();
            $output .= '<div class="maw_item"><div class="maw_title"><b>'. get_the_title() .'</b></div><div class="maw_link"><a href="'. get_the_permalink() .'" title="View Resource" target="_blank">View Resource</a><br></div><br class="maw_clear"></div>';
        }
        $output .= '</div>';
    } else {
        $output .= '<div><p class="maw_empty_message">We are sorry. There are no posts that fit your criteria to display.</p></div>';
    }
    wp_reset_postdata();

    return $output;

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
function maw_cmb2_metaboxes() {
    // Establish prefix to use for all fields
    $prefix = 'maw-';

    /*
     * Initiate Metabox Area on Post/Page
     */
    $maw_article_cmb_area = new_cmb2_box( array(
        'id'            => $prefix . 'article_metabox',
        'title'         => __( 'Article', 'cmb2' ),
        'object_types'  => array('maw-resources' ), // Set what pages/posts this metabox area is available on
        'context'       => 'normal',
        'priority'      => 'high', // Set priority of metabox area
        'show_names'    => true, // Show field names on the left
        'closed'     => false, // Keep the metabox closed by default
    ) );

    /*
     * Add text field to 'Article' metabox area
     */
    $maw_article_cmb_area->add_field( array(
        'name'       => __( 'Article Name', 'cmb2' ),
        'desc'       => __( 'Enter the Name of the Article', 'cmb2' ),
        'id'         => $prefix . 'article-name',
        'type'       => 'text', // Set type of field
        'char_counter' => 'characters',
        'char_max' => 25,
        'char_max_enforce' => false,
        'text'    => array(
            'characters_left_text' => 'Characters Left',
            'characters_text' => 'Characters',
            'characters_truncated_text' => 'Keep your entry to 25 characters or less, please!',
        ),
        'show_on_cb' => 'cmb2_hide_if_no_cats', // Function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // Custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // Custom escaping callback parameter
        // 'on_front'        => false, // Optionally designate a field to wp-admin only
        // 'repeatable'      => true,
    ) );

    /*
     * Add text field with URL type to 'Article' metabox area
     */
    $maw_article_cmb_area->add_field( array(
        'name' => __( 'Article URL', 'cmb2' ),
        'desc' => __( 'Enter the URL of the Article', 'cmb2' ),
        'id'   => $prefix . 'article-url',
        'type' => 'text_url', // Set type of field
        // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
        // 'repeatable' => true,
    ) );

    /*
     * Add email text field with URL type to 'Article' metabox area
     */
    $maw_article_cmb_area->add_field( array(
        'name' => __( 'Author Email Address', 'cmb2' ),
        'desc' => __( 'Enter the Email Address of the Author (optional)', 'cmb2' ),
        'id'   => $prefix . 'author-email',
        'type' => 'text_email', // Set the tye of field
        'repeatable' => false,
    ) );
}
add_action( 'cmb2_admin_init', 'maw_cmb2_metaboxes' );
/*
 *
 * END: CMB2
 *
 */
