<?php
/**
 * Theme Palace Theme Customizer.
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

//load upgrade-to-pro section
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function yummy_customize_register( $wp_customize ) {
	$options = yummy_get_theme_options();

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load customize partial functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	// Load customize custom controls functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add panel for sections
	$wp_customize->add_panel( 'yummy_sections_panel' , array(
	    'title'      => esc_html__( 'HomePage Sections','yummy' ),
	    'description'=> esc_html__( 'These options only applies when a static front page is set.', 'yummy' ),
	    'priority'   => 140,
	) );

	// slider
	require get_template_directory() . '/inc/customizer/sections/slider.php';
	
	// about
	require get_template_directory() . '/inc/customizer/sections/about.php';

	// special item
	require get_template_directory() . '/inc/customizer/sections/special-item.php';

	// call to action
	require get_template_directory() . '/inc/customizer/sections/call-to-action.php';

	// item menu
	require get_template_directory() . '/inc/customizer/sections/item-menu.php';

	// testimonial
	require get_template_directory() . '/inc/customizer/sections/testimonial.php';


	// Add panel for common theme options
	$wp_customize->add_panel( 'yummy_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','yummy' ),
	    'description'=> esc_html__( 'Theme Palace Theme Options.', 'yummy' ),
	    'priority'   => 150,
	) );

	// loader
	require get_template_directory() . '/inc/customizer/theme-options/loader.php';

	// load layout
	require get_template_directory() . '/inc/customizer/theme-options/layout.php';

	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load blog-options
	require get_template_directory() . '/inc/customizer/theme-options/blog-options.php';

	// load breadcrumb option
	require get_template_directory() . '/inc/customizer/theme-options/breadcrumb.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load single option
	require get_template_directory() . '/inc/customizer/theme-options/single-options.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';

	// load header option
	require get_template_directory() . '/inc/customizer/theme-options/header.php';
}
add_action( 'customize_register', 'yummy_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function yummy_customize_preview_js() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_script( 'yummy_customizer', get_template_directory_uri() . '/assets/js/customizer' .$min. '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'yummy_customize_preview_js' );


if ( !function_exists( 'yummy_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Yummy 0.1
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function yummy_reset_options() {
		$options = yummy_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'yummy_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
			remove_theme_mod( 'header_textcolor' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'yummy_reset_options' );

if ( !function_exists( 'yummy_customize_scripts' ) ) :
	/**
	 * Custom scripts and styles on customize.php
	 *
	 * @since Yummy 1.0
	 */
	function yummy_customize_scripts() {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script( 'yummy_custom_customizer', get_template_directory_uri() . '/assets/js/custom-customizer' . $min . '.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true );

		$yummy_data = array(
			'reset_message' => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'yummy' )
		);

		// Send list of color variables as object to custom customizer js
		wp_localize_script( 'yummy_custom_customizer', 'yummy_data', $yummy_data );
	}
endif;
add_action( 'customize_controls_enqueue_scripts', 'yummy_customize_scripts');