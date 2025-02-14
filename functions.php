<?php

function threehoops_theme_support() {

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'block-patterns' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'title-tag' );



    $color_palette = array();

    $colors = array(
        array( 'Primary Color', 'primary_color', 'primary-color' ),
        array( 'Secondary Color', 'secondary_color', 'secondary-color' ),
        array( 'Tertiary Color', 'tertiary_color', 'tertiary-color' ),
        array( 'Accent Color', 'accent_color', 'accent-color' ),
        array( 'Primary Background Color', 'primary_background_color', 'primary-background-color' ),
    );

    foreach ( $colors as $color ) :
        $theme_mod_color = get_theme_mod( $color[1] );
        if ( $theme_mod_color ) {
            array_push( $color_palette,
                array(
                    'name'  => __( $color[0], '3hoops' ),
                    'slug'  => $color[2],
                    'color' => esc_attr( $theme_mod_color ),
                )
            );
        }
    endforeach;

    add_theme_support( 'editor-color-palette', $color_palette );

}

add_action('after_setup_theme', 'threehoops_theme_support');



function threehoops_empty_navigation() {

    echo '<ul class="navigation"></ul>';

}



function threehoops_custom_mime_types( $mimes ) {
	
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'threehoops_custom_mime_types' );



function threehoops_customize_register( $wp_customize ) {

    $wp_customize->add_setting(
        'pride_mode',
        array(
            'default' => "auto"
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'pride_mode',
            array(
                'label' => __( 'Pride Mode', '3hoops' ),
                'type' => 'radio',
                'choices'   => array(
                    'auto' => __( 'Automatically', '3hoops' ),
                    'rainbow-pride' => __( 'Rainbow Pride', '3hoops' ),
                    'trans-pride' => __( 'Trans Pride', '3hoops' ),
                    'none' => __( 'None', '3hoops' ),
                ),
                'description' => 
                                __( 'Manually set the pride mode.<br/>
                                When set to automatically, Rainbow Pride mode is activated in June (Pride month)<br/>
                                When set to automatically, Trans Pride mode is activated on May 17th (IDAHOBIT) and March 31st (International Transgender Day of Visibility)', '3hoops' ),
                'section' => 'colors',
                'settings' => 'pride_mode',
            )
        )
    );



    $colors = array(
        array( 'Primary Color', 'primary_color', '#604734' ),
        array( 'Secondary Color', 'secondary_color', '#363636' ),
        array( 'Tertiary Color', 'tertiary_color', '#e2001a' ),
        array( 'Accent Color', 'accent_color', '#fff' ),
        array( 'Primary Background Color', 'primary_background_color', '#fff' ),
    );

    foreach ( $colors as $color ) :
        $wp_customize->add_setting(
            $color[1],
            array(
                'default' => $color[2],
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $color[1],
                array(
                    'label' => __( $color[0], '3hoops' ),
                    'section' => 'colors',
                    'settings' => $color[1],
                )
            )
        );
    endforeach;



    $wp_customize->add_section(
        'socialmedia',
        array(
            'title' => __( 'Social Media', '3hoops' ),
            'description' => __( 'Add links to your social media here<br/>Empty the field to remove the link icon', '3hoops' )
        )
    );

    $socials = array(
        array( 'Facebook', 'facebook_link', 'https://www.facebook.com/' ),
        array( 'Instagram', 'instagram_link', 'https://www.instagram.com/' ),
        array( 'Tiktok', 'tiktok_link', 'https://www.tiktok.com/' ),
        array( 'YouTube', 'youtube_link', 'https://www.youtube.com/' ),
        array( 'X', 'x_link', 'https://www.x.com/' ),
        array( 'Threads', 'threads_link', 'https://www.threads.net/' ),
        array( 'Bluesky', 'bluesky_link', 'https://bsky.app/' ),
        array( 'Reddit', 'reddit_link', 'https://www.reddit.com/' ),
        array( 'Github', 'github_link', 'https://www.github.com/' ),
    );

    foreach ( $socials as $social ) :
        $wp_customize->add_setting(
            $social[1],
            array(
                'default' => $social[2]
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $social[1],
                array(
                    'label' => __( $social[0], '3hoops' ),
                    'section' => 'socialmedia',
                    'settings' => $social[1],
                )
            )
        );
    endforeach;

}

add_action('customize_register', 'threehoops_customize_register');



remove_action( 'wp_head', '_wp_render_title_tag', 1 );



function threehoops_custom_css_properties() {

    echo '<style type="text/css" id="threehoops-variables">:root { ';

    $colors = array(
        array( 'primary_color', 'primary-color' ),
        array( 'secondary_color', 'secondary-color' ),
        array( 'tertiary_color', 'tertiary-color' ),
        array( 'accent_color', 'accent-color' ),
        array( 'primary_background_color', 'primary-background-color' ),
    );

    foreach ( $colors as $color ) :
        $theme_mod_color = get_theme_mod( $color[0] );
        if ( $theme_mod_color ) {
            echo '--' . $color[1] . ': ' . esc_attr( $theme_mod_color ) . '; ';
        }
    endforeach;

    echo '}</style>';

}

add_action( 'wp_head', 'threehoops_custom_css_properties');



function threehoops_nav_menus() {

    $location = array(
        'primary' => __( 'Main Navigation Menu', '3hoops' ),
        'footer' => __( 'Footer Navigation Menu, e.g. for legal links', '3hoops' )
    );

    register_nav_menus( $location );
    
}

add_action( 'init', 'threehoops_nav_menus' );



function threehoops_footer_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', '3hoops' ),
		'id'            => 'footer-widget',
		'description'   => __( 'Space for legal notices', '3hoops' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'threehoops_footer_widgets_init' );



function threehoops_allowed_block_types( $allowed_block_types, $block_editor_context ) {

	$allowed_block_types = array(
        'core/block',
        'core/button',
        'core/buttons',
        'core/code',
        'core/column',
        'core/columns',
        'core/cover',
        'core/details',
        'core/embed',
        'core/file',
        'core/gallery',
        'core/group',
        'core/heading',
        'core/html',
        'core/image',
        'core/list',
        'core/list-item',
        'core/media-text',
        'core/missing',
        'core/paragraph',
        'core/post-title',
        'core/quote',
        'core/separator',
        'core/shortcode',
        'core/site-tagline',
        'core/site-title',
        'core/spacer',
        'core/table',
        'core/video',
        'tablepress/table',
        'yoast/faq-block',
        'yoast/how-to-block',
	);

	return $allowed_block_types;

}

add_filter( 'allowed_block_types_all', 'threehoops_allowed_block_types', 10, 2 );



function threehoops_register_styles() {

    $version = wp_get_theme()->get( 'Version' );
    
    $stylesheets = array(
        'main',
    );

    foreach ( $stylesheets as $stylesheet ) :
        wp_enqueue_style( 'threehoops-' . $stylesheet, get_template_directory_uri() . '/assets/css/' . $stylesheet . '.css', array(), $version, 'all' );
    endforeach;

    wp_enqueue_style( 'threehoops-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', array(), '6.6.0', 'all' );



    if ( ! function_exists( 'is_plugin_active' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    
    $plugin_stylesheets = array(
        array( 'simple-calendar', 'google-calendar-events/google-calendar-events.php' ),
        array( 'tablepress', 'tablepress/tablepress.php' ),
        array( 'translatepress', 'translatepress-multilingual/index.php' ),
        array( 'yoast', 'wordpress-seo/wp-seo.php' ),
    );

    foreach ( $plugin_stylesheets as $plugin_stylesheet ) :
        if ( is_plugin_active( $plugin_stylesheet[1] ) ) {
            wp_enqueue_style( 'threehoops-' . $plugin_stylesheet[0], get_template_directory_uri() . '/assets/css/' . $plugin_stylesheet[0] . '.css', array(), $version, 'all' );
        }
    endforeach;

}

add_action('wp_enqueue_scripts', 'threehoops_register_styles');



function threehoops_register_scripts() {

    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_script( 'threehoops-jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true );

    $scripts = array(
        'main',
    );

    foreach ( $scripts as $script ) :
        wp_enqueue_script( 'threehoops-' . $script, get_template_directory_uri() . '/assets/js/' . $script . '.js', array(), $version, true );
    endforeach;

}

add_action('wp_enqueue_scripts', 'threehoops_register_scripts');


?>