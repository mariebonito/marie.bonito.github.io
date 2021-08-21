<?php


function foodica_customizer_data()
{
    static $data = array();

    if(empty($data)){

        $media_viewport = 'screen and (min-width: 769px)';

        $data = array(
            'color-palettes-container' => array(
                'title' => __('Color Scheme', 'wpzoom'),
                'priority' => 40,
                'options' => array(
                    'color-palettes' => array(
                        'setting' => array(
                            'default' => 'default',
                            'sanitize_callback' => 'sanitize_text_field'
                        ),
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_Radio',
                            'label' => __('Color Scheme', 'wpzoom'),
                            'mode' => 'buttonset',
                            'choices' => array(
                                'default' => __('Default', 'wpzoom'),
                                'dark' => __('Dark', 'wpzoom'),
                                'dark-green' => __('Dark Green', 'wpzoom'),
                                'light-green' => __('Light Green', 'wpzoom'),
                                'pink' => __('Pink', 'wpzoom'),
                                'yellow' => __('Yellow', 'wpzoom'),
                                'orange' => __('Orange', 'wpzoom'),
                                'teal' => __('Teal', 'wpzoom'),
                                'turquoise' => __('Turquoise', 'wpzoom'),
                                'red' => __('Red', 'wpzoom')
                            )
                        ),
                        'dom' => array(
                            // * - mean that it is dynamic and would be from select choices.
                            'selector' => 'foodica-style-color-*-css',
                            'rule' => 'change-stylesheet'
                        )
                    ),
                )
            ),
            'slider-container' => array(
                'title' => __('Slider Styles', 'wpzoom'),
                'priority' => 51,
                'options' => array(
                    'slider-styles' => array(
                        'setting' => array(
                            'default' => 'slide-style-1',
                            'sanitize_callback' => 'sanitize_text_field'
                        ),
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_Select',
                            'label' => __('Slider Styles', 'wpzoom'),
                            'choices' => array(
                                'slide-style-1' => __('Default', 'wpzoom'),
                                'slide-style-2' => __('Without Gradient', 'wpzoom'),
                                'slide-style-3' => __('Transparent', 'wpzoom'),
                            ),
                        ),
                        'dom' => array(
                            'selector' => '#slider',
                            'rule' => 'toggle-class'
                        )
                    ),
                    'slider-gradient-color' => array(
                        'setting' => array(
                            'transport' => 'postMessage',
                            'default' => array(
                                'start_color' => '#EFF4F7',
                                'end_color' => '#EFF4F7',
                                'direction' => 'horizontal',
                                'start_opacity' => '0',
                                'end_opacity' => '1',
                                'start_location' => '27',
                                'end_location' => '63',
                            )
                        ),
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_Background_Gradient',
                            'dependency' => array('slider-styles' => 'slide-style-1'),
                            'label' => __('Background Gradient Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .slide-overlay',
                            'rule' => 'background-gradient',
                            'media' => $media_viewport
                        )
                    ),
                )
            ),
            'title_tagline' => array(
                'title' => __('Site Identity', 'wpzoom'),
                'priority' => 20,
                'options' => array(
                    'hide-tagline' => array(
                        'setting' => array(
                            'sanitize_callback' => 'absint',
                            'default' => true
                        ),
                        'control' => array(
                            'label' => __('Show Tagline', 'wpzoom'),
                            'type' => 'checkbox',
                            'priority' => 11
                        ),
                        'style' => array(
                            'selector' => '.navbar-brand-wpz .tagline',
                            'rule' => 'display'
                        )
                    ),
                    'custom_logo_size' => array(
                        'setting' => array(
                            'sanitize_callback' => 'absint',
                            'default' => '100',
                            'transport' => 'postMessage'
                        ),
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_Range',
                            'label' => __( 'Logo Size (in percents)', 'wpzoom' ),
                            'description' => sprintf( __( 'Default: %s100%%%s', 'wpzoom' ), '<strong>', '</strong>' ),
                            'input_attrs' => array( 'min' => '10', 'max' => '100', 'step' => '5' ),
                            'priority' => 8
                        ),
                        'partial' => array(
                            'selector' => '.navbar-header > .navbar-brand-wpz',
                            'container_inclusive' => true,
                            'render_callback' => 'foodica_logo_resize_partial_callback'
                        )
                    ),
                    'custom_logo_retina_ready' => array(
                        'setting' => array(
                            'sanitize_callback' => 'absint',
                            'default' => false,
                        ),
                        'control' => array(
                            'label' => __('Retina Ready?', 'wpzoom'),
                            'type' => 'checkbox',
                            'priority' => 9
                        ),
                        'partial' => array(
                            'selector' => '.navbar-brand-wpz a',
                            'container_inclusive' => false,
                            'render_callback' => 'foodica_custom_logo'
                        )
                    ),
                    'blogname' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => get_option('blogname'),
                            'transport' => 'postMessage',
                            'type' => 'option'
                        ),
                        'control' => array(
                            'label' => __('Site Title', 'wpzoom'),
                            'type' => 'text',
                            'priority' => 9
                        ),
                        'partial' => array(
                            'selector' => '.navbar-brand-wpz a',
                            'container_inclusive' => false,
                            'render_callback' => 'zoom_customizer_partial_blogname'
                        )
                    ),
                    'blogdescription' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => get_option('blogdescription'),
                            'transport' => 'postMessage',
                            'type' => 'option'
                        ),
                        'control' => array(
                            'label' => __('Tagline', 'wpzoom'),
                            'type' => 'text',
                            'priority' => 10
                        ),
                        'partial' => array(
                            'selector' => '.navbar-brand-wpz .tagline',
                            'container_inclusive' => false,
                            'render_callback' => 'zoom_customizer_partial_blogdescription'
                        )
                    ),
                    'custom_logo' => array(
                        'partial' => array(
                            'selector' => '.navbar-brand-wpz a',
                            'container_inclusive' => false,
                            'render_callback' => 'foodica_custom_logo'
                        )
                    )
                )
            ),
            'header' => array(
                'title' => __('Header Options', 'wpzoom'),
                'priority' => 50,
                'options' => array(
                    'top-navbar' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => true
                        ),
                        'control' => array(
                            'label' => __('Show Top Navigation Menu', 'wpzoom'),
                            'type' => 'checkbox',
                        ),
                        'style' => array(
                            'selector' => '.top-navbar',
                            'rule' => 'display'
                        )
                    ),
                    'navbar-hide-search' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => true
                        ),
                        'control' => array(
                            'label' => __('Show Search Form', 'wpzoom'),
                            'type' => 'checkbox',
                        ),
                        'style' => array(
                            'selector' => '.sb-search',
                            'rule' => 'display'
                        )
                    ),

                    'navbar_sticky_menu' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'transport' => 'refresh',
                            'default' => true
                        ),
                        'control' => array(
                            'label' => __('Stick Menu at the Top?', 'wpzoom'),
                            'description' => __('Do you want the main menu to stay at the top when scrolling?', 'wpzoom'),
                            'control_type' => 'WPZOOM_Customizer_Control_Checkbox'
                        )
                    ),

                    'header-layout-type' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => 'wpz_header_layout_compact'
                        ),
                        'control' => array(
                            'label' => __('Header Layout on Mobile Devices', 'wpzoom'),
                            'description' => __('You\'ll need to Save the changes and Refresh the Customizer page to see the changes', 'wpzoom'),
                            'type' => 'radio',
                            'choices' => array(
                                'wpz_header_layout_compact' => __('Compact (new)', 'wpzoom'),
                                'wpz_header_layout_classic' => __('Classic', 'wpzoom')
                              )
                        ),
                        'dom' => array(
                            'selector' => '.navbar .inner-wrap',
                            'rule' => 'toggle-class'
                        )
                    ),


                )
            ),
            'color' => array(
                'title' => __('General', 'wpzoom'),
                'panel' => 'color-scheme',
                'priority' => 110,
                'capability' => 'edit_theme_options',
                'options' => array(
                    'color-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Background Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'body',
                            'rule' => 'background'
                        )
                    ),
                    'color-body-text' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#444444'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Body Text', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'body, h1, h2, h3, h4, h5, h6',
                            'rule' => 'color'
                        )
                    ),

                    'general-logo-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Site Title', 'wpzoom'),
                        ),
                    ),

                    'color-logo' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Logo Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.navbar-brand-wpz a',
                            'rule' => 'color'
                        ),
                    ),
                    'color-logo-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Logo Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.navbar-brand-wpz a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-tagline' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#c7c7c7'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Site Description', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.navbar-brand-wpz .tagline',
                            'rule' => 'color'
                        ),
                    ),

                    'general-links-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Links', 'wpzoom'),
                        ),
                    ),

                    'color-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Link Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'a',
                            'rule' => 'color'
                        )
                    ),
                    'color-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Link Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'a:hover',
                            'rule' => 'color'
                        ),
                    ),

                    'general-buttons-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Buttons', 'wpzoom'),
                        ),
                    ),

                    'color-button-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'button, input[type=button], input[type=reset], input[type=submit]',
                            'rule' => 'background'
                        ),
                    ),
                    'color-button-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#fff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'button, input[type=button], input[type=reset], input[type=submit]',
                            'rule' => 'color'
                        ),
                    ),
                    'color-button-background-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Background on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'button:hover, input[type=button]:hover, input[type=reset]:hover, input[type=submit]:hover',
                            'rule' => 'background'
                        ),
                    ),
                    'color-button-color-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#fff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Buttons Text Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => 'button:hover, input[type=button]:hover, input[type=reset]:hover, input[type=submit]:hover',
                            'rule' => 'color'
                        ),
                    ),
                ),

            ),
            'color-top-menu' => array(
                'panel' => 'color-scheme',
                'title' => __('Top Menu', 'wpzoom'),
                'options' => array(
                    'color-top-menu-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#f5f5f5'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Top Menu Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.top-navbar',
                            'rule' => 'background'
                        )
                    ),
                    'color-top-menu-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Item', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.top-navbar .navbar-wpz > li > a',
                            'rule' => 'color'
                        )
                    ),
                    'color-top-menu-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Item Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.top-navbar navbar-wpz > li > a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-top-menu-link-current' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Current Item', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.top-navbar .navbar-wpz .current-menu-item > a, .top-navbar .navbar-wpz .current_page_item > a, .top-navbar .navbar-wpz .current-menu-parent > a',
                            'rule' => 'color'
                        )
                    )
                )
            ),
            'color-main-menu' => array(
                'panel' => 'color-scheme',
                'title' => __('Main Menu', 'wpzoom'),
                'options' => array(
                    'color-menu-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => ''
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Main Menu Background', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.main-navbar',
                                'rule' => 'background'
                            ),
                            array(
                                'selector' => '.main-navbar',
                                'rule' => 'border-top-color'
                            ),
                            array(
                                'selector' => '.main-navbar',
                                'rule' => 'border-bottom-color'
                            )
                        )
                    ),
                    'color-menu-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Item', 'wpzoom'),
                        ),
                        'style' => array(
                            'id' => 'color-menu-link',
                            'selector' => '.main-navbar .navbar-wpz > li > a',
                            'rule' => 'color'
                        )
                    ),
                    'color-menu-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Item Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.main-navbar .navbar-wpz > li > a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-menu-link-current' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Menu Current Item', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.main-navbar .navbar-wpz > .current-menu-item > a, .main-navbar .navbar-wpz > .current_page_item > a, .main-navbar .navbar-wpz > .current-menu-parent > a',
                            'rule' => 'color'
                        )
                    ),

                    'menu-search-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Search Icon', 'wpzoom'),
                        ),
                    ),

                    'color-search-icon-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Search Icon Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.sb-search .sb-icon-search',
                            'rule' => 'background'
                        )
                    ),
                    'color-search-icon' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#fff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Search Icon Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.sb-search .sb-icon-search',
                            'rule' => 'color'
                        )
                    ),
                    'color-search-icon-background-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Search Icon Background on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.sb-search .sb-icon-search:hover, .sb-search .sb-search-input',
                            'rule' => 'background'
                        )
                    ),
                    'color-search-icon-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#ffffff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Search Icon Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.sb-search .sb-icon-search:hover, .sb-search .sb-search-input, .sb-search.sb-search-open .sb-icon-search:before',
                            'rule' => 'color'
                        )
                    )
                )
            ),
            'color-slider' => array(
                'panel' => 'color-scheme',
                'title' => __('Homepage Slider', 'wpzoom'),
                'description' => __('You can customize the Blue Gradient from the Slider in <a href="javascript:wp.customize.section( \'slider-container\' ).focus();">Slider Styles</a> section from the Customizer.', 'wpzoom'),

                'options' => array(
                    'color-slider-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#EFF4F7'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Slide Background', 'wpzoom'),
                            'description' => __('This option works only when <strong>Without Gradient</strong> slider style is selected.', 'wpzoom')
                        ),
                        'style' => array(
                            'selector' => '#slider',
                            'rule' => 'background',
                            'media' => $media_viewport
                        )
                    ),

                    'slider-title-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Slider Title', 'wpzoom'),
                        ),
                    ),

                    'color-slider-post-title' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Slide Title', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li h3 a',
                            'rule' => 'color',
                            'media' => $media_viewport
                        )
                    ),
                    'color-slider-post-title-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Slide Title Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li h3 a:hover',
                            'rule' => 'color',
                            'media' => $media_viewport
                        )
                    ),

                    'slider-meta-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Slider Meta', 'wpzoom'),
                        ),
                    ),

                    'color-slider-post-cat' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Category Link', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .cat-links a',
                            'rule' => 'color',
                            'media' => $media_viewport
                        )
                    ),
                    'color-slider-post-cat-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#9297a4'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Category Link Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .cat-links a:hover',
                            'rule' => 'color',
                            'media' => $media_viewport
                        )
                    ),
                    'color-slider-post-meta' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#9297a4'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .entry-meta',
                            'rule' => 'color'
                        )
                    ),
                    'color-slider-post-meta-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#9297a4'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .entry-meta a',
                            'rule' => 'color'
                        )
                    ),
                    'color-slider-post-meta-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#9297a4'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .entry-meta a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-slider-excerpt' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#9297a4'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Slide Excerpt (on Pages)', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides li .slide-header p',
                            'rule' => 'color'
                        )
                    ),

                    'slider-button-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Read More Button', 'wpzoom'),
                        ),
                    ),

                    'color-slider-button-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#fff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Text', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides .slide_button a',
                            'rule' => 'color',
                            'media' => $media_viewport
                        )
                    ),
                    'color-slider-button-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides .slide_button a',
                            'rule' => 'background',
                            'media' => $media_viewport
                        )
                    ),
                    'color-slider-button-color-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#fff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Text Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides .slide_button a:hover',
                            'rule' => 'color',
                            'media' => $media_viewport
                        )
                    ),
                    'color-slider-button-background-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Button Background Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.slides .slide_button a:hover',
                            'rule' => 'background',
                            'media' => $media_viewport
                        )
                    ),

                )
            ),
            'color-posts' => array(
                'panel' => 'color-scheme',
                'title' => __('Blog Posts', 'wpzoom'),
                'description' => __('Below you can customize the posts on front page, category pages, and other archive pages.', 'wpzoom'),

                'options' => array(
                    'color-post-title' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Title', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-title a',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-title-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Title Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-title a:hover',
                            'rule' => 'color'
                        )
                    ),

                    'post-details-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Post Details', 'wpzoom'),
                        ),
                    ),

                    'color-post-cat' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#acacac'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Category', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.cat-links a',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-cat-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Category Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.cat-links a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-meta' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#999999'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-meta',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-meta-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.entry-meta a',
                                'rule' => 'color'
                            ),
                            array(
                                'selector' => '.recent-posts .entry-meta a',
                                'rule' => 'border-color'
                            )
                        )
                    ),
                    'color-post-meta-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.entry-meta a:hover',
                                'rule' => 'color'
                            ),
                            array(
                                'selector' => '.recent-posts .entry-meta a:hover',
                                'rule' => 'border-color'
                            )
                        )
                    ),
                    'post-readmore-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Read More Button', 'wpzoom'),
                        ),
                    ),
                    'color-post-button-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.readmore_button a',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-button-color-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#fff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Text Color Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.readmore_button a:hover, .readmore_button a:active',
                            'rule' => 'color'
                        )
                    ),
                    'color-post-button-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => ''
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Background Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.readmore_button a',
                            'rule' => 'background-color'
                        )
                    ),
                    'color-post-button-background-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Background Color Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.readmore_button a:hover, .readmore_button a:active',
                            'rule' => 'background-color'
                        )
                    ),
                    'color-post-button-border' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#c7c9cf'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Border', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.readmore_button a',
                            'rule' => 'border-color'
                        )
                    ),
                    'color-post-button-border-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Border Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.readmore_button a:hover, .readmore_button a:active',
                            'rule' => 'border-color'
                        )
                    ),
                )
            ),
            'color-navigation' => array(
                'panel' => 'color-scheme',
                'title' => __('Page Navigation', 'wpzoom'),
                'options' => array(
                    'color-infinite-button' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Jetpack Infinite Scroll Button', 'wpzoom'),
                            'description' => __('If you have the Infinite Scroll feature enabled, you can change here the color of the "Older Posts" button. You can find more instructions in <a href="https://www.wpzoom.com/documentation/tempo/#infinite" target="_blank">Documentation</a>', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.infinite-scroll #infinite-handle span',
                            'rule' => 'background'
                        )
                    ),

                    'color-infinite-button-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Jetpack Infinite Scroll Button Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.infinite-scroll #infinite-handle span:hover',
                            'rule' => 'background'
                        )
                    ),
                )
            ),
            'color-single' => array(
                'panel' => 'color-scheme',
                'title' => __('Individual Posts and Pages', 'wpzoom'),
                'options' => array(
                    'color-single-title' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#222222'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post/Page Title', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.page h1.entry-title, .single h1.entry-title',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#999999'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta', 'wpzoom'),
                        ),
                        'style' => array(
                            'id' => 'color-single-meta',
                            'selector' => '.single .entry-meta',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.single .entry-meta a',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-meta-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post Meta Link Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.single .entry-meta a:hover',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-content' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#444444'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Post/Page Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-content',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#0F7FAF'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Links Color in Posts', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.entry-content a',
                            'rule' => 'color'
                        )
                    ),

                    'post-tags-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Tags', 'wpzoom'),
                        ),
                    ),

                    'color-single-tags' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#FDE934'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Tags Line Color', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.tag_list a:after',
                                'rule' => 'background-color'
                            )
                        )
                    ),

                    'color-single-tags-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#FDE934'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Tags Line Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.tag_list a:hover',
                                'rule' => 'background'
                            ),
                            array(
                                'selector' => '.tag_list a:hover:after',
                                'rule' => 'background-color'
                            )
                        )
                    ),

                    'color-single-tags-text' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#000'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Tags Text Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            array(
                                'selector' => '.tag_list a:hover',
                                'rule' => 'color'
                            ),
                        )
                    ),


                    'post-recipecard-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Recipe Blocks', 'wpzoom'),
                        ),
                    ),


                    'color-single-ingredients' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#FBF9E7'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Ingredients Block Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.shortcode-ingredients, .wp-block-wpzoom-recipe-card-block-ingredients, .wp-block-wpzoom-recipe-card-block-recipe-card.is-style-default .recipe-card-ingredients',
                            'rule' => 'background'
                        )
                    ),
                    'color-single-ingredients-title' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#222'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Ingredients Block Title', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.shortcode-ingredients > h3, .wp-block-wpzoom-recipe-card-block-ingredients .ingredients-title, .wp-block-wpzoom-recipe-card-block-recipe-card.is-style-default .ingredients-title, .wp-block-wpzoom-recipe-card-block-recipe-card.is-style-default .directions-title, .wp-block-wpzoom-recipe-card-block-recipe-card.is-style-default .notes-title',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-ingredients-text' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#736458'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Ingredients Block Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.shortcode-ingredients, .wp-block-wpzoom-recipe-card-block-ingredients, .wp-block-wpzoom-recipe-card-block-recipe-card.is-style-default .recipe-card-ingredients',
                            'rule' => 'color'
                        )
                    ),
                    'color-single-ingredients-lines' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#e9e5c9'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Ingredients Block Divider Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.shortcode-ingredients > ul > li, .wp-block-wpzoom-recipe-card-block-ingredients .ingredients-list>li, .wp-block-wpzoom-recipe-card-block-recipe-card.is-style-default .ingredients-list>li, .wp-block-wpzoom-recipe-card-block-recipe-card.is-style-default .ingredients-list>li .tick-circle, .wp-block-wpzoom-recipe-card-block-ingredients .ingredients-list>li::before',
                            'rule' => 'border-color'
                        )
                    ),


                )
            ),
            'color-widgets' => array(
                'panel' => 'color-scheme',
                'title' => __('Widgets', 'wpzoom'),
                'options' => array(
                    'color-widget-title' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Widget Title Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.widget .title',
                            'rule' => 'color'
                        )
                    ),
                    'color-widget-title-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => ''
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Widget Title Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.widget .title',
                            'rule' => 'background'
                        )
                    ),

                    'about-general-html' => array(
                        'control' => array(
                            'control_type' => 'WPZOOM_Customizer_Control_HTML',
                            'html' => __('Author Bio Widget', 'wpzoom'),
                        ),
                    ),

                    'color-widget-about-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.wpzoom-bio .wpz_about_button',
                            'rule' => 'background'
                        )
                    ),

                    'color-widget-about-hover-background' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Background on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.wpzoom-bio .wpz_about_button:hover',
                            'rule' => 'background'
                        )
                    ),

                    'color-widget-about-text' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#fff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Text Color', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.wpzoom-bio .wpz_about_button',
                            'rule' => 'color'
                        )
                    ),

                    'color-widget-about-text-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#fff'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Read More Button Text Color on Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.wpzoom-bio .wpz_about_button:hover',
                            'rule' => 'color'
                        )
                    ),

                )
            ),
            'color-footer' => array(
                'panel' => 'color-scheme',
                'title' => __('Footer', 'wpzoom'),
                'options' => array(
                    'footer-background-color' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#EFF4F7'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Footer Menu Background', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.footer-menu',
                            'rule' => 'background-color'
                        )
                    ),
                    'color-footer-link' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#363940'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Footer Menu Link', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.footer-menu ul li a',
                            'rule' => 'color'
                        )
                    ),

                    'color-footer-link-hover' => array(
                        'setting' => array(
                            'sanitize_callback' => 'maybe_hash_hex_color',
                            'transport' => 'postMessage',
                            'default' => '#818592'
                        ),
                        'control' => array(
                            'control_type' => 'WP_Customize_Color_Control',
                            'label' => __('Footer Menu Link Hover', 'wpzoom'),
                        ),
                        'style' => array(
                            'selector' => '.footer-menu ul li a:hover',
                            'rule' => 'color'
                        )
                    ),

                )
            ),
            /**
             *  Typography
             */
            'font-site-body' => array(
                'panel' => 'typography',
                'title' => __('Body', 'wpzoom'),
                'options' => array(
                    'body' => array(
                        'type' => 'typography',
                        'selector' => 'body',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-family-sync-all' => false,
                            'font-size' => 16,
                            'font-weight' => 'normal',
                            'letter-spacing' => 0,
                            'font-subset' => 'latin',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 16,
                            'tablet' => 16,
                            'mobile' => 16
                        )
                    )
                )
            ),
            'font-site-title' => array(
                'panel' => 'typography',
                'title' => __('Site Title', 'wpzoom'),
                'options' => array(
                    'title' => array(
                        'type' => 'typography',
                        'selector' => '.navbar-brand-wpz h1',
                        'rules' => array(
                            'font-family' => 'Annie Use Your Telescope',
                            'font-size' => 85,
                            'font-weight' => 'normal',
                            'text-transform' => 'none',
                            'letter-spacing' => 0,
                            'font-subset' => 'latin',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 85,
                            'tablet' => 60,
                            'mobile' => 36
                        )
                    )
                )
            ),
            'description-typography' => array(
                'panel' => 'typography',
                'title' => __('Site Description', 'wpzoom'),
                'options' => array(
                    'description' => array(
                        'type' => 'typography',
                        'selector' => '.navbar-brand-wpz .tagline',
                        'rules' => array(
                            'font-family' => 'Roboto Condensed',
                            'font-size' => 16,
                            'font-weight' => 'normal',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => 1,
                            'font-subset' => 'latin',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 16,
                            'tablet' => 16,
                            'mobile' => 14
                        )
                    )
                )
            ),
            'topmenu-typography' => array(
                'panel' => 'typography',
                'title' => __('Top Menu Links', 'wpzoom'),
                'options' => array(
                    'topmenu' => array(
                        'type' => 'typography',
                        'selector' => '.top-navbar a',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 12,
                            'font-weight' => 'normal',
                            'letter-spacing' => 1,
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-nav' => array(
                'panel' => 'typography',
                'title' => __('Main Menu Links', 'wpzoom'),
                'options' => array(
                    'mainmenu' => array(
                        'type' => 'typography',
                        'selector' => '.main-navbar a',
                        'rules' => array(
                            'font-family' => 'Roboto Condensed',
                            'font-size' => 18,
                            'font-weight' => 'normal',
                            'letter-spacing' => 0,
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-nav-mobile' => array(
                'panel' => 'typography',
                'title' => __('Main Menu Links (Mobile)', 'wpzoom'),
                'options' => array(
                    'mainmenu-mobile' => array(
                        'type' => 'typography',
                        'selector' => '.slicknav_nav a',
                        'rules' => array(
                            'font-family' => 'Roboto Condensed',
                            'font-size' => 18,
                            'font-weight' => 'normal',
                            'letter-spacing' => 0,
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-slider' => array(
                'panel' => 'typography',
                'title' => __('Homepage Slider Title', 'wpzoom'),
                'options' => array(
                    'slider-title' => array(
                        'type' => 'typography',
                        'selector' => '.slides li h3 a',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 40,
                            'letter-spacing' => 0,
                            'font-weight' => '500',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 40,
                            'tablet' => 36,
                            'mobile' => 26
                        )
                    )
                )
            ),
            'font-slider-description' => array(
                'panel' => 'typography',
                'title' => __('Homepage Slider Description', 'wpzoom'),
                'options' => array(
                    'slider-text' => array(
                        'type' => 'typography',
                        'selector' => '.slides li .slide-header p',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 16,
                            'font-weight' => '600',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        )
                    )
                )
            ),
            'font-slider-button' => array(
                'panel' => 'typography',
                'title' => __('Homepage Slider Button', 'wpzoom'),
                'options' => array(
                    'slider-button' => array(
                        'type' => 'typography',
                        'selector' => '.slides .slide_button a',
                        'rules' => array(
                            'font-family' => 'Roboto Condensed',
                            'font-size' => 14,
                            'font-weight' => 'bold',
                            'letter-spacing' => 1,
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 14,
                            'tablet' => 14,
                            'mobile' => 14
                        )
                    )
                )
            ),
            'font-widgets' => array(
                'panel' => 'typography',
                'title' => __('Widget Title', 'wpzoom'),
                'options' => array(
                    'widget-title' => array(
                        'type' => 'typography',
                        'selector' => '.widget h3.title',
                        'rules' => array(
                            'font-family' => 'Roboto Condensed',
                            'font-size' => 18,
                            'font-weight' => 'bold',
                            'letter-spacing' => 1,
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 18,
                            'tablet' => 18,
                            'mobile' => 18
                        )
                    )
                )
            ),

            'font-post-title' => array(
                'panel' => 'typography',
                'title' => __('Blog Posts Title', 'wpzoom'),
                'options' => array(
                    'blog-title' => array(
                        'type' => 'typography',
                        'selector' => '.entry-title',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 24,
                            'font-weight' => '600',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 24,
                            'tablet' => 20,
                            'mobile' => 20
                        )
                    )
                )
            ),

            'font-archive-post-content' => array(
                'panel' => 'typography',
                'title' => __('Post Content (Homepage, Categories)', 'wpzoom'),
                'options' => array(
                    'post-content-archives' => array(
                        'type' => 'typography',
                        'selector' => '.recent-posts .entry-content',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 16,
                            'font-weight' => 'normal',
                            'letter-spacing' => 0,
                            'font-subset' => 'latin',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 16,
                            'tablet' => 16,
                            'mobile' => 16
                        )
                    )
                )
            ),

            'font-post-sticky-title' => array(
                'panel' => 'typography',
                'title' => __('Sticky Posts Title', 'wpzoom'),
                'options' => array(
                    'sticky-title' => array(
                        'type' => 'typography',
                        'selector' => '.recent-posts .post.sticky .entry-title',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 36,
                            'font-weight' => '600',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 36,
                            'tablet' => 26,
                            'mobile' => 26
                        )
                    )
                )
            ),

            'font-single-post-title' => array(
                'panel' => 'typography',
                'title' => __('Single Post Title', 'wpzoom'),
                'options' => array(
                    'post-title' => array(
                        'type' => 'typography',
                        'selector' => '.single h1.entry-title',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 38,
                            'font-weight' => '600',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 38,
                            'tablet' => 34,
                            'mobile' => 28
                        )
                    )
                )
            ),
            'font-single-post-content' => array(
                'panel' => 'typography',
                'title' => __('Single Post Content', 'wpzoom'),
                'options' => array(
                    'post-content' => array(
                        'type' => 'typography',
                        'selector' => '.single .entry-content, .page .entry-content',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 16,
                            'font-weight' => 'normal',
                            'letter-spacing' => 0,
                            'font-subset' => 'latin',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 16,
                            'tablet' => 16,
                            'mobile' => 16
                        )
                    )
                )
            ),
            'font-page-title' => array(
                'panel' => 'typography',
                'title' => __('Single Page Title', 'wpzoom'),
                'options' => array(
                    'page-title' => array(
                        'type' => 'typography',
                        'selector' => '.page h1.entry-title',
                        'rules' => array(
                            'font-family' => 'Inter',
                            'font-size' => 38,
                            'font-weight' => '600',
                            'text-transform' => 'none',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 44,
                            'tablet' => 34,
                            'mobile' => 28
                        )
                    )
                )
            ),
            'font-footer-menu' => array(
                'panel' => 'typography',
                'title' => __('Footer Menu', 'wpzoom'),
                'options' => array(
                    'footer-menu' => array(
                        'type' => 'typography',
                        'selector' => '.footer-menu ul li',
                        'rules' => array(
                            'font-family' => 'Roboto Condensed',
                            'font-size' => 16,
                            'font-weight' => 'normal',
                            'letter-spacing' => 0,
                            'text-transform' => 'uppercase',
                            'font-style' => 'normal'
                        ),
                        'font-size-responsive' => array(
                            'desktop' => 16,
                            'tablet' => 16,
                            'mobile' => 16
                        )
                    )
                )
            ),
            'footer-area' => array(
                'title' => __('Footer', 'wpzoom'),
                'options' => array(
                    'footer-widget-areas' => array(
                        'setting' => array(
                            'default' => '3',
                            'sanitize_callback' => 'sanitize_text_field',
                            'transport' => 'refresh'
                        ),
                        'control' => array(
                            'type' => 'select',
                            'label' => __('Number of Widget Areas', 'wpzoom'),
                            'choices' => array( '0', '1', '2', '3', '4' ),
                        )
                    ),
                    'blogcopyright' => array(
                        'setting' => array(
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => get_option('blogcopyright', sprintf( __( 'Copyright &copy; %1$s %2$s', 'wpzoom' ), date( 'Y' ), get_bloginfo( 'name' ) )),
                            'transport' => 'postMessage',
                            'type' => 'option'
                        ),
                        'control' => array(
                            'label' => __('Footer Text', 'wpzoom'),
                            'type' => 'text',
                            'priority' => 10
                        ),
                        'partial' => array(
                            'selector' => '.site-info .copyright',
                            'container_inclusive' => false,
                            'render_callback' => 'zoom_customizer_partial_blogcopyright'
                        )

                    )
                )
            )
        );

        zoom_customizer_normalize_options($data);
    }


    return $data;
}

add_filter('wpzoom_customizer_data', 'foodica_customizer_data');