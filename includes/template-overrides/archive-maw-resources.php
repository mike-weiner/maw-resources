<?php
// Exit plugin if it is being accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="container">
    <div id="content-area" class="clearfix">
        <div id="maw-post-content">

            <div class="mw-archive-header">
                <center><h1> Archive: Resources</h1></center>
                <center><p>Below is an archive of published resources sorted by publish date of the resource.</p></center>
                <hr>
                <p></p>
            </div>

            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                <article>
                    <a href=" <?php echo esc_html( get_permalink() ); ?> ">
                        <?php echo esc_html( the_title('<h2>', '</h2>') ); ?>
                    </a>

                    <p class="mw-post-meta-date">
                        <?php echo esc_html( date('F j, Y', get_post_meta( get_the_ID(), 'maw-resource-publish-date', true)) ); ?>
                    </p>

                    <p></p>

                </article>

                <?php endwhile; ?>

                <hr />

                <div class="maw-resources-pagination">
                    <div class="row">
                        <div class="small-12 columns">

                            <?php

                                the_posts_pagination( array(
                                    'mid_size'  => 2,
                                    'prev_text' => 'Previous',
                                    'next_text' => 'Next',
                                ) );

                            ?>

                        </div>
                    </div>
                </div>

                <?php else: ?>
                    <p>Sorry, no posts matched your criteria.</p>
            <?php endif; ?>
            
        </div>
    </div>
</div>

<?php
wp_reset_postdata(); // Clear the query data for future queries
get_footer();