<?php
    $header_layout = get_theme_mod('header-layout-type', zoom_customizer_get_default_option_value('header-layout-type', foodica_customizer_data()));
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="preload" as="font" href="<?php echo get_bloginfo('template_url'); ?>/fonts/foodica.ttf" type="font/ttf" crossorigin>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="page-wrap">

    <header class="site-header <?php echo $header_layout; ?>">

        <nav class="top-navbar" role="navigation">

            <div class="inner-wrap">

                <div class="header_social">
                    <?php dynamic_sidebar('header_social'); ?>

                </div>

                <div id="navbar-top">

                    <?php if (has_nav_menu( 'secondary' )) {
                        wp_nav_menu( array(
                            'menu_class'     => 'navbar-wpz dropdown sf-menu',
                            'theme_location' => 'secondary'
                        ) );
                    } ?>

                </div><!-- #navbar-top -->

            </div><!-- ./inner-wrap -->

        </nav><!-- .navbar -->

        <div class="clear"></div>


        <div class="inner-wrap logo_wrapper_main">

            <?php foodica_site_title(); ?>

            <?php if (option::is_on('ad_head_select')) { ?>
                <div class="adv">

                    <?php if ( option::get('ad_head_code') <> "") {
                        echo stripslashes(option::get('ad_head_code'));
                    } else { ?>
                        <a href="<?php echo option::get('banner_top_url'); ?>" target="_blank"><img src="<?php echo option::get('banner_top'); ?>" alt="<?php echo option::get('banner_top_alt'); ?>" /></a>
                    <?php } ?>

                </div><!-- /.adv --> <div class="clear"></div>
            <?php } ?>

            <?php if ( $header_layout == 'wpz_header_layout_compact' ) { ?>

                <div id="sb-search" class="sb-search">
                    <?php get_search_form(); ?>
                </div>
            <?php } ?>


            <?php if ( $header_layout == 'wpz_header_layout_compact' ) { ?>

                <div class="navbar-header-compact">
                    <?php if ( has_nav_menu( 'mobile' ) ) { ?>

                       <?php wp_nav_menu( array(
                           'container_id'   => 'menu-main-slide_compact',
                           'theme_location' => 'mobile',
                           'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . foodica_wc_menu_cartitem() . '</ul>'
                       ) );
                   } elseif ( has_nav_menu( 'primary' ) ) {
                       wp_nav_menu( array(
                          'container_id'   => 'menu-main-slide_compact',
                         'theme_location' => 'primary',
                         'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . foodica_wc_menu_cartitem() . '</ul>'
                      ) );
                   } ?>

                </div>

            <?php } ?>

        </div>


        <nav class="main-navbar" role="navigation">

            <div class="inner-wrap">

                <div id="sb-search" class="sb-search">
                    <?php get_search_form(); ?>
                </div>

                <div class="navbar-header-main">
                    <?php if ( has_nav_menu( 'mobile' ) ) { ?>

                       <?php wp_nav_menu( array(
                           'container_id'   => 'menu-main-slide',
                           'theme_location' => 'mobile',
                           'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . foodica_wc_menu_cartitem() . '</ul>'
                       ) );
                   } elseif ( has_nav_menu( 'primary' ) ) {
                       wp_nav_menu( array(
                          'container_id'   => 'menu-main-slide',
                         'theme_location' => 'primary',
                         'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . foodica_wc_menu_cartitem() . '</ul>'
                      ) );
                   } ?>

                </div>


                <div id="navbar-main">

                    <?php if (has_nav_menu( 'primary' )) {
                        wp_nav_menu( array(
                            'menu_class'     => 'navbar-wpz dropdown sf-menu',
                            'theme_location' => 'primary',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . foodica_wc_menu_cartitem() . '</ul>'
                        ) );
                    } ?>

                </div><!-- #navbar-main -->

            </div><!-- ./inner-wrap -->

        </nav><!-- .navbar -->

        <div class="clear"></div>

    </header><!-- .site-header -->

    <div class="inner-wrap">