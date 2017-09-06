<?php
/**
 * Testimonial options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */
// Add Testimonial section
$wp_customize->add_section( 'yummy_testimonial_section', array(
	'title'             => esc_html__( 'Testimonial Section','yummy' ),
	'description'       => esc_html__( 'Testimonial options.', 'yummy' ),
	'panel'             => 'yummy_sections_panel',
) );
/**
 * Testimonial Options
 */
// Enable Testimonial.
$wp_customize->add_setting( 'yummy_theme_options[enable_testimonial]', array(
	'default'           => $options['enable_testimonial'],
	'sanitize_callback' => 'yummy_sanitize_checkbox',
) );

$wp_customize->add_control( 'yummy_theme_options[enable_testimonial]', array(
	'label'             => esc_html__( 'Enable Testimonial Section', 'yummy' ),
	'section'           => 'yummy_testimonial_section',
	'type'				=> 'checkbox',
) );

/**
 * Testimonial Header Label.
 */
$wp_customize->add_setting( 'yummy_theme_options[testimonial_header_label]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( new Yummy_Note_Control( $wp_customize, 'yummy_theme_options[testimonial_header_label]', array(
	'label'           	=> esc_html__( 'Header Options', 'yummy' ),
	'section'         	=> 'yummy_testimonial_section',
	'type'            	=> 'description',
	'active_callback' 	=> 'yummy_is_testimonial_section_active',
) ) );

/**
 * Testimonial Header type options.
 */
$wp_customize->add_setting( 'yummy_theme_options[testimonial_header_type]', array(
	'default'           => $options['testimonial_header_type'],
	'sanitize_callback' => 'yummy_sanitize_select',
) );

$wp_customize->add_control( 'yummy_theme_options[testimonial_header_type]', array(
	'active_callback'	=> 'yummy_is_testimonial_section_active',
	'label'             => esc_html__( 'Header Type', 'yummy' ),
	'section'           => 'yummy_testimonial_section',
	'choices'			=> array(
            'page'      => esc_html__( 'Page', 'yummy' ),
        ),
	'type'				=> 'select',
) );

/**
 * Testimonial Header page Options
 */
$wp_customize->add_setting( 'yummy_theme_options[testimonial_header_page]', array(
	'sanitize_callback' => 'yummy_sanitize_page',
) );

$wp_customize->add_control( 'yummy_theme_options[testimonial_header_page]', array(
	'active_callback'	=> 'yummy_is_testimonial_section_active',
	'label'             => esc_html__( 'Select Page', 'yummy' ),
	'description'       => esc_html__( 'Info: Make sure selected page has featured image.', 'yummy' ),
	'section'           => 'yummy_testimonial_section',
	'type'				=> 'dropdown-pages'
) );

/**
 * Testimonial hr setting and control
 */
$wp_customize->add_setting( 'yummy_theme_options[testimonial_hr]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Yummy_Customize_Horizontal_Line( $wp_customize, 'yummy_theme_options[testimonial_hr]',
	array(
		'section'         => 'yummy_testimonial_section',
		'active_callback' => 'yummy_is_testimonial_section_active',
		'type'			  => 'hr'
) ) );

/**
 * Testimonial Content Label.
 */
$wp_customize->add_setting( 'yummy_theme_options[testimonial_content_label]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( new Yummy_Note_Control( $wp_customize, 'yummy_theme_options[testimonial_content_label]', array(
	'label'           	=> esc_html__( 'Content Options', 'yummy' ),
	'section'         	=> 'yummy_testimonial_section',
	'type'            	=> 'description',
	'active_callback' 	=> 'yummy_is_testimonial_section_active',
) ) );

/**
 * Testimonial content type options.
 */
$wp_customize->add_setting( 'yummy_theme_options[testimonial_content_type]', array(
	'default'           => $options['testimonial_content_type'],
	'sanitize_callback' => 'yummy_sanitize_select',
) );

$wp_customize->add_control( 'yummy_theme_options[testimonial_content_type]', array(
	'active_callback'	=> 'yummy_is_testimonial_section_active',
	'label'             => esc_html__( 'Content Type', 'yummy' ),
	'section'           => 'yummy_testimonial_section',
	'choices'			=> array(
            'post'      => esc_html__( 'Post', 'yummy' ),
        ),
	'type'				=> 'select',
) );

/**
 * Post Content Type Options
 */
$wp_customize->add_setting( 'yummy_theme_options[testimonial_default_posts]', array(
	'sanitize_callback' => 'yummy_sanitize_post_ids',
) );

$wp_customize->add_control( 'yummy_theme_options[testimonial_default_posts]', array(
	'active_callback'	=> 'yummy_is_testimonial_section_active',
	'label'             => esc_html__( 'Input Post Ids', 'yummy' ),
	'description'       => esc_html__( 'Max. posts allowed is 4. ie: 11, 24, 34', 'yummy' ),
	'section'           => 'yummy_testimonial_section',
	'type'				=> 'text',
) );
