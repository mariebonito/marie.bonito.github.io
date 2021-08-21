<?php
/*
Template Name: Recipe Index (Group by Category)
*/

?>
<?php get_header(); ?>

<main id="main" class="site-main food-index-main" role="main">

    <section class="content-area">

        <?php get_template_part( 'recipe-index-start' ); ?>

        <?php
            /* Exclude categories */
            $index_exclude_cat =  option::get('index_exclude_cat');

            $cat_args = array(
                'exclude'  => $index_exclude_cat,
                'taxonomy' => 'category',
                // 'orderby' => 'term_order',
                // 'hierarchical' => false,
                // 'order'   => 'ASC'
            );

        $terms = get_terms($cat_args);

            foreach ($terms as $term) {
                $cat_id= $term->term_id;

                $category_link = get_category_link( $cat_id );

                echo '<h3 class="section-title">'.$term->name.'</h3>';

                $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                $args = array(
                    'paged' => $paged,
                    'cat' => $cat_id,
                    'posts_per_page' => option::get('index_group_posts')
                );
                $wp_query = new WP_Query( $args );

                ?>

                <?php if ( $wp_query->have_posts() ) : ?>

                    <section id="recent-posts" class="foodica-index recipe_index_cat">

                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                            <?php get_template_part('content-index'); ?>

                        <?php endwhile; ?>

                        <div class="readmore_button">
                            <a href="<?php echo $category_link; ?>"><?php _e('View More in ', 'wpzoom'); echo $term->name; ?>...</a>
                        </div>

                    </section>

                <?php endif;?>

            <?php } ?>

            <?php wp_reset_query(); ?>

    </section><!-- .content-area -->

    <?php get_sidebar('recipe-index'); ?>

</main><!-- .site-main -->

<?php
get_footer();
