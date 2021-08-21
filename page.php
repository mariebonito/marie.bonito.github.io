<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="content-area">

                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                      yoast_breadcrumb( '<div class="wpz_breadcrumbs">','</div>' );
                    }
                ?>

                <?php get_template_part( 'content', 'page' ); ?>

                <?php if (option::get('comments_page') == 'on') { ?>
                    <?php comments_template(); ?>
                <?php } ?>

            </div>

        <?php endwhile; // end of the loop. ?>

        <?php get_sidebar(); ?>

    </main><!-- #main -->

<?php get_footer(); ?>