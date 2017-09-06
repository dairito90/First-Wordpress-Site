<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

// Add sidebar section
$wp_customize->add_section( 'yummy_layout', array(
	'title'               => esc_html__( 'Layout','yummy' ),
	'description'         => esc_html__( 'Layout section options.', 'yummy' ),
	'panel'               => 'yummy_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'yummy_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'yummy_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control( 'yummy_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Sidebar Position', 'yummy' ),
	'section'             => 'yummy_layout',
	'type'                => 'select',
	'choices'			  => yummy_sidebar_position(),
) );

// Site layout setting and control.
$wp_customize->add_setting( 'yummy_theme_options[site_layout]', array(
	'sanitize_callback'   => 'yummy_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control( 'yummy_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'yummy' ),
	'section'             => 'yummy_layout',
	'type'                => 'select',
	'choices'			  => yummy_site_layout(),
) );
