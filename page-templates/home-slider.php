<?php
/*
Template Name: Homepage
*/
?>
<?php
get_header(); ?>

<?php if ( option::is_on( 'featured_posts_show' ) ) : ?>

    <?php get_template_part( 'wpzoom-slider' ); ?>

<?php endif; ?>


<main id="main" class="site-main" role="main">

    <?php if ( is_active_sidebar( 'homepage-top' ) ) : ?>

        <section class="home-widgetized-sections">

            <?php dynamic_sidebar( 'homepage-top' ); ?>

        </section><!-- .home-widgetized-sections -->

    <?php endif; ?>


    <?php if ( is_active_sidebar( 'homepage-1' ) ||  is_active_sidebar( 'homepage-2'  )  ||  is_active_sidebar( 'homepage-3'  ) ) : ?>
        <div class="column-widgets">

            <?php if ( is_active_sidebar( 'homepage-1'  ) ) { ?>
                <div class="widget-column">
                    <?php dynamic_sidebar('homepage-1'); ?>
                </div><!-- .column -->
            <?php } ?>

            <?php if ( is_active_sidebar( 'homepage-2'  ) ) { ?>
                <div class="widget-column">
                    <?php dynamic_sidebar('homepage-2'); ?>
                </div><!-- .column -->
            <?php } ?>

            <?php if ( is_active_sidebar( 'homepage-3'  ) ) { ?>
                <div class="widget-column">
                    <?php dynamic_sidebar('homepage-3'); ?>
                </div><!-- .column -->
            <?php } ?>

        </div>

    <?php endif; ?>


    <section class="content-area full-layout">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; // end of the loop. ?>

    </section><!-- .content-area -->


</main><!-- .site-main -->


<?php
get_footer();