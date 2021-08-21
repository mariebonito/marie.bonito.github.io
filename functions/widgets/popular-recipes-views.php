<?php

/*---------------------------------------------*/
/* WPZOOM: Popular Recipes Widget (View Count) */
/*---------------------------------------------*/

class Wpzoom_Popular_Recipes_Views extends WP_Widget {

	function __construct() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'popular-recipes', 'description' => 'A list of the most popular recipes, by amount of views' );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'wpzoom-popular-recipes-views' );

		/* Create the widget. */
		parent::__construct( 'wpzoom-popular-recipes-views', 'WPZOOM: Popular Recipes (View Count)', $widget_ops, $control_ops );

	}

	function widget( $args, $instance ) {

		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$cats = $instance['cats'];
		$sincewhen = $instance['sincewhen'];
		$show_count = $instance['show_count'];
		$date = array();
		if ( $sincewhen == 'thisyear' ) $date['year'] = date('Y');
		if ( $sincewhen == 'thismonth' ) $date['month'] = date('n');
		if ( $sincewhen == 'thisweek' ) $date['week'] = date('W');

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>
			<?php $loop = new WP_Query( array( 'ignore_sticky_posts' => true, 'cat' => $cats, 'date_query' => $date, 'showposts' => $show_count, 'meta_key' => 'Views', 'orderby' => 'meta_value_num', 'order' => 'DESC' ) ); ?>

			<ol class="popular-recipes">
				<?php if ( $loop->have_posts() ) : ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li><span class="list_wrapper"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br/><small><?php printf( get_post_meta( get_the_ID(), 'Views', true ) );  ?> <?php _e('views', 'wpzoom'); ?></small></span></li>
				<?php endwhile; ?>
			</ol>

			<?php endif; ?>
         <?php wp_reset_postdata(); ?>
		 <?php

		/* After widget (defined by themes). */
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['cats'] = $new_instance['cats'];
		$instance['sincewhen'] = $new_instance['sincewhen'];
		$instance['show_count'] = $new_instance['show_count'];

		return $instance;

	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Popular Posts', 'cats' => array(), 'sincewhen' => 'forever', 'show_count' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults );


		?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wpzoom'); ?></label><br />
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text"  class="widefat" />
			</p>

			<div style="line-height:1.5;margin:1em 0">
				<label for="<?php echo $this->get_field_id( 'cats' ); ?>"><?php _e('Category:', 'wpzoom'); ?></label><br />
				<ul class="cat-checklist category-checklist" style="line-height:16px"><?php wp_category_checklist( 0, 0, $instance['cats'], false, new Walker_Category_Checklist_Widget( $this->get_field_name( 'cats' ), $this->get_field_id( 'cats' ) ), false ); ?></ul>
			</div>

			<p>
				<label for="<?php echo $this->get_field_id( 'sincewhen' ); ?>"><?php _e('Since:', 'wpzoom'); ?></label><br />
				<select id="<?php echo $this->get_field_id( 'sincewhen' ); ?>" name="<?php echo $this->get_field_name( 'sincewhen' ); ?>">
					<option value="forever"<?php echo $instance['sincewhen'] != 'thisweek' && $instance['sincewhen'] != 'thismonth' && $instance['sincewhen'] != 'thisyear' ? 'selected="selected"' : ''; ?>><?php _e('Forever', 'wpzoom'); ?></option>
					<option value="thisyear"<?php echo $instance['sincewhen'] == 'thisyear' ? 'selected="selected"' : ''; ?>><?php _e('This Year', 'wpzoom'); ?></option>
					<option value="thismonth"<?php echo $instance['sincewhen'] == 'thismonth' ? 'selected="selected"' : ''; ?>><?php _e('This Month', 'wpzoom'); ?></option>
					<option value="thisweek"<?php echo $instance['sincewhen'] == 'thisweek' ? 'selected="selected"' : ''; ?>><?php _e('This Week', 'wpzoom'); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'show_count' ); ?>">Show:</label>
				<input id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" value="<?php echo $instance['show_count']; ?>" type="text" size="2" /> recipes
			</p>

		<?php

	}

}

require_once ABSPATH . 'wp-admin/includes/template.php';
class Walker_Category_Checklist_Widget extends Walker_Category_Checklist {

    private $name;
    private $id;

    function __construct( $name = '', $id = '' ) {
        $this->name = $name;
        $this->id = $id;
    }

    function start_el( &$output, $cat, $depth = 0, $args = array(), $id = 0 ) {
        extract( $args );
        if ( empty( $taxonomy ) ) $taxonomy = 'category';
        $class = in_array( $cat->term_id, $popular_cats ) ? ' class="popular-category"' : '';
        $id = $this->id . '-' . $cat->term_id;
        $checked = checked( in_array( $cat->term_id, $selected_cats ), true, false );
        $output .= "\n<li id='{$taxonomy}-{$cat->term_id}'$class>"
            . '<label class="selectit"><input value="'
            . $cat->term_id . '" type="checkbox" name="' . $this->name
            . '[]" id="in-'. $id . '"' . $checked
            . disabled( empty( $args['disabled'] ), false, false ) . ' /> '
            . esc_html( apply_filters( 'the_category', $cat->name ) )
            . '</label>';
      }
}

add_action( 'widgets_init', function () {
	register_widget( "Wpzoom_Popular_Recipes_Views" );
} );