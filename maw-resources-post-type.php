<?php
// Exit plugin if it is being accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/*
*
* START: Custom Post Type 'maw-resources'
* https://developer.wordpress.org/reference/functions/register_post_type/#parameters
*
*/
function maw_resources_custom_post_type() {
    $supports = array(
        'title', // Post title
        //'editor', // Post content
        'author', // Post author
        //'thumbnail', // Featured images
        //'excerpt', // Post excerpt
        'custom-fields', // Custom fields
        //'comments', // Post comments
        //'revisions', // Post revisions
        //'post-formats', // Post formats
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
        'publicly_queryable' => false, // Set this to be false to hide the single and archive page
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
