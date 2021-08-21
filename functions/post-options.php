<?php


/* Registering metaboxes
============================================*/

add_action( 'add_meta_boxes', 'wpzoom_options_box' );

function wpzoom_options_box() {
    $context = array( 'normal', 'side', 'normal' );

    // when gutenberg page is enabled, change context to 'normal' for all custom metaboxes
    if ( function_exists('is_gutenberg_page') && is_gutenberg_page() ) {
        $context = array( 'normal', 'normal', 'normal' );
    }

    add_meta_box( 'wpzoom_post_layout', 'Post Layout', 'wpzoom_post_layout_options', 'post', $context[0], 'high' );

    add_meta_box( 'wpzoom_post_embed', 'Post Options', 'wpzoom_post_embed_info', 'post', $context[1], 'high' );

    if (option::get('featured_type') == 'Featured Pages') {
        add_meta_box('wpzoom_page_options', 'Page Options', 'wpzoom_page_options', 'page', $context[2], 'high');
    }

    if ( is_plugin_active( 'wp-ultimate-recipe/wp-ultimate-recipe.php' ) ) {
        add_meta_box('wpzoom_page_options', 'Recipe Options', 'wpzoom_page_options', 'recipe', 'side', 'high');
    }

}


/* Custom Post Layouts
==================================== */

function wpzoom_post_layout_options() {
    global $post;
    $postLayouts = array('side-right' => 'Sidebar on the right', 'full' => 'Full Width');
    ?>

    <style>
    .RadioClass { display: none !important; }
    .RadioLabelClass { margin-right: 10px; }
    img.layout-select { border: solid 3px #c0cdd6; border-radius: 5px; }
    .RadioSelected img.layout-select { border: solid 3px #3173b2; }
    #wpzoom_post_embed_code { color: #444444; font-size: 11px; margin: 3px 0 10px; padding: 5px; height:135px; font-family: Consolas,Monaco,Courier,monospace; }

    </style>

    <script type="text/javascript">
    jQuery(document).ready( function($) {
        $(".RadioClass").change(function(){
            if($(this).is(":checked")){
                $(".RadioSelected:not(:checked)").removeClass("RadioSelected");
                $(this).next("label").addClass("RadioSelected");
            }
        });
    });
    </script>

    <fieldset>
        <div>
            <p>
            <?php
            foreach ($postLayouts as $key => $value)
            {
                ?>
                <input id="<?php echo $key; ?>" type="radio" class="RadioClass" name="wpzoom_post_template" value="<?php echo $key; ?>"<?php if (get_post_meta($post->ID, 'wpzoom_post_template', true) == $key) { echo' checked="checked"'; } ?> />
                <label for="<?php echo $key; ?>" class="RadioLabelClass<?php if (get_post_meta($post->ID, 'wpzoom_post_template', true) == $key) { echo' RadioSelected"'; } ?>">
                <img src="<?php echo wpzoom::$wpzoomPath; ?>/assets/images/layout-<?php echo $key; ?>.png" alt="<?php echo $value; ?>" title="<?php echo $value; ?>" class="layout-select" /></label>
            <?php
            }
            ?>
            </p>
        </div>
    </fieldset>
    <?php
}


/* Options for pages */

function wpzoom_page_options() {
    global $post;

    ?>
    <fieldset>
        <p class="wpz_border">
            <?php $isChecked = ( get_post_meta($post->ID, 'wpzoom_is_featured', true) == 1 ? 'checked="checked"' : '' ); // we store checked checkboxes as 1 ?>
            <input type="checkbox" name="wpzoom_is_featured" id="wpzoom_is_featured" value="1" <?php echo esc_attr($isChecked); ?> /> <label for="wpzoom_is_featured"><?php _e('Feature in Homepage Slider', 'wpzoom'); ?></label>
        </p>

    </fieldset>
    <?php
}


/* Options for regular posts */

function wpzoom_post_embed_info() {
    global $post;

    ?>
    <fieldset>

        <?php if (option::get('featured_type') == 'Featured Posts') { ?>

        <p class="wpz_border">
            <?php $isChecked = ( get_post_meta($post->ID, 'wpzoom_is_featured', true) == 1 ? 'checked="checked"' : '' ); // we store checked checkboxes as 1 ?>
            <input type="checkbox" name="wpzoom_is_featured" id="wpzoom_is_featured" value="1" <?php echo esc_attr($isChecked); ?> /> <label for="wpzoom_is_featured"><?php _e('Feature in Homepage Slider', 'wpzoom'); ?></label>
        </p>

        <hr />

        <?php } ?>

    </fieldset>
    <?php
}
// get the max or min menu order.
function get_menu_order_limit( $limit = 'MIN', $post_type ) {

    global $wpdb;

    $limit = in_array( $limit, array( 'MAX', 'MIN' ) ) ? $limit : 'MIN';

    $sql = "SELECT IFNULL($limit(menu_order),0) FROM $wpdb->posts
            INNER JOIN $wpdb->postmeta
            ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id )
            WHERE ( ($wpdb->postmeta.meta_key = %s
            AND $wpdb->postmeta.meta_value = %s ) )
            AND $wpdb->posts.post_status = 'publish'
            AND $wpdb->posts.post_type =%s";

    return $wpdb->get_var( $wpdb->prepare( $sql, 'wpzoom_is_featured', '1', $post_type ) );

}

add_action( 'save_post', 'custom_add_save' );


function custom_add_save( $postID ) {

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $postID;
    }

    // called after a post or page is saved
    if ( $parent_id = wp_is_post_revision( $postID ) ) {
        $postID = $parent_id;
    }

    if ( isset( $_POST['post_type'] ) && ( $post_type_object = get_post_type_object( $_POST['post_type'] ) ) && $post_type_object->public ) {
        if ( current_user_can( 'edit_post', $postID ) ) {
            if ( isset( $_POST['wpzoom_post_template'] ) ) {
                update_custom_meta( $postID, $_POST['wpzoom_post_template'], 'wpzoom_post_template' );
            }

            // Run only if the featured posts module is on.
            if (
                current_theme_supports('wpz-featured-posts-settings') &&
                class_exists('WPZOOM_Featured_Posts')
            ) {

                $featured_post_settings = get_theme_support('wpz-featured-posts-settings');
                $featured_post_settings = array_pop($featured_post_settings);
                $featured_post_types = wp_list_pluck($featured_post_settings, 'post_type');
                $post_type = get_post_type($postID);

                if (is_array($featured_post_types) && in_array($post_type, $featured_post_types)) {

                    $max_order = get_menu_order_limit('MAX', $post_type);

                    // Unhook this action to prevent an infinite loop
                    remove_action('save_post', 'custom_add_save');

                    wp_update_post(array(
                        'ID' => $postID,
                        'menu_order' => isset($_POST['wpzoom_is_featured']) ? ($max_order + 1) : 0
                    ));

                    // Add hook the action
                    add_action('save_post', 'custom_add_save');

                }
            }

            update_custom_meta( $postID, ( isset( $_POST['wpzoom_is_featured'] ) ? 1 : 0 ), 'wpzoom_is_featured' );

        }
    }
}


function update_custom_meta( $postID, $value, $field ) {
    // To create new meta
    if ( ! get_post_meta( $postID, $field ) ) {
        add_post_meta( $postID, $field, $value );
    } else {
        // or to update existing meta
        update_post_meta( $postID, $field, $value );
    }
}