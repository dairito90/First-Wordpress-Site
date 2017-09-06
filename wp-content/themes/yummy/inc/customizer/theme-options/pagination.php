<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

// Add sidebar section
$wp_customize->add_section( 'yummy_pagination', array(
	'title'               => esc_html__( 'Pagination','yummy' ),
	'description'         => esc_html__( 'Pagination section options.', 'yummy' ),
	'panel'               => 'yummy_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'yummy_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'yummy_sanitize_checkbox',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( 'yummy_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'yummy' ),
	'section'             => 'yummy_pagination',
	'type'                => 'checkbox',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'yummy_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'yummy_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'yummy_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'yummy' ),
	'section'             => 'yummy_pagination',
	'type'                => 'select',
	'choices'			  => yummy_pagination_options(),
	'active_callback'	  => 'yummy_is_pagination_enable',
) );
