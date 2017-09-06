<?php
/**
 * Yummy functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

if ( ! function_exists( 'yummy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function yummy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'yummy' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'yummy', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'yummy' ),
			'social'  => esc_html__( 'Footer Social Menu', 'yummy' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'yummy_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', yummy_fonts_url() ) );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add WooCommerce support
		add_theme_support( 'woocommerce' );
		
		if ( class_exists( 'WooCommerce' ) ) {
	    	global $woocommerce;
	
	    	if( version_compare( $woocommerce->version, '3.0.0', ">=" ) ) {
	      		add_theme_support( 'wc-product-gallery-zoom' );
				add_theme_support( 'wc-product-gallery-lightbox' );
				add_theme_support( 'wc-product-gallery-slider' );
			}
	  	}
		
	}
endif;
add_action( 'after_setup_theme', 'yummy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yummy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'yummy_content_width', 640 );
}
add_action( 'after_setup_theme', 'yummy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yummy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'yummy' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'yummy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Optional Sidebar 1', 'yummy' ),
		'id'            => 'optional_sidebar_1',
		'description'   => esc_html__( 'This is optional sidebar 1.', 'yummy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'yummy_widgets_init' );


if ( ! function_exists( 'yummy_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function yummy_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Header Fonts
	 */

	/* translators: If there are characters in your language that are not supported by Courgette, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playball font: on or off', 'yummy' ) ) {
		$fonts[] = 'Playball:400';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'yummy' ) ) {
		$fonts[] = 'Montserrat:700';
	}

	/*
	 * Body Fonts
	 */

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Pontano Sans font: on or off', 'yummy' ) ) {
		$fonts[] = 'Pontano Sans:300';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Enqueue scripts and styles.
 */
function yummy_scripts() {
	$options = yummy_get_theme_options();
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'yummy-fonts', yummy_fonts_url(), array(), null );

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/plugins/css/font-awesome' .$min. '.css', array(), '4.6.3' );

	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/plugins/css/slick' .$min. '.css', array(), '1.6.0' );
	
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/plugins/css/slick-theme' .$min. '.css', array(), '1.6.0' );

	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/plugins/css/magnific-popup' .$min. '.css', array(), '' );
	
	wp_enqueue_style( 'yummy-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'yummy-golden', get_template_directory_uri() . '/assets/css/golden' .$min. '.css', array(), '' );
	
	// Load the html5 shiv.
	wp_enqueue_script( 'yummy-html5', get_template_directory_uri() . '/assets/js/html5' .$min. '.js', array(), '3.7.3' );
	wp_script_add_data( 'yummy-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'yummy-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' .$min. '.js', array(), '20160412', true );

	wp_enqueue_script( 'yummy-navigation', get_template_directory_uri() . '/assets/js/navigation' .$min. '.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-parallax', get_template_directory_uri() . '/assets/plugins/js/jquery.parallax' .$min. '.js', array('jquery'), '0.6.2', true );

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/plugins/js/slick' .$min. '.js', array('jquery'), '1.6.0', true );

	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/plugins/js/jquery.magnific.popup' .$min. '.js', array('jquery'), '1.1.0', true );

	wp_enqueue_script( 'yummy-custom', get_template_directory_uri() . '/assets/js/custom' .$min. '.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'yummy_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';