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

                <?php
                echo '<div class="mw-archive-header">';
                echo '<center><h1> Archive: Resources</h1></center>';
                echo '<center><p>Below is an archive of published resources sorted by publish date of the resource.</p></center>';
                echo '<hr>';
                echo '<p></p></div>';

                if(have_posts()) : while(have_posts()) : the_post();
                    
                    echo '<article><h2><a href=' . esc_html( get_permalink() ) . '>';
                    the_title();
                    echo '</a></h2>';

                    echo '<p class="mw-post-meta-date">';
                    echo date('F j, Y', get_post_meta( get_the_ID(), 'maw-resource-publish-date', true ) );
                    echo '</p>';

                    echo '<p></p></article>';

                    endwhile;

                    echo '<hr />';

                    echo '<div class="maw-resources-pagination">';
                    echo '<div class="row">';
                    echo '<div class="small-12 columns">';
                    
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => 'Previous',
                        'next_text' => 'Next',
                    ) );
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    else: 
                    echo '<p>Sorry, no posts matched your criteria.</p>';

                endif;

                wp_reset_postdata(); // Clear the query data for future queries
                
                ?>

        </div>
    </div>
</div>

<?php
get_footer();
?>