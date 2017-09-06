<?php
/**
 * Single-page Options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

$wp_customize->add_section( 'yummy_single_options', array(
	'title'             => esc_html__( 'Single Options','yummy' ),
	'description'       => esc_html__( 'Applies To Single Post Only.', 'yummy' ),
	'panel'             => 'yummy_theme_options_panel',
) );

// Date disable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[hide_date]', array(
	'sanitize_callback'	=> 'yummy_sanitize_checkbox',
	'default'          	=> $options['hide_date'],
) );

$wp_customize->add_control( 'yummy_theme_options[hide_date]', array(
	'label'            	=> esc_html__( 'Hide Date', 'yummy' ),
	'section'          	=> 'yummy_single_options',
	'type'             	=> 'checkbox',
) );

// Category disable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[hide_category]', array(
	'sanitize_callback'	=> 'yummy_sanitize_checkbox',
	'default'          	=> $options['hide_category'],
) );

$wp_customize->add_control( 'yummy_theme_options[hide_category]', array(
	'label'            	=> esc_html__( 'Hide Category', 'yummy' ),
	'section'          	=> 'yummy_single_options',
	'type'             	=> 'checkbox',
) );

// Tags disable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[hide_tags]', array(
	'sanitize_callback'	=> 'yummy_sanitize_checkbox',
	'default'          	=> $options['hide_tags'],
) );

$wp_customize->add_control( 'yummy_theme_options[hide_tags]', array(
	'label'            	=> esc_html__( 'Hide Tags', 'yummy' ),
	'section'          	=> 'yummy_single_options',
	'type'             	=> 'checkbox',
) );

// Author disable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[hide_author]', array(
	'sanitize_callback'	=> 'yummy_sanitize_checkbox',
	'default'          	=> $options['hide_author'],
) );

$wp_customize->add_control( 'yummy_theme_options[hide_author]', array(
	'label'            	=> esc_html__( 'Hide Author', 'yummy' ),
	'section'          	=> 'yummy_single_options',
	'type'             	=> 'checkbox',
) );