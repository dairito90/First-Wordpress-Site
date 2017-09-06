<?php
/**
 * Special Item options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.3
 */
// Add Special Item section
$wp_customize->add_section( 'yummy_special_item_section', array(
	'title'             => esc_html__( 'Special Items Section','yummy' ),
	'description'       => esc_html__( 'Special Items options.', 'yummy' ),
	'panel'             => 'yummy_sections_panel',
) );
/**
 * Special Item Options
 */
// Enable Special Item.
$wp_customize->add_setting( 'yummy_theme_options[enable_special_item]', array(
	'default'           => $options['enable_special_item'],
	'sanitize_callback' => 'yummy_sanitize_checkbox',
) );

$wp_customize->add_control( 'yummy_theme_options[enable_special_item]', array(
	'label'             => esc_html__( 'Enable Special Item Section', 'yummy' ),
	'section'           => 'yummy_special_item_section',
	'type'				=> 'checkbox'
) );

/**
 * Special Item Header Label.
 */
$wp_customize->add_setting( 'yummy_theme_options[special_item_header_label]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( new Yummy_Note_Control( $wp_customize, 'yummy_theme_options[special_item_header_label]', array(
	'label'           	=> esc_html__( 'Header Options', 'yummy' ),
	'section'         	=> 'yummy_special_item_section',
	'type'            	=> 'description',
	'active_callback' 	=> 'yummy_is_special_item_section_active',
) ) );

/**
 * Special Item Header type options.
 */
$wp_customize->add_setting( 'yummy_theme_options[special_item_header_type]', array(
	'default'           => $options['special_item_header_type'],
	'sanitize_callback' => 'yummy_sanitize_select',
) );

$wp_customize->add_control( 'yummy_theme_options[special_item_header_type]', array(
	'active_callback'	=> 'yummy_is_special_item_section_active',
	'label'             => esc_html__( 'Header Type', 'yummy' ),
	'section'           => 'yummy_special_item_section',
	'choices'			=> array(
            'page'      => esc_html__( 'Page', 'yummy' ),
        ),
	'type'				=> 'select'
) );

/**
 * Special Item Header page Options
 */
$wp_customize->add_setting( 'yummy_theme_options[special_item_header_page]', array(
	'sanitize_callback' => 'yummy_sanitize_page',
) );

$wp_customize->add_control( 'yummy_theme_options[special_item_header_page]', array(
	'active_callback'	=> 'yummy_is_special_item_section_active',
	'label'             => esc_html__( 'Select Page', 'yummy' ),
	'description'       => esc_html__( 'Info: Make sure selected page has featured image.', 'yummy' ),
	'section'           => 'yummy_special_item_section',
	'type'				=> 'dropdown-pages'
) );

/**
 * Special Item hr setting and control
 */
$wp_customize->add_setting( 'yummy_theme_options[special_item_hr]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Yummy_Customize_Horizontal_Line( $wp_customize, 'yummy_theme_options[special_item_hr]',
	array(
		'section'         => 'yummy_special_item_section',
		'active_callback' => 'yummy_is_special_item_section_active',
		'type'			  => 'hr'
) ) );

/**
 * Special Item Content Label.
 */
$wp_customize->add_setting( 'yummy_theme_options[special_item_content_label]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( new Yummy_Note_Control( $wp_customize, 'yummy_theme_options[special_item_content_label]', array(
	'label'           	=> esc_html__( 'Content Options', 'yummy' ),
	'section'         	=> 'yummy_special_item_section',
	'type'            	=> 'description',
	'active_callback' 	=> 'yummy_is_special_item_section_active',
) ) );

/**
 * Special Item content type options.
 */
$wp_customize->add_setting( 'yummy_theme_options[special_item_content_type]', array(
	'default'           => $options['special_item_content_type'],
	'sanitize_callback' => 'yummy_sanitize_select',
) );

$wp_customize->add_control( 'yummy_theme_options[special_item_content_type]', array(
	'active_callback'	=> 'yummy_is_special_item_section_active',
	'label'             => esc_html__( 'Content Type', 'yummy' ),
	'section'           => 'yummy_special_item_section',
	'choices'			=> array(
            'post'      => esc_html__( 'Post', 'yummy' ),
        ),
	'type'				=> 'select'
) );

/**
 * Post Content Type Options
 */
$wp_customize->add_setting( 'yummy_theme_options[special_item_content_post]', array(
	'sanitize_callback' => 'yummy_sanitize_post_ids',
) );

$wp_customize->add_control( 'yummy_theme_options[special_item_content_post]', array(
	'active_callback'	=> 'yummy_is_special_item_section_active',
	'label'             => esc_html__( 'Input Post Ids', 'yummy' ),
	'description'       => esc_html__( 'Max. posts allowed is 4. ie: 11, 24, 34', 'yummy' ),
	'section'           => 'yummy_special_item_section',
	'type'				=> 'text'
) );