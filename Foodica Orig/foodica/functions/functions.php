<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 */

if ( ! function_exists( 'foodica_setup' ) ) :
/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 */
function foodica_setup() {
    // This theme styles the visual editor to resemble the theme style.
    add_editor_style( array( 'css/editor-style.css' ) );

    /* Image Sizes */

    add_image_size( 'loop', 360, 240, true );
    add_image_size( 'loop-sticky', 750, 500, true );
    add_image_size( 'loop-sticky-retina', 1500, 1000, true );
    add_image_size( 'loop-large', 750 );
    add_image_size( 'loop-full', 1140, 500, true );
    add_image_size( 'loop-full-retina', 2280, 1000, true );
    add_image_size( 'loop-portrait', 360, 540, true );
    add_image_size( 'loop-square', 360, 360, true );

    add_image_size( 'featured-cat-small', 90, 70, true );
    add_image_size( 'prevnext-small', 100, 100, true );


    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    // Register nav menus
    register_nav_menus( array(
        'secondary' => __( 'Top Menu', 'wpzoom' ),
        'primary' => __( 'Main Menu', 'wpzoom' ),
        'mobile' => __( 'Mobile Menu', 'wpzoom' ),
        'tertiary' => __( 'Footer Menu', 'wpzoom' ),
        'index' => __( 'Recipe Index', 'wpzoom' )

    ) );


    /*
     * JetPack Infinite Scroll
     */
    add_theme_support( 'infinite-scroll', array(
        'container' => 'recent-posts',
        'wrapper' => false,
        'footer' => false
    ) );

    /**
     * Theme Logo
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 150,
        'width'       => 650,
        'flex-height' => true,
        'flex-width'  => true
    ) );

    foodica_old_fonts();

    /**
     * Gutenberg Wide Images
     */
    add_theme_support( 'align-wide' );

    // Add support for default block styles.
    add_theme_support( 'wp-block-styles' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles.
    add_editor_style( 'css/gutenberg-editor-style.css' );

    /**
     *  Declare support for selective refreshing of widgets.
     */
    add_theme_support( 'customize-selective-refresh-widgets' );


}
endif;
add_action( 'after_setup_theme', 'foodica_setup' );


/* Tell the WPZOOM Framework in which theme we're in
==================================== */

add_theme_support( 'wpz-theme-info', array(
    //Theme Name
    'name' => 'Foodica',
    //Theme Slug
    'slug' => 'foodica'
) );


/*  Add support for Featured Posts Module
==================================== */
if ( ! option::is_on( 'disable_featured_posts_module' ) ) {
    add_theme_support( 'wpz-featured-posts-settings', array(
            array(
                //Unique Id that is used to add the new column in posts list table.
                'id'          => 'wpzoom_is_featured_id',
                //Label that appears in the submenu of post types
                'menu_title'  => __( 'Featured Posts', '' ),
                // Label of the title head in posts list table.
                'title'       => 'Featured',
                // Default value of the checkbox that is rendered in posts list table.
                'value'       => false,
                // Name of the metakey that will be updated.
                'name'        => 'wpzoom_is_featured',
                //Post type in which this feature will be added.
                'post_type'   => 'post',
                // Limit the featured post that is show on page.
                'posts_limit' => option::get( 'slideshow_posts' ),
                // if is true the Featured Posts will be show in this post type.
                'show'        => ( option::get( 'featured_type' ) == 'Featured Posts' )
            ),
            array(
                //Unique Id that is used to add the new column in posts list table.
                'id'          => 'wpzoom_is_featured_id',
                //Label that appears in the submenu of post types
                'menu_title'  => __( 'Featured Pages', '' ),
                // Label of the title head in posts list table.
                'title'       => 'Featured',
                // Default value of the checkbox that is rendered in posts list table.
                'value'       => false,
                // Name of the metakey that will be updated.
                'name'        => 'wpzoom_is_featured',
                //Post type in which this feature will be added.
                'post_type'   => 'page',
                // Limit the featured post that is show on page.
                'posts_limit' => option::get( 'slideshow_posts' ),
                // if is true the Featured Posts will be show in this post type.
                'show'        => ( option::get( 'featured_type' ) == 'Featured Pages' )
            )
        )
    );
}

/*  Add support for Custom Background
==================================== */

add_theme_support( 'custom-background' );


/*  Add Support for Shortcodes in Excerpt
========================================== */

add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );

add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );



/*  Recommended Plugins
========================================== */
function zoom_register_theme_required_plugins_callback($plugins){

    $recipe_card_plugin = array(
        'name'         => 'Recipe Card Blocks',
        'slug'         => 'recipe-card-blocks-by-wpzoom',
        'source'       => get_stylesheet_directory() . '/plugins/recipe-card-blocks-by-wpzoom.zip',
        'required'     => true
    );

    if ( class_exists( 'WPZOOM_Recipe_Card_Block_Gutenberg' ) ) {

        if ( WPZOOM_Recipe_Card_Block_Gutenberg::has_pro() ) {

            $recipe_card_plugin = array(
                'name'         => 'Recipe Card Blocks PRO',
                'slug'         => 'recipe-card-blocks-by-wpzoom-pro',
                'required'     => true
            );

        }

    }

    $plugins =  array_merge(array(

        $recipe_card_plugin,

        array(
            'name'         => 'Instagram Widget by WPZOOM',
            'slug'         => 'instagram-widget-by-wpzoom',
            'required'     => false,
        ),

        array(
            'name'         => 'MailPoet',
            'slug'         => 'mailpoet',
            'required'     => false,
        ),

        array(
            'name'         => 'Custom Posts Per Page Reloaded',
            'slug'         => 'custom-posts-per-page-reloaded',
            'required'     => false,
        )

    ), $plugins);

    return $plugins;
}

add_filter('zoom_register_theme_required_plugins', 'zoom_register_theme_required_plugins_callback');




/*  Let users change "Older Posts" button text from Jetpack Infinite Scroll
========================================== */

function foodica_infinite_scroll_js_settings( $settings ) {
    $settings['text'] = esc_js( esc_html( option::get( 'infinite_scroll_handle_text' ) ) );

    return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'foodica_infinite_scroll_js_settings' );


/* Enable Excerpts for Pages
==================================== */

add_action( 'init', 'wpzoom_excerpts_to_pages' );
function wpzoom_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}



/* Disable Jetpack Related Posts on Post Type
========================================== */

function foodica_no_related_posts( $options ) {
    if ( !is_singular( 'post' ) ) {
        $options['enabled'] = false;
    }
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'foodica_no_related_posts' );


/* Tag Cloud */
function tagcloud_postcount_filter ($variable) {
    $variable = str_replace('<span class="tag-link-count"> (', ' <span class="post_count"> ', $variable);
    $variable = str_replace(')</span>', '</span>', $variable);
    $variable = preg_replace('/\<a([^\>]+)\>([^\<]+)/i', '<a$1><span>$2</span>', $variable);
    return $variable;
}
add_filter('wp_tag_cloud','tagcloud_postcount_filter');





/*  Custom Excerpt Length
==================================== */

function new_excerpt_length( $length ) {
    return (int) option::get( "excerpt_length" ) ? (int)option::get( "excerpt_length" ) : 50;
}

add_filter( 'excerpt_length', 'new_excerpt_length' );



/*  Maximum width for images in posts
=========================================== */

if ( ! isset( $content_width ) ) $content_width = 750;



if ( ! function_exists( 'foodica_get_the_archive_title' ) ) :
/* Custom Archives titles.
=================================== */
function foodica_get_the_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }

    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'foodica_get_the_archive_title' );



if ( ! function_exists( 'foodica_alter_main_query' ) ) :
/**
 * Alter main WordPress Query to exclude specific categories
 * and posts from featured slider if this is configured via Theme Options.
 *
 * @param $query WP_Query
 */
function foodica_alter_main_query( $query ) {
    // until this is fixed https://core.trac.wordpress.org/ticket/27015
    $is_front = false;

    if ( get_option( 'page_on_front' ) == 0 ) {
        $is_front = is_front_page();
    } else {
        $is_front = $query->get( 'page_id' ) == get_option( 'page_on_front' );
    }

    if ( $query->is_main_query() && $is_front ) {
        if ( option::is_on( 'hide_featured' ) ) {
            $featured_posts = new WP_Query( array(
                'post__not_in'   => get_option( 'sticky_posts' ),
                'posts_per_page' => option::get( 'slideshow_posts' ),
                'meta_key'       => 'wpzoom_is_featured',
                'meta_value'     => 1
            ) );

            $postIDs = array();
            while ( $featured_posts->have_posts() ) {
                $featured_posts->the_post();
                $postIDs[] = get_the_ID();
            }

            wp_reset_postdata();

            $query->set( 'post__not_in', $postIDs );
        }

        if (
            is_array( option::get( 'recent_part_exclude' ) ) &&
            count( option::get( 'recent_part_exclude' ) )
        ) {
            $query->set( 'cat', '-' . implode( ',-', (array) option::get('recent_part_exclude') ) );
        }
    }
}
endif;
add_action( 'pre_get_posts', 'foodica_alter_main_query' );





/* Register custom shortcodes
==================================== */

function wpz_shortcode_ingredients( $atts, $content = null ) {
    extract( shortcode_atts( array(
      'title' => __( 'Ingredients', 'wpzoom' ),
    ), $atts ) );

    return '<div class="shortcode-ingredients"><h3>' . esc_attr($title) . '</h3>' . do_shortcode( $content ) . '</div>' . "\n";
}
add_shortcode( 'ingredients', 'wpz_shortcode_ingredients' );

function wpz_shortcode_directions( $atts, $content = null ) {
    extract( shortcode_atts( array(
      'title' => __( 'Directions', 'wpzoom' ),
    ), $atts ) );

    return '<div class="shortcode-directions instructions"><h3>' . esc_attr($title) . '</h3>' . do_shortcode( $content ) . '</div>' . "\n";
}
add_shortcode( 'directions', 'wpz_shortcode_directions' );

// function add_recipe_buttons() {
//     if ( !current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
//         return;
//     }

//     if ( get_user_option('rich_editing') == 'true' ) {
//         add_filter( 'mce_external_plugins', 'add_recipe_tinymce_plugin' );
//         add_filter( 'mce_buttons', 'register_recipe_buttons' );
//     }
// }
// add_action( 'init', 'add_recipe_buttons' );

// function register_recipe_buttons( $buttons ) {
//     array_push( $buttons, "|", "ingredients", "directions" );
//     return $buttons;
// }
// function add_recipe_tinymce_plugin( $plugin_array ) {
//     $plugin_array['recipe'] = get_template_directory_uri() . '/functions/assets/js/recipe_buttons.js';
//     return $plugin_array;
// }

// function recipe_refresh_mce( $ver ) {
//     $ver += 3;
//     return $ver;
// }
// add_filter( 'tiny_mce_version', 'recipe_refresh_mce' );

// function recipe_enqueue_scripts() {
//     wp_localize_script(
//         'jquery',
//         'wpzRecipeL10n',
//         array(
//             'titleIngredients' => __( 'WPZOOM Recipe Ingredients Shortcode', 'wpzoom' ),
//             'titleDirections' => __( 'WPZOOM Recipe Directions Shortcode', 'wpzoom' ),
//             'listItemsHere' => __( 'Place your list items here', 'wpzoom' ),
//             'shortcodeIngredientsTitle' => __( 'Ingredients', 'wpzoom' ),
//             'shortcodeDirectionsTitle' => __( 'Directions', 'wpzoom' )
//         )
//     );
// }
// add_action( 'admin_enqueue_scripts', 'recipe_enqueue_scripts' );


/* Register Custom Fields in Profile: Facebook, Twitter
===================================================== */

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

    <h3><?php _e('Additional Profile Information', 'wpzoom'); ?></h3>

    <table class="form-table">


        <tr>
            <th><label for="twitter"><?php _e('Twitter Username', 'wpzoom'); ?></label></th>

            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your Twitter username', 'wpzoom'); ?></span>
            </td>
        </tr>

        <tr>
            <th><label for="facebook_url"><?php _e('Facebook Profile URL', 'wpzoom'); ?></label></th>

            <td>
                <input type="text" name="facebook_url" id="facebook_url" value="<?php echo esc_attr( get_the_author_meta( 'facebook_url', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your Facebook profile URL', 'wpzoom'); ?></span>
            </td>
        </tr>

        <tr>
            <th><label for="facebook_url"><?php _e('Instagram Username', 'wpzoom'); ?></label></th>

            <td>
                <input type="text" name="instagram_url" id="instagram_url" value="<?php echo esc_attr( get_the_author_meta( 'instagram_url', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your Instagram username', 'wpzoom'); ?></span>
            </td>
        </tr>

    </table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    update_user_meta( $user_id, 'instagram_url', $_POST['instagram_url'] );
    update_user_meta( $user_id, 'facebook_url', $_POST['facebook_url'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
}



/* Count post views
==================================== */
if (!option::is_on('disable_views_counter')) {
    add_action('template_redirect', 'entry_views_load');
    add_action('wp_ajax_entry_views', 'entry_views_update_ajax');
    add_action('wp_ajax_nopriv_entry_views', 'entry_views_update_ajax');
}

function entry_views_load() {
  global $wp_query, $entry_views_pid;

  if ( is_singular() ) {

    $post = $wp_query->get_queried_object();
        $entry_views_pid = $post->ID;
        wp_enqueue_script( 'jquery' );
        add_action( 'wp_footer', 'entry_views_load_scripts' );
  }
}

function entry_views_update( $post_id = '' ) {
  global $wp_query;

  if ( !empty( $post_id ) ) {

    $meta_key = apply_filters( 'entry_views_meta_key', 'Views' );
    $old_views = get_post_meta( $post_id, $meta_key, true );
    $new_views = absint( $old_views ) + 1;
    update_post_meta( $post_id, $meta_key, $new_views, $old_views );
  }
}


function entry_views_get( $attr = '' ) {
  global $post;

  $attr = shortcode_atts( array( 'before' => '', 'after' => '', 'post_id' => $post->ID ), $attr );
  $meta_key = apply_filters( 'entry_views_meta_key', 'Views' );
  $views = intval( get_post_meta( $attr['post_id'], $meta_key, true ) );
  return $attr['before'] . number_format_i18n( $views ) . $attr['after'];
}


function entry_views_update_ajax() {

  check_ajax_referer( 'entry_views_ajax' );

  if ( isset( $_POST['post_id'] ) )
    $post_id = absint( $_POST['post_id'] );

  if ( !empty( $post_id ) )
    entry_views_update( $post_id );
}


function entry_views_load_scripts() {
  global $entry_views_pid;

  $nonce = wp_create_nonce( 'entry_views_ajax' );

  echo '<script type="text/javascript">/* <![CDATA[ */ jQuery(document).ready( function() { jQuery.post( "' . admin_url( 'admin-ajax.php' ) . '", { action : "entry_views", _ajax_nonce : "' . $nonce . '", post_id : ' . $entry_views_pid . ' } ); } ); /* ]]> */</script>' . "\n";
}

/**
 * Show custom logo or blog title and description.
 *
 */
if ( ! function_exists( 'foodica_custom_logo' ) ) :
    function foodica_custom_logo( $echo = true ) {
        //In future must remove it is for backward compatibility.
        if ( get_theme_mod( 'logo' ) ) {
            set_theme_mod( 'custom_logo', zoom_get_attachment_id_from_url( get_theme_mod( 'logo' ) ) );
            remove_theme_mod( 'logo' );
        }

        $output = has_custom_logo() ? get_zoom_custom_logo() : sprintf( '<h1><a href="%s" title="%s">%s</a></h1>', home_url(), get_bloginfo( 'description' ), get_bloginfo( 'name' ) );

        if ( $echo ) {
            echo $output;
        } else {
            return $output;
        }
    }
endif;


if ( ! function_exists( 'foodica_site_title' ) ) :

    function foodica_site_title( $echo = true ) {
        $logo = foodica_custom_logo( false );
        $classes = 'navbar-header';

        if ( option::is_on('ad_head_select') ) {
            $classes .= ' left-align';
        }

        if ( has_custom_logo() ) {
            $logo_info = zoom_customizer_logo_information();
            $logo_width = !empty( $logo_info ) && isset( $logo_info[ 'width' ] ) ? absint( $logo_info[ 'width' ] ) : 1;
            $logo_size = ( absint( get_theme_mod( 'custom_logo_size', '100' ) ) / 100 ) * $logo_width;
            $style = ' style="max-width:' . $logo_size . 'px"';
        } else {
            $style = '';
        }

        $output = '<div class="'. $classes .'"><div class="navbar-brand-wpz" '. $style .'>' . $logo . '<p class="tagline">'. get_bloginfo( 'description' ) .'</p></div></div>';

        if ( $echo ) {
            echo $output;
        } else {
            return $output;
        }
    }

endif;

function foodica_logo_resize_partial_callback() {
    $logo = foodica_custom_logo( false );

    if ( has_custom_logo() ) {
        $logo_info = zoom_customizer_logo_information();
        $logo_width = !empty( $logo_info ) && isset( $logo_info[ 'width' ] ) ? absint( $logo_info[ 'width' ] ) : 1;
        $logo_size = ( absint( get_theme_mod( 'custom_logo_size', '100' ) ) / 100 ) * $logo_width;
        $style = ' style="max-width:' . $logo_size . 'px"';
    } else {
        $style = '';
    }

    echo '<div class="navbar-brand-wpz" '. $style .'>' . $logo . '<p class="tagline">'. get_bloginfo( 'description' ) .'</p></div>';
}

/**
 * Old Customizer backward compatibility.
 *
 */

function foodica_old_fonts() {

    if(get_theme_mod('font-family-site-body')){
        set_theme_mod('body-font-family',  get_theme_mod('font-family-site-body'));
        remove_theme_mod('font-family-site-body');
    }

    if(get_theme_mod('font-family-site-title')){
        set_theme_mod('title-font-family',  get_theme_mod('font-family-site-title'));
        remove_theme_mod('font-family-site-title');
    }

    if(get_theme_mod('font-family-site-tagline')){
        set_theme_mod('description-font-family',  get_theme_mod('font-family-site-tagline'));
        remove_theme_mod('font-family-site-tagline');
    }

    if(get_theme_mod('font-family-nav-top')){
        set_theme_mod('topmenu-font-family',  get_theme_mod('font-family-nav-top'));
        remove_theme_mod('font-family-nav-top');
    }

    if(get_theme_mod('font-family-nav')){
        set_theme_mod('mainmenu-font-family',  get_theme_mod('font-family-nav'));
        remove_theme_mod('font-family-nav');
    }

    if(get_theme_mod('font-family-slider-title')){
        set_theme_mod('slider-title-font-family',  get_theme_mod('font-family-slider-title'));
        remove_theme_mod('font-family-slider-title');
    }

    if(get_theme_mod('font-family-widgets')){
        set_theme_mod('widget-title-font-family',  get_theme_mod('font-family-widgets'));
        remove_theme_mod('font-family-widgets');
    }

    if(get_theme_mod('font-family-post-title')){
        set_theme_mod('blog-title-font-family',  get_theme_mod('font-family-post-title'));
        remove_theme_mod('font-family-post-title');
    }

    if(get_theme_mod('font-family-single-post-title')){
        set_theme_mod('post-title-font-family',  get_theme_mod('font-family-single-post-title'));
        remove_theme_mod('font-family-single-post-title');
    }

    if(get_theme_mod('font-family-page-title')){
        set_theme_mod('page-title-font-family',  get_theme_mod('font-family-page-title'));
        remove_theme_mod('font-family-page-title');
    }

    if(get_theme_mod('font-family-footer-menu')){
        set_theme_mod('footer-menu-font-family',  get_theme_mod('font-family-footer-menu'));
        remove_theme_mod('font-family-footer-menu');
    }


}


/**
 * Numeric pagination via WP core function paginate_links().
 * @link http://codex.wordpress.org/Function_Reference/paginate_links
 *
 * @param array $srgs
 *
 * @return string HTML for numneric pagination
 */
function foodica_pagination( $args = array() ) {
    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    $pagination_args = array(
        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'total'        => $wp_query->max_num_pages,
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'format'       => '?paged=%#%',
        'type'         => 'array',
        'prev_text'    => __( '&larr; Previous', 'wpzoom' ),
        'next_text'    => __( 'Next &rarr;', 'wpzoom' ),

        // Custom arguments not part of WP core:
    );

    $pagination = paginate_links( array_merge( $pagination_args, $args ) );

    // Remove /page/1/ from links.
    $pagination = array_map(
        function( $string ) {
            return str_replace( '/page/1/', '/', $string );
        },
        $pagination
    );

    return implode( '', $pagination );
}



/* Enqueue scripts and styles for the front end.
=========================================== */

function foodica_scripts() {

    $data = foodica_customizer_data();

    if ( '' !== $google_request = zoom_get_google_font_uri( $data ) ) {
        wp_enqueue_style( 'foodica-google-fonts', $google_request, WPZOOM::$themeVersion );
    }

    // Load our main stylesheet.
    wp_enqueue_style( 'foodica-style', get_stylesheet_uri(), array(), WPZOOM::$themeVersion );

    wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/css/media-queries.css', array(), WPZOOM::$themeVersion );

    $color_scheme = get_theme_mod('color-palettes', zoom_customizer_get_default_option_value( 'color-palettes', $data ));
    wp_enqueue_style('foodica-style-color-' . $color_scheme, get_template_directory_uri() . '/styles/' . $color_scheme . '.css', array(), WPZOOM::$themeVersion);

    wp_enqueue_style( 'dashicons' );

    wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array(), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'libraries', get_template_directory_uri() . '/js/libraries.js', array( 'jquery' ), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'search_button', get_template_directory_uri() . '/js/search_button.js', array(), WPZOOM::$themeVersion, true );

    $themeJsOptions = array_merge( option::getJsOptions(), option::getCustomizerJsOptions() );

    wp_enqueue_script( 'foodica-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), WPZOOM::$themeVersion, true );
    wp_localize_script( 'foodica-script', 'zoomOptions', $themeJsOptions );
}

add_action( 'wp_enqueue_scripts', 'foodica_scripts' );


if (!function_exists('wpzoom_get_value')):
    function wpzoom_get_value($val, $default = '', $key = null)
    {
        if (isset($val) && isset($key)) {
            return (isset($val[$key])) ? $val[$key] : $default;
        } else {
            return isset($val) ? $val : $default;
        }
    }
endif;

