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
* START: Custom Shortcode
* https://developer.wordpress.org/reference/classes/wp_query/
*
*/
function maw_resources_posts_shortcode($atts) {

extract(shortcode_atts(array(
'cat'     => '',
'ignore_sticky_posts' => false,
'maw_show_resource_author' => true,
'maw_show_resource_description' => true,
'meta_key' => '',
'num'     => '5',
'order'   => 'ASC',
'orderby' => 'title',
'offset'  => '',
'page_id' => '',
'post_type' => 'maw-resources',
'tag' => '',
), $atts));

$args = array(
'cat'            => $cat,
'maw_show_resource_author' => $maw_show_resource_author,
'maw_show_resource_description' => $maw_show_resource_description,
'meta_key' => $meta_key,
'posts_per_page' => $num,
'offset'         =>  $offset,
'order'          => $order,
'orderby'        => $orderby,
'page_id'        => $page_id,
'post_type'      => $post_type,
'num'     => $num,
'tag'            => $tag,
);

/*
*  Extract values of the custom shortcode modifiers
*/
$maw_display_show_author = esc_attr($args['maw_show_resource_author']);
$maw_display_show_description = esc_attr($args['maw_show_resource_description']);

$maw_output = ''; // Establish variable to print HTML for display

$maw_query = new WP_Query( $args );
if( $maw_query->have_posts() ){

/*
* Begin HTML Output
*/
$maw_output .= '<div class="maw_container"><div class="maw_header"><div class="maw_title">Name</div><div class="maw_link">Link</div><br class="maw_clear"></div>';

    while( $maw_query->have_posts() ){
    $maw_query->the_post();

    /*
    * Get the various resource post attributes
    */
    $maw_resource_id = get_the_ID(); // Get the id of the resource
    $maw_resource_title = get_the_title(); // Get and store the title of the resource
    $maw_resource_author = get_post_meta($maw_resource_id, 'maw-resource-publisher', true); // Store the resource's publishing entity entered by the user
    $maw_resource_date = get_post_meta($maw_resource_id, 'maw-publish-date', true); // Store the resource's publication date entered by the user
    $maw_resource_url = get_post_meta($maw_resource_id, 'maw-resource-url', true); // Store the resource's URL
    $maw_resource_description = get_post_meta($maw_resource_id, 'maw-resource-description', true); // Store the resource's description entered by the user

    /*
    * Finish HTML Output
    */
    $maw_output .= '<div class="maw_item">'; // Add the <div> for the item
            $maw_output .= '<div class="maw_title"><b>'. $maw_resource_title .'</b>'; // Add the title <div> and the title of the post

                    if ($maw_display_show_author === 'false' || $maw_resource_author == null) { // Check to see if the user has disallowed the author in the display OR that the the resource has an author and if so, hide it
                    } else {
                    $maw_output .= '<div class="maw_resource_author"><em>Published By: '. $maw_resource_author .'</em></div>';
                    }

                    if ($maw_display_show_description === 'false' || $maw_resource_description == null) { // Check to see if the user has disallowed the description in the display OR that the resource does not have a short description, and if so hide it
                    } else {
                    $maw_output .= '<div class="maw_resource_description">'. $maw_resource_description .'<br class="maw_clear"></div>';

                    }

                    if ($maw_resource_url != null) { // Check to see if the resource has a URL, and if so display it
                    $maw_output .= '</div><div class="maw_link"><a href="'. get_post_meta($maw_resource_id, 'maw-resource-url', true) .'" title="View Resource" target="_blank">View Resource</a><br></div><br class="maw_clear"></div>';
            } else {
            $maw_output .= '</div><br class="maw_clear"></div>';
    }
    }
    $maw_output .= '</div></div></div>'; // Close maw_item, maw_header, and maw_container
} else {
$maw_output .= '<div><p class="maw_empty_message">We are sorry. There are no posts that fit your criteria to display.</p></div>'; // Return error message if no shortcode requirements find any matching posts
}

wp_reset_postdata(); // Clear the query data for future queries

return $maw_output; // Return the HTML to be displayed
}
add_shortcode('maw_resources', 'maw_resources_posts_shortcode');
/*
*
* END: Custom Shortcode
*
*/
