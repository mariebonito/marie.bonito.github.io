<?php

/*------------------------------------------*/
/* WPZOOM: Carousel Slider                  */
/*------------------------------------------*/

class Wpzoom_Carousel_Slider extends WP_Widget {

	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'carousel-slider', 'description' => 'A horizontal carousel that displays latests posts from different sources.' );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'wpzoom-carousel-slider' );

		/* Create the widget. */
		parent::__construct( 'wpzoom-carousel-slider', 'WPZOOM: Carousel Slider', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$show_count = $instance['show_count'];
		$auto_scroll = $instance['auto_scroll'] == true;
		$show_dots = $instance['show_dots'] == true;
 		$show_date = $instance['show_date'] ? true : false;
		$show_cats = $instance['show_cats'] ? true : false;
 		$type = $instance['type'];
 		$category = $instance['category'];
		$slugs = $instance['slugs'];

		if ($type == 'tag') {
			$postsq = $slugs;
		} elseif ($type == 'cat') {
			$postsq = implode(', ', (array) $category);
		}

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>


		<div id="loading-<?php echo $this->get_field_id('id'); ?>">
		    <div class="spinner">
		        <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div>
		    </div>
		</div>

		<div class="carousel_widget_wrapper" id="carousel_widget_wrapper-<?php echo $this->get_field_id('id'); ?>">

			<div id="carousel-<?php echo $this->get_field_id('id'); ?>">

			<?php $sq = new WP_Query( array( $type => $postsq, 'showposts' => $show_count, 'orderby' => 'date', 'order' => 'DESC' ) ); ?>

	 		<?php

		   	if ( $sq->have_posts() ) : while( $sq->have_posts() ) : $sq->the_post(); global $post;


				echo '<div class="item">';

                    if ( has_post_thumbnail() ) :

                        $image_ratio = option::get( 'image_ratio' );

                        if (option::get('post_view') == 'Grid') {

                            if ($image_ratio == 'Landscape (4:3)') { $size = 'loop'; }
                            if ($image_ratio == 'Portrait (3:4)') { $size = 'loop-portrait'; }

                        } else {
                            $size = 'loop';
                        }

                        ?>
                        <div class="post-thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail($size); ?>
                        </a></div>
                    <?php endif;


					if ( $show_cats ) { ?><span class="cat-links"><?php the_category(' / '); ?></span><?php }
					?>
					<h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3><?php
					if ( $show_date ) { ?><div class="entry-meta"><?php echo get_the_date(); ?></div><?php }

				echo '</div>';
	 			endwhile;
				endif;

				//Reset query_posts
				wp_reset_query();

			?></div>
  			<div class="clear"></div>

  		</div>

		<script type="text/javascript">
			jQuery(function($) {

				var $c = $('#carousel-<?php echo $this->get_field_id('id'); ?>');

				$c.imagesLoaded( function(){

					$('#carousel_widget_wrapper-<?php echo $this->get_field_id('id'); ?>').show();
                    $('#loading-<?php echo $this->get_field_id('id'); ?>').hide();

	 				$c.flickity({
	 					autoPlay: <?php echo $auto_scroll === true ? 'true' : 'false'; ?>,
	 					cellAlign: 'left',
	 					contain: true,
	 					percentPosition: true,
	  					pageDots: <?php echo $show_dots === true ? 'true' : 'false'; ?>,
	 					wrapAround: true,
	 					imagesLoaded: true,
	 					accessibility: false
					});

				});

			});
		</script><?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_count'] = $new_instance['show_count'];
		$instance['auto_scroll'] = $new_instance['auto_scroll'] == 'on';
		$instance['show_dots'] = $new_instance['show_dots'] == 'on';
 		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_cats'] = $new_instance['show_cats'];
 		$instance['type'] = $new_instance['type'];
 		$instance['category'] = $new_instance['category'];
		$instance['slugs'] = $new_instance['slugs'];
		$instance['posts'] = $new_instance['posts'];

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'show_count' => 10, 'show_date' => 'on', 'auto_scroll' => true, 'show_dots' => true, 'show_cats' => 'on', 'type' => 'cat', 'category' => '', 'slugs' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'wpzoom'); ?>:</label><br />
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e('Show', 'wpzoom'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" value="<?php echo $instance['show_count']; ?>" type="text" size="2" /> <?php _e('posts', 'wpzoom'); ?>
		</p>

		<p>
			<label>
				<input class="checkbox" type="checkbox" <?php checked( $instance['auto_scroll'] ); ?> id="<?php echo $this->get_field_id( 'auto_scroll' ); ?>" name="<?php echo $this->get_field_name( 'auto_scroll' ); ?>" />
				<?php _e( 'Auto-Scroll', 'wpzoom' ); ?>
			</label>
			<span class="howto"><?php _e( 'Automatically scroll through the posts', 'wpzoom' ); ?></span>
		</p>

		<p>
			<label>
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_dots'] ); ?> id="<?php echo $this->get_field_id( 'show_dots' ); ?>" name="<?php echo $this->get_field_name( 'show_dots' ); ?>" />
				<?php _e( 'Show Navigation Dots', 'wpzoom' ); ?>
			</label>
 		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_cats'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_cats' ); ?>" name="<?php echo $this->get_field_name( 'show_cats' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_cats' ); ?>"><?php _e('Show Category', 'wpzoom'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e('Show Date', 'wpzoom'); ?></label>
		</p>

 		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Posts to Display:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" style="width:90%;">
			<option value="cat"<?php if ($instance['type'] == 'cat') { echo ' selected="selected"';} ?>><?php _e('Categories', 'wpzoom'); ?></option>
			<option value="tag"<?php if ($instance['type'] == 'tag') { echo ' selected="selected"';} ?>><?php _e('Tag(s)', 'wpzoom'); ?></option>
			</select>
		</p>


		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category (if selected above):', 'wpzoom'); ?></label>
			<?php
			$activeoptions = $instance['category'];
			if (!$activeoptions)
			{
				$activeoptions = array();
			}
			?>

			<select multiple="true" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>[]" style="width:90%; height: 100px;">

			<?php
				$cats = get_categories('hide_empty=0');

				foreach ($cats as $cat) {
				$option = '<option value="'.$cat->term_id;
				if ( in_array($cat->term_id,$activeoptions)) { $option .='" selected="selected'; }
				$option .= '">';
				$option .= $cat->cat_name;
				$option .= ' ('.$cat->category_count.')';
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'slugs' ); ?>"><?php _e('Tag slugs (if selected above, separated by comma ","):', 'wpzoom'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'slugs' ); ?>" name="<?php echo $this->get_field_name( 'slugs' ); ?>" value="<?php echo $instance['slugs']; ?>" />
		</p>

		<?php
	}
}

function wpzoom_register_cs_widget() {
	register_widget('Wpzoom_Carousel_Slider');
}
add_action('widgets_init', 'wpzoom_register_cs_widget');