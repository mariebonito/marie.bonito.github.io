<?php

    if ( option::get( 'featured_type' ) == 'Featured Posts' ) {
        $FeaturedSource = 'post';
    } else {
        $FeaturedSource = 'page';
    }


    $featured = new WP_Query( array(
        'showposts'    => option::get( 'slideshow_posts' ),
        'post__not_in' => get_option( 'sticky_posts' ),
        'meta_key'     => 'wpzoom_is_featured',
        'meta_value'   => 1,
        'orderby'     => 'menu_order date',
        'post_status' => array( 'publish' ),
        'post_type' => $FeaturedSource
    ) );

?>

<?php if ( $featured->have_posts() ) : ?>

    <div id="slider" class="<?php echo get_theme_mod('slider-styles', zoom_customizer_get_default_option_value('slider-styles', foodica_customizer_data()))?>">

		<ul class="slides clearfix">

			<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

                <?php

                $slider_style = get_theme_mod('slider-styles', zoom_customizer_get_default_option_value('slider-styles', foodica_customizer_data()));

                if ($slider_style == 'slide-style-3') {
                    $image_size = 'loop-full';
                    $reatina_image_size = 'loop-full-retina';
                } else {
                    $image_size = 'loop-sticky';
                    $reatina_image_size = 'loop-sticky-retina';
                }



                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size);
                $retina_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $reatina_image_size);
                $style = '';

                if ( false !== $large_image_url && isset( $large_image_url[0] ) ) {
                    $style = ' style="background-image:url(\'' . $large_image_url[0] . '\')" data-rjs="' . $retina_image_url[0] . '"';
                }

                ?>

                <li class="slide">

                    <div class="slide-overlay">

                        <div class="slide-header">

                           <?php if ( option::is_on( 'slider_category' ) && $FeaturedSource == 'post' ) printf( '<span class="cat-links">%s</span>', get_the_category_list( ', ' ) ); ?>

                            <?php the_title( sprintf( '<h3><a href="%s">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>


                            <?php if ($FeaturedSource == 'post') { ?>
                                <div class="entry-meta">
                                    <?php if ( option::is_on( 'slider_date' ) )     printf( '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
                                    <?php if ( option::is_on( 'slider_comments' ) ) { ?><span class="comments-link"><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>
                                </div>
                            <?php } ?>

                            <?php if ($FeaturedSource == 'page') { ?>

                                <?php the_excerpt(); ?>

                            <?php } ?>


                            <?php if ( option::is_on( 'slider_button' ) ) { ?>
                                <div class="slide_button">
                                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpzoom' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Read More', 'wpzoom'); ?></a>
                                </div>
                            <?php } ?>

                        </div>

                    </div>

                    <div class="slide-background" <?php echo $style; ?>>
                    </div>
                </li>
            <?php endwhile; ?>

		</ul>

    </div>

<?php else: ?>

    <?php if( current_user_can('editor') || current_user_can('administrator') ) { ?>

		<div class="empty-slider">
			<p><?php _e( 'If you want to add posts in the slider, just edit each post and mark it as <strong>Featured</strong>:', 'wpzoom' ); ?></p>

            <img src="https://www.wpzoom.com/wp-content/uploads/2019/08/featured.gif" />
            <br />

            <p><?php _e( 'This option is located either in the Sidebar or below the editor', 'wpzoom'); ?></p>
			<p>
				<?php
				printf(
					__( 'For more information about adding posts to the slider, please read <strong><a target="_blank" href="%1$s">theme documentation</a></strong>', 'wpzoom' ),
					'https://www.wpzoom.com/documentation/foodica/foodica-configure-homepage-slider/'
				);
				?>
			</p>
		</div>

    <?php } ?>

<?php endif; ?>