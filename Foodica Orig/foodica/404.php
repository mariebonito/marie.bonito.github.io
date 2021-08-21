<?php get_header(); ?>

<main id="main" class="site-main" role="main">

    <section class="content-area">

        <?php
            if ( function_exists('yoast_breadcrumb') ) {
              yoast_breadcrumb( '<div class="wpz_breadcrumbs">','</div>' );
            }
        ?>

        <header class="page-header">

            <h1 class="entry-title"><?php _e( 'Error 404', 'wpzoom' ); ?></h1>

        </header><!-- .page-header -->

        <?php get_template_part( 'content', 'none' ); ?>

    </section><!-- .content-area -->

    <?php get_sidebar(); ?>

</main><!-- .site-main -->

<?php
get_footer();
