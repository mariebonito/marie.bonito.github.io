<?php get_header(); ?>

<?php $template = option::get( 'layout_archive' ); ?>

<main id="main" class="site-main" role="main">

    <section class="content-area<?php if ( 'full' == $template ) { echo ' full-layout'; } ?>">

        <?php
            if ( function_exists('yoast_breadcrumb') ) {
              yoast_breadcrumb( '<div class="wpz_breadcrumbs">','</div>' );
            }
        ?>

        <?php the_archive_title( '<h2 class="section-title">', '</h2>' ); ?>

        <?php if (is_category() ) { ?><div class="category_description"><?php echo category_description(); ?></div><?php } ?>

        <?php if ( have_posts() ) : ?>

            <section id="recent-posts" class="recent-posts<?php if (option::get('post_view_archive') == 'List') { echo " list-view"; } ?>">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content-archive', get_post_format() ); ?>

                <?php endwhile; ?>

            </section><!-- .recent-posts -->


            <?php get_template_part( 'pagination' ); ?>

        <?php else: ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

    </section><!-- .content-area -->

    <?php if ( 'full' != $template ) : ?>

        <?php get_sidebar(); ?>

    <?php else : ?>

        <div class="clear"></div>

    <?php endif; ?>

</main><!-- .site-main -->

<?php
get_footer();
