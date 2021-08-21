<?php

/*----------------------------------------------------------------------------------*/
/*  WPZOOM: Author Bio
/*----------------------------------------------------------------------------------*/

    class wpzoom_Bio extends WP_Widget {

        function __construct() {
            /* Widget settings. */
            $widget_ops = array( 'classname' => 'wpzoom-bio', 'description' => 'Create an about widget for author.' );

            /* Widget control settings. */
            $control_ops = array( 'id_base' => 'wpzoom-bio' );

            /* Create the widget. */
            parent::__construct( 'wpzoom-bio', 'WPZOOM: Author Bio', $widget_ops, $control_ops );
        }

        function widget( $args, $instance ) {
            extract( $args );

            /* User-selected settings. */
            $title = apply_filters( 'widget_title', ( isset( $instance['title'] ) ? $instance['title'] : '' ) );
            $subtitle = isset( $instance['subtitle'] ) ? $instance['subtitle'] : '';
            $gravatar = isset( $instance['gravatar'] ) ? $instance['gravatar'] : '';
            $gravatar_size = isset( $instance['gravatar_size'] ) ? intval( $instance['gravatar_size'] ) : 110;
            $about = isset( $instance['about'] ) ? $instance['about'] : '';
            $bio_btn = isset( $instance['bio_btn'] ) ? $instance['bio_btn'] : '';
            $bio_btn_url = isset( $instance['bio_btn_url'] ) ? $instance['bio_btn_url'] : '';

            /* Before widget (defined by themes). */
            echo $before_widget;

            /* Title of widget (before and after defined by themes). */
            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            if ($gravatar != '') {
                echo get_avatar( $gravatar, $size = $gravatar_size, $default = '' );
            }


            echo "<div class=\"meta\">";
                if ( $subtitle ) { echo $subtitle; }
            echo "</div>";

            if ($about) { echo "<div class=\"content\"><p>".$about."</p></div>"; }


            if ( !empty( $bio_btn ) && !empty($bio_btn_url) ) { ?>

                <a class="wpz_about_button" href="<?php echo esc_url_raw($bio_btn_url); ?>"><?php echo esc_attr($bio_btn); ?></a>

            <?php }


            /* After widget (defined by themes). */
            echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            /* Strip tags (if needed) and update the widget settings. */
            $instance['title'] = strip_tags( $new_instance['title'] );
            $instance['subtitle'] = $new_instance['subtitle'];
            $instance['gravatar'] = $new_instance['gravatar'];
            $instance['gravatar_size'] = $new_instance['gravatar_size'];
            $instance['about'] = $new_instance['about'];
            $instance['bio_btn'] = $new_instance['bio_btn'];
            $instance['bio_btn_url'] = $new_instance['bio_btn_url'];

            return $instance;
        }

        function form( $instance ) {

            /* Set up some default widget settings. */
            $defaults = array( 'title' => '', 'subtitle' => '', 'gravatar' => '', 'gravatar_size' => 110, 'about' => '', 'bio_btn' => '', 'bio_btn_url' => '' );
            $instance = wp_parse_args( (array) $instance, $defaults ); ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title', 'wpzoom'); ?>:</label><br />
                <input type="text" class="widefat" placeholder="About Me" size="35" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Name', 'wpzoom'); ?>:</label>
                <input type="text" class="widefat" size="35" placeholder="Jane Doe" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>"  />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'gravatar' ); ?>"><?php _e('Gravatar Email', 'wpzoom'); ?>:</label>
                <input type="text" class="widefat" size="35" placeholder="j.doe@example.com" id="<?php echo $this->get_field_id( 'gravatar' ); ?>" name="<?php echo $this->get_field_name( 'gravatar' ); ?>" value="<?php echo $instance['gravatar']; ?>"  />
            </p>

            <p class="description">This will be used for profile picture. If you don't have a Gravatar account, create one on <a href="http://gravatar.com" target="_blank">gravatar.com</a></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'gravatar_size' ); ?>"><?php _e('Profile Picture Size <small>(in pixels)</small>', 'wpzoom'); ?></label>
                <input type="number" class="widefat" min="96" max="365" id="<?php echo $this->get_field_id( 'gravatar_size' ); ?>" name="<?php echo $this->get_field_name( 'gravatar_size' ); ?>" value="<?php echo $instance['gravatar_size']; ?>"  />
            </p>


            <p>
                <label for="<?php echo $this->get_field_id( 'about' ); ?>"><?php _e('About', 'wpzoom'); ?>:</label><br />
                <textarea rows="5" class="widefat" id="<?php echo $this->get_field_id( 'about' ); ?>" name="<?php echo $this->get_field_name( 'about' ); ?>"><?php echo $instance['about']; ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'bio_btn' ); ?>"><?php _e('Button Title', 'wpzoom'); ?>:</label>
                <input type="text" class="widefat" size="35" placeholder="Read More" id="<?php echo $this->get_field_id( 'bio_btn' ); ?>" name="<?php echo $this->get_field_name( 'bio_btn' ); ?>" value="<?php echo $instance['bio_btn']; ?>"  />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'bio_btn_url' ); ?>"><?php _e('Button Link (URL)', 'wpzoom'); ?>:</label>
                <input type="url" class="widefat" size="35" placeholder="https://example.com/about" id="<?php echo $this->get_field_id( 'bio_btn_url' ); ?>" name="<?php echo $this->get_field_name( 'bio_btn_url' ); ?>" value="<?php echo $instance['bio_btn_url']; ?>"  />
            </p>

            <p class="description"><?php _e('You can enter here a link to your About page.', 'wpzoom'); ?></p>

            <?php
        }
    }


function wpzoom_register_bio_widget() {
    register_widget('wpzoom_Bio');
}
add_action('widgets_init', 'wpzoom_register_bio_widget');