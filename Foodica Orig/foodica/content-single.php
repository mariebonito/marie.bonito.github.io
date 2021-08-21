<?php

    $template = get_post_meta($post->ID, 'wpzoom_post_template', true);
    if ($template == 'full') {
        $media_width = 1140;
        $size = "loop-full";
    }
    else {
        $media_width = 750;
        if ( option::is_on( 'post_thumb_aspect' ) ) {
            $size = "loop-large";
        } else {
            $size = "loop-sticky";
        }
    }

	$title = get_post_field( 'post_title', $post->ID, 'raw' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( option::is_on( 'post_thumb' ) && has_post_thumbnail() ) { ?>
        <div class="post-thumb">
            <?php the_post_thumbnail($size); ?>
        </div>
    <?php } ?>

    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title fn">', '</h1>' ); ?>
        <div class="entry-meta">
            <?php if ( option::is_on( 'post_author' ) )   { printf( '<span class="entry-author">%s ', __( 'Written by', 'wpzoom' ) ); the_author_posts_link(); print('</span>'); } ?>
            <?php if ( option::is_on( 'post_date' ) )     : ?><span class="entry-date"><?php _e( 'Published on', 'wpzoom' ); ?> <?php printf( '<time class="entry-date" datetime="%1$s">%2$s</time> ', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?></span> <?php endif; ?>
            <?php if ( option::is_on( 'post_date_updated' ) ) : ?><span class="entry-date"><?php _e( 'Updated on', 'wpzoom' ); ?> <?php the_modified_date(); ?></span><?php endif; ?>
            <?php if ( option::is_on( 'post_category' ) ) : ?><span class="entry-category"><?php _e( 'in', 'wpzoom' ); ?> <?php the_category( ', ' ); ?></span><?php endif; ?>
            <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>
            <div class="clear"></div>

            <?php
                if ( option::get('post_top_disclosure') <> "" ) { ?><span class="wpz_top_disclosure"><?php
                    echo stripslashes(option::get('post_top_disclosure')); ?></span><?php
                }
            ?>
        </div>
    </header><!-- .entry-header -->

    <?php if ( option::is_on( 'post_share' ) && ( option::get('post_share_location') == 'Before content' ||  option::get('post_share_location') == 'Before and after content' ) )  : ?>
        <div class="share">
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo strip_tags($title); ?>" target="_blank" title="<?php esc_attr_e( 'Tweet this on Twitter', 'wpzoom' ); ?>" class="twitter"><?php echo esc_html( option::get( 'post_share_label_twitter' ) ); ?></a>
            <a href="https://facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>&t=<?php echo strip_tags($title); ?>" target="_blank" title="<?php esc_attr_e( 'Share this on Facebook', 'wpzoom' ); ?>" class="facebook"><?php echo esc_html( option::get( 'post_share_label_facebook' ) ); ?></a>
            <?php $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
            <?php if ( option::is_on( 'post_share_pin' ) ) : ?><a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php echo strip_tags($title); ?>" data-pin-custom="true" target="_blank" count-layout="vertical" title="<?php esc_attr_e( 'Pin it to Pinterest', 'wpzoom' ); ?>" class="pinterest pin-it-button"><?php echo esc_html( option::get( 'post_share_label_pinterest' ) ); ?></a><?php endif; ?>
            <?php if ( option::is_on( 'post_share_yummly' ) ) : ?><a class="yummly" target="_blank" title="<?php esc_attr_e( 'Share this on Yummly', 'wpzoom' ); ?>" href="https://www.yummly.com/urb/verify?url=<?php echo urlencode(get_permalink($post->ID)); ?>&title=<?php echo strip_tags($title); ?>&yumtype=button"><?php echo esc_html( option::get( 'post_share_label_yummly' ) ); ?></a><?php endif; ?>
            <?php if ( option::is_on( 'post_share_print' ) ) : ?><a href="javascript:window.print()" title="<?php esc_attr_e( 'Print this Page', 'wpzoom' ); ?>" class="print"><?php echo esc_html( option::get( 'post_share_label_print' ) ); ?></a><?php endif; ?>
             <div class="clear"></div>
        </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'sidebar-post-top' ) ) : ?>
        <section class="site-widgetized-section section-single">
            <?php dynamic_sidebar( 'sidebar-post-top' ); ?>
        </section><!-- .site-widgetized-section -->
    <?php endif; ?>

    <div class="entry-content">
        <?php the_content(); ?>
        <div class="clear"></div>
        <?php if ( option::is_on('banner_post_enable')  ) { // Banner after first post ?>
            <div class="adv_content">
            <?php
                if ( option::get('banner_post_html') <> "" ) {
                    echo stripslashes(option::get('banner_post_html'));
                } else {
                    ?><a href="<?php echo option::get('banner_post_url'); ?>"><img src="<?php echo option::get('banner_post'); ?>" alt="<?php echo option::get('banner_post_alt'); ?>" /></a><?php
                }
            ?></div><?php
        } ?>
    </div><!-- .entry-content -->

</article><!-- #post-## -->

    <footer class="entry-footer">
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'wpzoom' ),
                'after'  => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
        ?>

        <?php if ( option::is_on( 'post_tags' ) ) : ?>
            <?php the_tags( '<div class="tag_list">' . __( '<h4>Tags</h4>', 'wpzoom' ). ' ', ' ',  '</div>'  ); ?>
        <?php endif; ?>

        <?php if ( option::is_on( 'post_share' ) && ( option::get('post_share_location') == 'After content' ||  option::get('post_share_location') == 'Before and after content' ) )  : ?>
            <div class="share">
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo strip_tags($title); ?>" target="_blank" title="<?php esc_attr_e( 'Tweet this on Twitter', 'wpzoom' ); ?>" class="twitter"><?php echo esc_html( option::get( 'post_share_label_twitter' ) ); ?></a>
                <a href="https://facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>&t=<?php echo strip_tags($title); ?>" target="_blank" title="<?php esc_attr_e( 'Share this on Facebook', 'wpzoom' ); ?>" class="facebook"><?php echo esc_html( option::get( 'post_share_label_facebook' ) ); ?></a>
                <?php $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                <?php if ( option::is_on( 'post_share_pin' ) ) : ?><a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php echo strip_tags($title); ?>" data-pin-custom="true" target="_blank" count-layout="vertical" title="<?php esc_attr_e( 'Pin it to Pinterest', 'wpzoom' ); ?>" class="pinterest pin-it-button"><?php echo esc_html( option::get( 'post_share_label_pinterest' ) ); ?></a><?php endif; ?>
                <?php if ( option::is_on( 'post_share_yummly' ) ) : ?><a class="yummly" target="_blank" title="<?php esc_attr_e( 'Share this on Yummly', 'wpzoom' ); ?>" href="https://www.yummly.com/urb/verify?url=<?php echo urlencode(get_permalink($post->ID)); ?>&title=<?php echo strip_tags($title); ?>&yumtype=button"><?php echo esc_html( option::get( 'post_share_label_yummly' ) ); ?></a><?php endif; ?>
                <?php if ( option::is_on( 'post_share_print' ) ) : ?><a href="javascript:window.print()" title="<?php esc_attr_e( 'Print this Page', 'wpzoom' ); ?>" class="print"><?php echo esc_html( option::get( 'post_share_label_print' ) ); ?></a><?php endif; ?>
                 <div class="clear"></div>
            </div>
        <?php endif; ?>

        <?php if ( option::is_on( 'post_author_box' ) ) : ?>
            <div class="post_author clearfix">
                <?php echo get_avatar( get_the_author_meta( 'ID' ) , 90 ); ?>
                <div class="author-description">
                    <h3 class="author-title author"><?php the_author_posts_link(); ?></h3>
                    <div class="author_links">
                        <?php if ( get_the_author_meta( 'facebook_url' ) ) { ?><a class="author_facebook" href="<?php the_author_meta( 'facebook_url' ); ?>" title="Facebook Profile" target="_blank"></a><?php } ?>
                        <?php if ( get_the_author_meta( 'twitter' ) ) { ?><a class="author_twitter" href="https://twitter.com/<?php the_author_meta( 'twitter' ); ?>" title="Follow <?php the_author_meta( 'display_name' ); ?> on Twitter" target="_blank"></a><?php } ?>
                        <?php if ( get_the_author_meta( 'instagram_url' ) ) { ?><a class="author_instagram" href="https://instagram.com/<?php the_author_meta( 'instagram_url' ); ?>" title="Instagram" target="_blank"></a><?php } ?>
                    </div>
                    <p class="author-bio">
                        <?php the_author_meta( 'description' ); ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'sidebar-post' ) ) : ?>
            <section class="site-widgetized-section section-single">
                <?php dynamic_sidebar( 'sidebar-post' ); ?>
            </section><!-- .site-widgetized-section -->
        <?php endif; ?>


        <?php if ( option::is_on( 'post_prevnext' ) ) : ?>
            <div class="prevnext">
                <?php
                $previous_post = get_previous_post();
                $next_post = get_next_post();
                if ( $previous_post != NULL ) {
                    ?><div class="previous_post_pag">
                        <div class="prevnext_container">
                             <?php if ( has_post_thumbnail( $previous_post->ID ) ) {
                                echo '<a href="' . get_permalink( $previous_post->ID ) . '" title="' . esc_attr( get_the_title($previous_post->ID) ) . '">';
                                echo get_the_post_thumbnail( $previous_post->ID, 'prevnext-small' );
                                echo '</a>';
                            } ?>
                            <a class="prevnext_title" href="<?php echo get_permalink($previous_post->ID); ?>" title="<?php echo get_the_title($previous_post->ID); ?>"><?php echo get_the_title($previous_post->ID); ?></a>
                        </div>
                    </div><?php
                }

                if ( $next_post != NULL ) {
                    ?><div class="next_post_pag">
                        <div class="prevnext_container">
                            <a class="prevnext_title" href="<?php echo get_permalink($next_post->ID); ?>" title="<?php echo get_the_title($next_post->ID); ?>"><?php echo get_the_title($next_post->ID); ?></a>
                            <?php if ( has_post_thumbnail( $next_post->ID ) ) {
                                echo '<a href="' . get_permalink( $next_post->ID ) . '" title="' . esc_attr( get_the_title($next_post->ID) ) . '">';
                                echo get_the_post_thumbnail( $next_post->ID, 'prevnext-small' );
                                echo '</a>';
                            } ?>
                        </div>
                    </div><?php
                }
                ?>
            </div>
        <?php endif; ?>
    </footer><!-- .entry-footer -->
