<?php
/**
 * The template for displaying the footer
 *
 */

$widgets_areas = (int) get_theme_mod( 'footer-widget-areas', zoom_customizer_get_default_option_value( 'footer-widget-areas', foodica_customizer_data() ) );

$has_active_sidebar = false;
if ( $widgets_areas > 0 ) {
    $i = 1;

    while ( $i <= $widgets_areas ) {
        if ( is_active_sidebar( 'footer_' . $i ) ) {
            $has_active_sidebar = true;
            break;
        }

        $i++;
    }
}

?>

    </div><!-- ./inner-wrap -->

    <footer id="colophon" class="site-footer" role="contentinfo">


        <?php if ( is_active_sidebar( 'widgetized_section' ) ) : ?>

            <section class="site-widgetized-section section-footer">
                <div class="widgets clearfix">

                    <?php dynamic_sidebar( 'widgetized_section' ); ?>

                </div>
            </section><!-- .site-widgetized-section -->

        <?php endif; ?>


        <?php if ( $has_active_sidebar ) : ?>

            <div class="inner-wrap">

                <div class="footer-widgets widgets widget-columns-<?php echo esc_attr( $widgets_areas ); ?>">
                    <?php for ( $i = 1; $i <= $widgets_areas; $i ++ ) : ?>

                        <div class="column">
                            <?php dynamic_sidebar( 'footer_' . $i ); ?>
                        </div><!-- .column -->

                    <?php endfor; ?>

                    <div class="clear"></div>
                </div><!-- .footer-widgets -->

            </div>


        <?php endif; ?>


        <?php if ( has_nav_menu( 'tertiary' ) ) { ?>

            <div class="footer-menu">
                <div class="inner-wrap">
                    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-footer', 'theme_location' => 'tertiary', 'depth' => '1' ) ); ?>
                </div>
            </div>

        <?php } ?>


        <div class="site-info">

            <span class="copyright"><?php zoom_customizer_partial_blogcopyright(); ?></span>

            <span class="designed-by"><?php printf( __( '&mdash; Designed by %s', 'wpzoom' ), '<a href="https://www.wpzoom.com/" target="_blank" rel="nofollow">WPZOOM</a>' ); ?></span>

            <?php if ( is_active_sidebar( 'footer-copyright' ) ) : ?>
                <div class="footer-disclosure_wpz">
                    <?php dynamic_sidebar( 'footer-copyright' ); ?>
                </div>
            <?php endif; ?>

        </div><!-- .site-info -->
    </footer><!-- #colophon -->

</div>
<?php wp_footer(); ?>

<script type="text/javascript">
    if(navigator.userAgent.toLowerCase().indexOf('firefox') > -1){
        window.addEventListener('unload', function(event) {
        });
    }
</script>

</body>
</html>