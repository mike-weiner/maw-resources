<?php
get_header();

$maw_publisher_name_text = get_post_meta( get_the_ID(), 'maw-resource-publisher', true );
$maw_publication_publish_date_text = get_post_meta( get_the_ID(), 'maw-resource-publish-date', true );
$maw_resource_description_text = get_post_meta( get_the_ID(), 'maw-resource-description', true );
$maw_publisher_url = get_post_meta( get_the_ID(), 'maw-resource-url', true );
?>

    <div class="container">
        <div id="content-area" class="clearfix">
            <div id="maw-post-content" style="padding: 4em;">
                <div id="maw-post-title-meta" style="margin-bottom: 1em;">
                    <h2>Post Title</h2>

                    <p id="maw-post-resource-date-field">
                        <?php echo date('F j, Y', $maw_publication_publish_date_text ); ?>
                    </p>
                </div>

                <div class="maw_clear"></div>

                <div id="maw-post-content-description" style="margin-bottom: 1em;"> 
                    <p>
                        <?php echo esc_html( $maw_resource_description_text ); ?>
                    </p>
                </div>

                <div id="maw-post-link" style="margin-bottom: 1em;">
                    <a href=<?php echo esc_html( $maw_publisher_url); ?> target="_blank"><p id="maw-post-link-text">View Resource ></p></a>
                </div>


                <?php if($maw_publisher_name_text != "") { ?>

                    <div id="maw-publisher-thank-you" style="width=100%; background:#f2f2f2; padding:10px;">
                        <p style="text-align: center;">A special thank you to <?php echo esc_html( $maw_publisher_name_text ); ?> as the original publisher of this resource.</p>
                    </div>
                
                <?php } ?>

            </div>
        </div>
    </div>

<?php
get_footer();