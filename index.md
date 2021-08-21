<?php
/**
 * The main template file.
 */

get_header(); ?>

<?php $template = option::get( 'layout_home' ); ?>


<?php if ( option::is_on( 'featured_posts_show' ) && is_front_page() && $paged < 2) : ?>

    <?php get_template_part( 'wpzoom-slider' ); ?>

<?php endif; ?>

<main id="main" class="site-main" role="main">

    <?php if ( is_active_sidebar( 'homepage-top' ) && is_front_page() && $paged < 2  ) : ?>

        <section class="home-widgetized-sections">

            <?php dynamic_sidebar( 'homepage-top' ); ?>

        </section><!-- .home-widgetized-sections -->

    <?php endif; ?>


    <?php if ( is_front_page() && $paged < 2) : ?>

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

    <?php endif; ?>


    <section class="content-area<?php if ( 'full' == $template ) { echo ' full-layout'; } ?>">

        <?php if (!option::is_on('recentposts_hide') ) { // Show Recent Posts? ?>

            <h2 class="section-title<?php if ( ( $template  == 'full' ) && (option::get('post_view') == 'List') ) { echo ' full-title'; } ?>">

                <?php if ( is_front_page() ) : ?><?php echo esc_html( option::get('recent_title') ); ?>

                <?php else: ?>

                    <?php echo get_the_title( get_option( 'page_for_posts' ) ); ?>

                <?php endif; ?>

             </h2>


            <?php if ( have_posts() ) : ?>

                <section id="recent-posts" class="recent-posts<?php if (option::get('post_view') == 'List') { echo " list-view"; } ?>">

                    <?php $banner = 0; while ( have_posts() ) : the_post(); $banner++; ?>

                        <?php if ( is_sticky() && $paged < 2 ) {

                            get_template_part( 'content', 'sticky' );

                        } else {

                            get_template_part( 'content', get_post_format() );
                        } ?>


                        <?php if ( $banner == 1 && !is_paged() ) {

                            if ( option::is_on('ad_slider_select')  ) { // Banner after first post ?>

                                <div class="adv_content">
                                <?php
                                    if ( option::get('ad_slider_code') <> "" ) {
                                        echo stripslashes(option::get('ad_slider_code'));
                                    } else {
                                        ?><a href="<?php echo option::get('banner_slider_home_url'); ?>"><img src="<?php echo option::get('banner_slider_home'); ?>" alt="<?php echo option::get('banner_slider_home_alt'); ?>" /></a><?php
                                    }

                                ?></div><?php
                            }
                        } ?>


                    <?php endwhile; ?>

                </section>


                <?php if (!option::is_on('recentposts_nav_hide') ) { // Show Navigation? ?>

                    <?php get_template_part( 'pagination' ); ?>

                <?php } // Hide navigation option? ?>

            <?php else: ?>

                <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>

        <?php } // Hide Recent Posts option? ?>


        <?php if ( is_home() && $paged < 2 ) { ?>

            <?php if ( is_active_sidebar( 'home-categories' ) ) { // Widget area for Featured Categories ?>
                <div class="section-home-featured">
                    <?php dynamic_sidebar('home-categories'); ?>
                </div>

            <?php } ?>

        <?php } ?>

        <div class="clear"></div>


    </section><!-- .content-area -->

    <?php if ( 'full' != $template ) : ?>

        <?php get_sidebar(); ?>

    <?php else : ?>

        <div class="clear"></div>

    <?php endif; ?>

</main><!-- .site-main -->

<?php
get_footer();