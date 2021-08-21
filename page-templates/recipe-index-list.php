<?php
/*
Template Name: Recipe Index (List)
*/
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // gets current page number

?>
<?php get_header(); ?>

<main id="main" class="site-main food-index-main recipe_index_list" role="main">

    <section class="content-area">

        <?php get_template_part( 'recipe-index-start' ); ?>

        <?php

            /* Exclude categories */
            $index_exclude_cat =  option::get('index_exclude_cat');

            $cat_args = array(
                'exclude'  => $index_exclude_cat
            );


        $cats = get_categories($cat_args);

            foreach ($cats as $cat) {
                $cat_id= $cat->term_id;
                $category_link = get_category_link( $cat_id );

                echo '<h3 class="section-title">'.$cat->name.'</h3>';
                query_posts("order=ASC&orderby=title&cat=$cat_id&posts_per_page=99");

                ?>

                    <ul class="recipe_index_list_posts">

                        <?php
                        if (have_posts()) : while (have_posts()) : the_post(); ?>

                            <li><?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?></li>

                        <?php endwhile; ?>

                    </ul>

                <?php endif; ?>
            <?php } ?>

            <?php wp_reset_query(); ?>

    </section><!-- .content-area -->

    <?php get_sidebar('recipe-index'); ?>

</main><!-- .site-main -->

<?php
get_footer();
