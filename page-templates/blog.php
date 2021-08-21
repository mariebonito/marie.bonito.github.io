<?php
/*
Template Name: Blog Page
*/

get_header(); ?>

<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // gets current page number

$template = option::get( 'layout_home' ); ?>

<main id="main" class="site-main" role="main">

    <section class="content-area<?php if ( 'full' == $template ) { echo ' full-layout'; } ?>">

        <?php if ( have_posts() ) : ?>

            <section id="recent-posts" class="recent-posts list-view">

            <?php
            if ( get_query_var('paged') )
                $paged = get_query_var('paged');
            elseif ( get_query_var('page') )
                $paged = get_query_var('page');
            else
                $paged = 1;

            query_posts("post_type=post&paged=$paged");
            ?>


                <?php while ( have_posts() ) : the_post();  ?>

                    <?php if ( is_sticky() && $paged < 2 ) {

                        get_template_part( 'content', 'sticky' );

                    } else {

                         ?>

                         <article id="post-<?php the_ID(); ?>" <?php post_class('regular-post'); ?>>

                             <?php if ( option::is_on('display_thumb') ) {
                                  if ( has_post_thumbnail() ) : ?>
                                     <div class="post-thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                         <?php the_post_thumbnail('loop-large'); ?>
                                     </a></div>
                                 <?php endif;

                             } ?>

                             <section class="entry-body">

                                 <?php if ( option::is_on( 'display_category' ) ) printf( '<span class="cat-links">%s</span>', get_the_category_list( ', ' ) ); ?>

                                 <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

                                 <div class="entry-meta">
                                     <?php if ( option::is_on( 'display_date' ) )  printf( '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
                                     <?php if ( option::is_on( 'display_author' ) ) { printf( '<span class="entry-author">%s ', __( 'by', 'wpzoom' ) ); the_author_posts_link(); print('</span>'); } ?>
                                     <?php if ( option::is_on( 'display_comments' ) ) { ?><span class="comments-link"><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>


                                     <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>
                                 </div>

                                 <div class="entry-content">
                                     <?php if (option::get('display_content') == 'Full Content') {
                                         the_content(''.__('Read More', 'wpzoom').'');
                                     }
                                     if (option::get('display_content') == 'Excerpt')  {
                                         the_excerpt();
                                     } ?>
                                 </div>


                                 <?php if ( ( option::is_on('display_more_sticky') && is_sticky() && is_front_page() && $paged < 2 ) || option::is_on('display_more')  ) { ?>
                                     <div class="readmore_button">
                                         <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpzoom' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Continue Reading', 'wpzoom'); ?></a>
                                     </div>
                                 <?php } ?>


                             </section>

                             <div class="clearfix"></div>
                         </article><!-- #post-<?php the_ID(); ?> -->

                         <?php
                    } ?>


                <?php endwhile; ?>

            </section>

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