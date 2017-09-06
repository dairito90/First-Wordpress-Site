<?php
/**
 * Loader options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

$wp_customize->add_section( 'yummy_loader', array(
	'title'            		=> esc_html__( 'Loader','yummy' ),
	'panel'            		=> 'yummy_theme_options_panel',
) );

// Loader enable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[loader_enable]', array(
	'sanitize_callback'		=> 'yummy_sanitize_checkbox',
	'default'             	=> $options['loader_enable'],
) );

$wp_customize->add_control( 'yummy_theme_options[loader_enable]', array(
	'label'               	=> esc_html__( 'Enable loader', 'yummy' ),
	'description'			=> esc_html__( 'This option will enable an icon animation while loading.', 'yummy' ),
	'section'             	=> 'yummy_loader',
	'type'                	=> 'checkbox',
) );