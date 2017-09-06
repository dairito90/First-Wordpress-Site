<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

$wp_customize->add_section( 'yummy_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','yummy' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'yummy' ),
	'panel'             => 'yummy_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[breadcrumb_enable]', array(
	'sanitize_callback'	=> 'yummy_sanitize_checkbox',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( 'yummy_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'yummy' ),
	'section'          	=> 'yummy_breadcrumb',
	'type'             	=> 'checkbox',
) );
