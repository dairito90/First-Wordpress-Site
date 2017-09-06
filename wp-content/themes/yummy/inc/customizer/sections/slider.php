<?php
/**
 * Slider options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */
// Add slider section
$wp_customize->add_section( 'yummy_slider_section', array(
	'title'             => esc_html__( 'Slider Section','yummy' ),
	'description'       => esc_html__( 'Slider options.', 'yummy' ),
	'panel'             => 'yummy_sections_panel',
) );
/**
 * Slider Options
 */
// Enable slider.
$wp_customize->add_setting( 'yummy_theme_options[enable_slider]', array(
	'default'           => $options['enable_slider'],
	'sanitize_callback' => 'yummy_sanitize_checkbox',
) );

$wp_customize->add_control( 'yummy_theme_options[enable_slider]', array(
	'label'             => esc_html__( 'Enable Slider', 'yummy' ),
	'section'           => 'yummy_slider_section',
	'type'				=> 'checkbox'
) );

// Add enable slider pager setting and control.
$wp_customize->add_setting( 'yummy_theme_options[enable_slider_arrows]', array(
	'default'           => $options['enable_slider_arrows'],
	'sanitize_callback' => 'yummy_sanitize_checkbox'
) );

$wp_customize->add_control( 'yummy_theme_options[enable_slider_arrows]', array(
	'active_callback' => 'yummy_is_slider_enable',
	'label'           => esc_html__( 'Enable Arrows Controls?', 'yummy' ),
	'section'         => 'yummy_slider_section',
	'type'            => 'checkbox',
) );

// Slider Loop setting and control.
$wp_customize->add_setting( 'yummy_theme_options[enable_infinite_sliding]', array(
	'default'           => $options['enable_infinite_sliding'],
	'sanitize_callback' => 'yummy_sanitize_checkbox'
) );

$wp_customize->add_control( 'yummy_theme_options[enable_infinite_sliding]', array(
	'active_callback' => 'yummy_is_slider_enable',
	'label'           => esc_html__( 'Enable infinite sliding?', 'yummy' ),
	'description'     => esc_html__( 'Checking this will let the slider to slide from last to first.', 'yummy' ),
	'section'         => 'yummy_slider_section',
	'type'            => 'checkbox',
) );

// Horizontal Line
$wp_customize->add_setting( 'yummy_theme_options[slider_basic_controls]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Yummy_Customize_Horizontal_Line( $wp_customize, 'yummy_theme_options[slider_basic_controls]',
	array(
		'active_callback' => 'yummy_is_slider_enable',
		'section'         => 'yummy_slider_section',
		'type'			  => 'hr',
) ) );

/**
 * Slider content type options.
 */
$wp_customize->add_setting( 'yummy_theme_options[slider_content_type]', array(
	'default'           => $options['slider_content_type'],
	'sanitize_callback' => 'yummy_sanitize_select',
) );

$wp_customize->add_control( 'yummy_theme_options[slider_content_type]', array(
	'active_callback'	=> 'yummy_is_slider_enable',
	'label'             => esc_html__( 'Content Type', 'yummy' ),
	'section'           => 'yummy_slider_section',
	'choices'			=> array(
        'page'     => esc_html__( 'Page', 'yummy' ),
        ),
	'type'				=> 'select'
) );

for ( $i=1; $i <= 3; $i++ ) { 
	/**
	 * Page Content Type Options
	 */
	// Page Options
	$wp_customize->add_setting( 'yummy_theme_options[slider_page_'.$i.']', array(
		'sanitize_callback' => 'yummy_sanitize_page'
	) );

	$wp_customize->add_control( 'yummy_theme_options[slider_page_'.$i.']', array(
		'active_callback' => 'yummy_is_slider_enable',
		'label'           => esc_html__( 'Select Page ', 'yummy' ) . $i,
		'section'         => 'yummy_slider_section',
		'type'            => 'dropdown-pages',
	) );
}