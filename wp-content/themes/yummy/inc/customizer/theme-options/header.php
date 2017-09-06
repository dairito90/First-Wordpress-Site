<?php
/**
 * Header options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.3
 */

// site title enable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[site_title_enable]', array(
	'sanitize_callback'	=> 'yummy_sanitize_checkbox',
	'default'          	=> $options['site_title_enable'],
) );

$wp_customize->add_control( 'yummy_theme_options[site_title_enable]', array(
	'label'            	=> esc_html__( 'Enable Site Title', 'yummy' ),
	'section'          	=> 'title_tagline',
	'type'             	=> 'checkbox',
) );

// site description enable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[site_description_enable]', array(
	'sanitize_callback'	=> 'yummy_sanitize_checkbox',
	'default'          	=> $options['site_description_enable'],
) );

$wp_customize->add_control( 'yummy_theme_options[site_description_enable]', array(
	'label'            	=> esc_html__( 'Enable Site Description', 'yummy' ),
	'section'          	=> 'title_tagline',
	'type'             	=> 'checkbox',
) );

// site logo enable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[site_logo_enable]', array(
	'sanitize_callback'	=> 'yummy_sanitize_checkbox',
	'default'          	=> $options['site_logo_enable'],
) );

$wp_customize->add_control( 'yummy_theme_options[site_logo_enable]', array(
	'label'            	=> esc_html__( 'Enable Site Logo', 'yummy' ),
	'section'          	=> 'title_tagline',
	'type'             	=> 'checkbox',
) );
