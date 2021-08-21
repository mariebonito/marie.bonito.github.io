<?php
/*-----------------------------------------------------------------------------------*/
/* Initializing Widgetized Areas (Sidebars)				 							 */
/*-----------------------------------------------------------------------------------*/


register_sidebar(array('name'=>'Sidebar',
   'id' => 'Sidebar',
   'description' => 'Primary widget area on the right side.',
   'before_widget' => '<div class="widget %2$s" id="%1$s">',
   'after_widget' => '<div class="clear"></div></div>',
   'before_title' => '<h3 class="title">',
   'after_title' => '</h3>',
));

register_sidebar(array('name'=>'Homepage (Below the Slideshow)',
    'id' => 'homepage-top',
    'description' => 'Recommended widget: "WPZOOM: Carousel Slider".',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '<div class="clear"></div></div>',
    'before_title' => '<h3 class="title">',
    'after_title' => '</h3>',
));


register_sidebar(array('name'=>'Homepage (Below the Slider) 1/3 Column',
    'id' => 'homepage-1',
    'description' => 'Widget area for: WPZOOM: Image Box widget.',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '<div class="clear"></div></div>',
    'before_title' => '<h3 class="title">',
    'after_title' => '</h3>',
));

register_sidebar(array('name'=>'Homepage (Below the Slider) 2/3 Column',
    'id' => 'homepage-2',
    'description' => 'Widget area for: WPZOOM: Image Box widget.',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '<div class="clear"></div></div>',
    'before_title' => '<h3 class="title">',
    'after_title' => '</h3>',
));

register_sidebar(array('name'=>'Homepage (Below the Slider) 3/3 Column',
    'id' => 'homepage-3',
    'description' => 'Widget area for: WPZOOM: Image Box widget.',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '<div class="clear"></div></div>',
    'before_title' => '<h3 class="title">',
    'after_title' => '</h3>',
));



register_sidebar( array(
    'name' => 'Homepage: Featured Categories',
    'id' => 'home-categories',
    'description' => 'Widget area on homepage, below the Recent Posts. Recommended widget: "Featured Category (Homepage)".',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '<div class="clear"></div></div>',
    'before_title' => '<h3 class="title">',
    'after_title' => '</h3>'
) );

register_sidebar(array('name'=>'Single Post (before content)',
   'id' => 'sidebar-post-top',
   'description' => 'Widget area that appears in individual posts before the content. Can be used to place widgets with advertisements or an affiliate disclosure.',
   'before_widget' => '<div class="widget %2$s" id="%1$s">',
   'after_widget' => '<div class="clear"></div></div>',
   'before_title' => '<h3 class="title">',
   'after_title' => '</h3>',
));


register_sidebar(array('name'=>'Single Post (after content)',
   'id' => 'sidebar-post',
   'description' => 'Widget area that appears in individual posts after the content. Can be used for a Newsletter Form (Recommended plugin: MailPoet).',
   'before_widget' => '<div class="widget %2$s" id="%1$s">',
   'after_widget' => '<div class="clear"></div></div>',
   'before_title' => '<h3 class="title">',
   'after_title' => '</h3>',
));


/*----------------------------------*/
/* Footer widgetized areas		    */
/*----------------------------------*/

register_sidebar( array(
    'name'          => 'Footer: Column 1',
    'id'            => 'footer_1',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="clear"></div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => 'Footer: Column 2',
    'id'            => 'footer_2',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="clear"></div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => 'Footer: Column 3',
    'id'            => 'footer_3',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="clear"></div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => 'Footer: Column 4',
    'id'            => 'footer_4',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="clear"></div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );


register_sidebar(array('name'=>'Instagram Bar',
    'description' => 'Widget area for "Instagram widget by WPZOOM".',
    'id' => 'widgetized_section',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '<div class="clear"></div></div>',
    'before_title' => '<h3 class="title">',
    'after_title' => '</h3>',
));



/* WooCommerce Sidebar
===============================*/

register_sidebar( array(
    'name'          => 'WooCommerce Sidebar',
    'id'            => 'sidebar-shop',
    'description'   => 'Right sidebar for WooCommerce pages. Leave empty for a full-width shop page.',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="cleaner">&nbsp;</div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );



/* Header - for social icons
===============================*/

register_sidebar(array(
    'name'=>'Header Social Icons',
    'id' => 'header_social',
    'description' => 'Widget area in the header. Install the "Social Icons Widget by WPZOOM" plugin and add the widget here.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="title"><span>',
    'after_title' => '</span></h3>',
));


/* Recipe Index
===============================*/

register_sidebar( array(
    'name'          => 'Recipe Index Sidebar',
    'id'            => 'sidebar-index',
    'description'   => 'Right sidebar for Recipe Index page template.',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="cleaner">&nbsp;</div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );


/* Footer Disclosure
===============================*/

register_sidebar( array(
    'name'          => 'Footer Disclosure',
    'id'            => 'footer-copyright',
    'description'   => 'Widget area after the copyright line. Can be used to disclosure statements or links to special pages.',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="cleaner">&nbsp;</div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );
