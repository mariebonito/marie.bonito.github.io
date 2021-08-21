<?php
/*
Template Name: Full-width Page
*/

get_header(); ?>

    <main id="main" class="site-main full-width-page" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                  yoast_breadcrumb( '<div class="wpz_breadcrumbs">','</div>' );
                }
            ?>

            <?php get_template_part( 'content', 'page' ); ?>

            <?php if (option::get('comments_page') == 'on') { ?>
                <?php comments_template(); ?>
            <?php } ?>

        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->

<?php get_footer(); ?>