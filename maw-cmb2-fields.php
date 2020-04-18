<?php
// Exit plugin if it is being accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 *
 * START: CMB2
 *
 */
function maw_cmb2_metaboxes_initialize() {
    global $post;
    
    $author_id = $post->post_author; // Store current post's Author ID#
    $user_id = wp_get_current_user(); // Store current user's ID#

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
        'name' => 'Publication Date of Resource*',
        'id'   => $maw_prefix . 'resource-publish-date',
        'type' => 'text_date_timestamp',
        'attributes'  => array(
            'required'    => 'required',
            'disabled'    => ($author_id == $user_id), // Disable field if current user is not originator of resource
        ),
    ) );

    /*
     * Add URL text field with URL type to 'Resource' metabox area
     */
    $maw_article_cmb_area->add_field(array(
        'name' => __('Link to Resource*', 'cmb2'),
        'desc' => __('Enter the full web address to the resource. This can be a link to any website, PDF, word document, etc.', 'cmb2'),
        'id' => $maw_prefix . 'resource-url',
        'type' => 'text_url', // Set type of field
        'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
    ));

    /*
     * Add text field for resource publisher
     */
    $maw_article_cmb_area->add_field(array(
        'name' => __('Resource Publisher', 'cmb2'),
        'desc' => __('Enter the name of the person/company/non-profit that provides this resource.', 'cmb2'),
        'id' => $maw_prefix . 'resource-publisher',
        'type' => 'text', // Set type of field
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
