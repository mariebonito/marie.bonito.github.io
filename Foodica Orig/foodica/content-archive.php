<article id="post-<?php the_ID(); ?>" <?php post_class('regular-post'); ?>>

    <?php if ( option::is_on('category_thumb') ) {

        $image_ratio = option::get( 'archive_image_ratio' );

        if (option::get('post_view_archive') == 'List') {
            $size = "loop-large";
        }

        if (option::get('post_view_archive') == 'Grid') {

            if ($image_ratio == 'Landscape (4:3)') { $size = 'loop'; }
            if ($image_ratio == 'Portrait (3:4)') { $size = 'loop-portrait'; }

        }

        if ( has_post_thumbnail() ) : ?>
            <div class="post-thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail($size); ?>
            </a></div>
        <?php endif;

    } ?>

    <section class="entry-body">

        <?php if ( option::is_on( 'category_display_category' ) ) printf( '<span class="cat-links">%s</span>', get_the_category_list( ', ' ) ); ?>

        <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

        <div class="entry-meta">
            <?php if ( option::is_on( 'category_date' ) )  printf( '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
            <?php if ( option::is_on( 'category_author' ) ) { printf( '<span class="entry-author">%s ', __( 'by', 'wpzoom' ) ); the_author_posts_link(); print('</span>'); } ?>
             <?php if ( option::is_on( 'category_comments' ) ) { ?><span class="comments-link"><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>


            <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>
        </div>

        <div class="entry-content">
            <?php if (option::get('category_content') == 'Full Content') {
                the_content(''.__('Read More', 'wpzoom').'');
            }
            if (option::get('category_content') == 'Excerpt')  {
                the_excerpt();
            } ?>
        </div>


        <?php if ( option::is_on('category_more') ) { ?>
            <div class="readmore_button">
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpzoom' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Continue Reading', 'wpzoom'); ?></a>
            </div>
        <?php } ?>


    </section>

    <div class="clearfix"></div>
</article><!-- #post-<?php the_ID(); ?> -->