<?php

/*------------------------------------------*/
/* WPZOOM: Featured Category widget	for Home */
/*------------------------------------------*/

class wpzoom_widget_category_home extends WP_Widget {

	/* Widget setup. */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wpzoom-featured-cat-home', 'description' => __('Featured Category Widget for Homepage: Featured Categories area', 'wpzoom') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'wpzoom-featured-cat-home' );

		/* Create the widget. */
		parent::__construct( 'wpzoom-featured-cat-home', __('Featured Category (Homepage)', 'wpzoom'), $widget_ops, $control_ops );
	}

	/* How to display the widget on the screen. */
	function widget( $args, $instance ) {

		extract( $args );

        // Find out in which widgetized area the widget is displayed
        $sidebar_id = $args['id'];

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
 		$posts = $instance['posts'];
 		$offset = $instance['offset'];
        $category = $instance['category'];
 		$thumb_aspect = $instance['thumb_aspect'];

 		/* Before widget (defined by themes). */
 		echo $before_widget;

		if ($category) {
			$categoryLink = get_category_link($category);
        } else {
            $categoryLink = '#';
        }

			$exclude_featured 	= $instance['exclude_featured'];
			$show_excerpt 		= $instance['show_excerpt'] ? true : false;
			$show_date 			= $instance['show_date'] ? true : false;
            $show_comments      = $instance['show_comments'] ? true : false;
			$show_button 		= $instance['show_button'] ? true : false;

			/* Exclude featured posts from Widget Posts */
			$postnotin = '';
			if ($exclude_featured == 'on') {

				$featured_posts = new WP_Query(
					array(
 						'posts_per_page' => option::get( 'slideshow_posts' ),
						'meta_key' => 'wpzoom_is_featured',
						'meta_value' => 1
						) );

				while ($featured_posts->have_posts()) {
					$featured_posts->the_post();
					global $post;
					$postIDs[] = $post->ID;
				}
				$postnotin = $postIDs;
			}

			 if ( $title )  {

					echo '<h3 class="title">';
					echo '<a href="'.$categoryLink.'">'.$title.'</a>';
					echo $after_title;

		       	}

		       	?>

                <div class="featured-grid-<?php echo $posts; ?>">


		       	<ul class="wpz-featured-grid">

    	          	<?php
    	               $second_query = new WP_Query( array( 'ignore_sticky_posts' => true, 'cat' => $category, 'showposts' => $posts, 'offset' => $offset, 'orderby' => 'date', 'post__not_in' => $postnotin, 'order' => 'DESC' ) );

	                   if ( $second_query->have_posts() ) : while( $second_query->have_posts() ) : $second_query->the_post();

    	              global $post;
	                ?>


                        <li>

                            <article id="post-<?php the_ID(); ?>" <?php post_class('regular-post'); ?>>

                                <?php if ( option::is_on('display_thumb') ) {

                                    if ($thumb_aspect == 'landscape') { $size = 'loop'; }
                                    if ($thumb_aspect == 'square') { $size = 'loop-square'; }
                                    if ($thumb_aspect == 'portrait') { $size = 'loop-portrait'; }

                                    if ( has_post_thumbnail() ) : ?>
                                        <div class="post-thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail($size); ?>
                                        </a></div>
                                    <?php endif;

                                } ?>

                                <section class="entry-body">

                                    <?php if ( $show_date ) { ?><span class="entry-date"><?php echo get_the_date(); ?></span><?php } ?>

                                    <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

                                    <?php if ( $show_comments ) { ?><span class="comments-link"><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>

                                    <?php if ($show_excerpt) { the_excerpt(); } ?>

                                </section>

                                <div class="clearfix"></div>
                            </article><!-- #post-<?php the_ID(); ?> -->

                        </li>


                    <?php endwhile; ?>

				<?php endif; ?>

			</ul><!-- /.right-col  -->

            </div>

            <?php if ( ( $show_button ) && ($categoryLink != '#') ) { ?>

                <div class="readmore_button">
                    <a href="<?php echo $categoryLink; ?>"><?php _e('View More in ', 'wpzoom'); echo $title; ?>...</a>
                </div>
            <?php } ?>

			<?php
		wp_reset_postdata();

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* Update the widget settings.*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
 		$instance['category'] = ( 0 <= (int) $new_instance['category'] ) ? (int) $new_instance['category'] : null;

		$instance['posts'] = ( 0 != (int) $new_instance['posts'] ) ? (int) $new_instance['posts'] : null;
		$instance['offset'] = ( 0 != (int) $new_instance['offset'] ) ? (int) $new_instance['offset'] : null;

		$instance['exclude_featured'] = (bool) $new_instance['exclude_featured'];
		$instance['show_title']       = (bool) $new_instance['show_title'];
		$instance['show_excerpt']    	  = (bool) $new_instance['show_excerpt'];
		$instance['show_date']    	  = (bool) $new_instance['show_date'];
        $instance['show_comments']    = (bool) $new_instance['show_comments'];
		$instance['show_button']    = (bool) $new_instance['show_button'];
        $instance['thumb_aspect'] = $new_instance['thumb_aspect'];

		return $instance;
	}

	/** Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff. */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'category' => '', 'thumb_aspect' => 'landscape', 'posts' => '3', 'offset' => '0', 'exclude_featured' => '',  'show_excerpt' => false, 'show_date' => true, 'show_comments' => false, 'show_button' => true );
		$instance = wp_parse_args( (array) $instance, $defaults );
		global $wpzoomColors;
    ?>

 		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'wpzoom'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"   />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e('Category:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" style="width:90%;">
				<option value="0"><?php esc_html_e( 'Choose category:', 'wpzoom' ); ?></option>
				<?php
				$cats = get_categories('hide_empty=0');

				foreach ($cats as $cat) {
				$option = '<option value="'.$cat->term_id;
				if ($cat->term_id == $instance['category']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= esc_attr( $cat->cat_name );
				$option .= ' ('.$cat->category_count.')';
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>

        <p>
            <label for="<?php echo $this->get_field_id('thumb_aspect'); ?>"><?php _e('Images Aspect Ratio:', 'wpzoom'); ?></label>
            <select id="<?php echo $this->get_field_id('thumb_aspect'); ?>" name="<?php echo $this->get_field_name('thumb_aspect'); ?>" style="width:90%;">
            <option value="landscape"<?php if ($instance['thumb_aspect'] == 'landscape') { echo ' selected="selected"';} ?>><?php _e('Landscape', 'wpzoom'); ?></option>
            <option value="portrait"<?php if ($instance['thumb_aspect'] == 'portrait') { echo ' selected="selected"';} ?>><?php _e('Portrait', 'wpzoom'); ?></option>
            <option value="square"<?php if ($instance['thumb_aspect'] == 'square') { echo ' selected="selected"';} ?>><?php _e('Square', 'wpzoom'); ?></option>
            </select>
        </p>

        <p class="description">If this option doesn't work, <a href="https://www.wpzoom.com/tutorial/fixing-stretched-images/" target="_blank">regenerate thumbnails</a>.</p>


		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php esc_html_e('Numbers of posts:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" style="width:90%;">
			<?php
				$m = 1;
				while ($m < 12) {
				$m++;
				$option = '<option value="'.$m;
				if ($m == $instance['posts']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $m;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>

 		<p>
			<label for="<?php echo $this->get_field_id( 'offset' ); ?>"><?php esc_html_e('Skip (offset) first', 'wpzoom'); ?></label>
			<input type="text" size="5" id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" value="<?php echo esc_attr( $instance['offset'] ); ?>"   /> <?php esc_html_e('posts from category', 'wpzoom'); ?>

		</p>

		<p class="description"><?php _e('This option is useful when you want to have two widgets showing latest posts from the same category.', 'wpzoom'); ?></p>

		<p>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('exclude_featured'); ?>" name="<?php echo $this->get_field_name('exclude_featured'); ?>" <?php checked( $instance['exclude_featured'] ) ?> />
			<label for="<?php echo $this->get_field_id('exclude_featured'); ?>"><?php esc_html_e('Exclude Featured Posts from Widget', 'wpzoom'); ?></label>
			<br/>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_excerpt'] ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php esc_html_e('Display Excerpt', 'wpzoom'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'] ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php esc_html_e('Display Date', 'wpzoom'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_comments'] ); ?> id="<?php echo $this->get_field_id( 'show_comments' ); ?>" name="<?php echo $this->get_field_name( 'show_comments' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_comments' ); ?>"><?php esc_html_e('Display Comments Number', 'wpzoom'); ?></label>
		</p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_button'] ); ?> id="<?php echo $this->get_field_id( 'show_button' ); ?>" name="<?php echo $this->get_field_name( 'show_button' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_button' ); ?>"><?php esc_html_e('Display View More button', 'wpzoom'); ?></label>
        </p>



	<?php
	}
}

function wpzoom_register_category_widget_home() {
	register_widget('wpzoom_widget_category_home');
}
add_action('widgets_init', 'wpzoom_register_category_widget_home');
?>