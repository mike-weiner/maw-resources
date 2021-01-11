<?php
// Exit plugin if it is being accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$maw_publisher_name_text = get_post_meta( get_the_ID(), 'maw-resource-publisher', true );
$maw_publication_publish_date_text = get_post_meta( get_the_ID(), 'maw-resource-publish-date', true );
$maw_resource_description_text = get_post_meta( get_the_ID(), 'maw-resource-description', true );
$maw_publisher_url = get_post_meta( get_the_ID(), 'maw-resource-url', true );
?>

<div class="container">
    <div id="content-area" class="clearfix">
        <div id="maw-post-content">
            <div id="maw-post-title-meta">
                <h2><?php echo get_the_title( $post_id ); ?></h2>

                <p id="maw-post-resource-date-field">
                    <?php echo date('F j, Y', $maw_publication_publish_date_text ); ?>
                </p>
            </div>

            <div id="maw-post-content-description"> 
                <p>
                    <?php echo esc_html( $maw_resource_description_text ); ?>
                </p>
            </div>

            <div id="maw-post-link">
                <p id="maw-post-link-text"><a href=<?php echo esc_html( $maw_publisher_url); ?> target="_blank">View Resource ></p></a>
            </div>


            <?php if($maw_publisher_name_text != "") { ?>

            <div id="maw-publisher-thank-you">
                <p id="maw-publisher-thank-you-text">A special thank you to <?php echo esc_html( $maw_publisher_name_text ); ?> as the original publisher of this resource.</p>
            </div>
            
            <?php } ?>

        </div>
    </div>
</div>

<?php
wp_reset_postdata(); // Clear the query data for future queries
get_footer();