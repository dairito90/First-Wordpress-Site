<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Yummy
* @since Yummy 0.1
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'yummy_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'yummy_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'yummy_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'yummy' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'yummy' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );