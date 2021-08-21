<?php

/*------------------------------------------*/
/* WPZOOM: Featured Category widget			*/
/*------------------------------------------*/


class wpzoom_widget_category extends WP_Widget {

	/* Widget setup. */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wpzoom-featured-cat', 'description' => __('Featured Category widget for Sidebar', 'wpzoom') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'wpzoom-featured-cat' );

		/* Create the widget. */
		parent::__construct( 'wpzoom-featured-cat', __('Featured Category (Sidebar)', 'wpzoom'), $widget_ops, $control_ops );
	}

	/* How to display the widget on the screen. */
	function widget( $args, $instance ) {

		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
 		$posts = $instance['posts'];
 		$offset = $instance['offset'];
 		$category = $instance['category'];

 		/* Before widget (defined by themes). */
 		echo $before_widget;

		if ($category) {
			$categoryLink = get_category_link($category);

			$exclude_featured 	= $instance['exclude_featured'];
			$show_title 		= $instance['show_title'] ? true : false;
			$show_excerpt 		= $instance['show_excerpt'] ? true : false;
			$show_thumb 		= $instance['show_thumb'] ? true : false;
			$show_date 			= $instance['show_date'] ? true : false;
			$show_comments 		= $instance['show_comments'] ? true : false;

			/* Exclude featured posts from Widget Posts */
			$postnotin = '';
			if ($exclude_featured == 'on') {

				$featured_posts = new WP_Query(
					array(
						'post__not_in' => get_option( 'sticky_posts' ),
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



	            $second_query = new WP_Query( array( 'cat' => $category, 'showposts' => $posts, 'offset' => $offset, 'orderby' => 'date', 'post__not_in' => $postnotin, 'order' => 'DESC' ) );

	              $i = 0;
	              if ( $second_query->have_posts() ) : while( $second_query->have_posts() ) : $second_query->the_post();

	              $i++;
	              global $post;

	              if ($i == 1)
	              { ?>

				 	<div class="main-post">

						<?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('loop'); ?>
                            </a></div>
                        <?php endif; ?>

						<?php if ( $title && $show_title )  {

							echo $before_title;
							echo '<a href="'.$categoryLink.'">'.$title.'</a>';
							echo $after_title;

				       	} ?>

						<h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

						<div class="entry-meta">
							<?php if ( $show_date ) { ?><span class="entry-date"><?php echo get_the_date(); ?></span><?php } ?>
							<?php if ( $show_comments ) { ?><span class="comments-link"><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>
						</div>

						<?php if ( $show_excerpt ) { the_excerpt(); } ?>

					</div>

					<ul class="featured-list">

					<?php } else { ?>

						<li>

							<?php if ( $show_thumb ) { the_post_thumbnail('featured-cat-small'); } ?>

							<h4 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
							<div class="clear"></div>
						</li>

						<?php } ?>
						<?php endwhile; ?>
					</ul>

					<?php endif; ?>

					<div class="clear"></div>

			<?php
		}
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
		$instance['show_excerpt']     = (bool) $new_instance['show_excerpt'];
		$instance['show_thumb']       = (bool) $new_instance['show_thumb'];
		$instance['show_date']    	  = (bool) $new_instance['show_date'];
		$instance['show_comments']    = (bool) $new_instance['show_comments'];

		return $instance;
	}

	/** Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff. */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => ' ', 'show_title' => true, 'category' => '', 'posts' => '1', 'offset' => '0', 'exclude_featured' => '', 'show_excerpt' => false, 'show_date' => false, 'show_comments' => false, 'show_thumb' => false,);
		$instance = wp_parse_args( (array) $instance, $defaults );
    ?>

 		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'wpzoom'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"   />
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_title'] ); ?> id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_title' ); ?>"><?php esc_html_e('Display Title', 'wpzoom'); ?></label>
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
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php esc_html_e('Numbers of posts:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" style="width:90%;">
			<?php
				$m = 0;
				while ($m < 5) {
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

		<p class="description"><?php _e('This option is useful when you want to have two widgets side by side showing latest 2 posts from the same category.', 'wpzoom'); ?></p>


		<p>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('exclude_featured'); ?>" name="<?php echo $this->get_field_name('exclude_featured'); ?>" <?php checked( $instance['exclude_featured'] ) ?> />
			<label for="<?php echo $this->get_field_id('exclude_featured'); ?>"><?php esc_html_e('Exclude Featured Posts from Widget', 'wpzoom'); ?></label>
			<br/>
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
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_excerpt'] ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php esc_html_e('Display Excerpt for Latest Post', 'wpzoom'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_thumb'] ); ?> id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php esc_html_e('Display Thumbnail for Other Posts', 'wpzoom'); ?></label>
		</p>

	<?php
	}
}

function wpzoom_register_category_widget() {
	register_widget('wpzoom_widget_category');
}
add_action('widgets_init', 'wpzoom_register_category_widget');
?>