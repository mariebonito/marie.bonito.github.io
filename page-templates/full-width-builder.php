<?php
/*
Template Name: Full-width Page (Page Builder)
*/
?>
<?php
get_header(); ?>

</div>

    <section class="content-area full-layout">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; // end of the loop. ?>

    </section><!-- .content-area -->


<div class="inner-wrap">

<?php
get_footer();