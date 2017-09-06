<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

/*Footer Section*/
$wp_customize->add_section( 'yummy_section_footer', array(
	'title'      			=> esc_html__( 'Footer Options', 'yummy' ),
	'panel'      			=> 'yummy_theme_options_panel',
) );

// Copyright text setting and control.
$wp_customize->add_setting( 'yummy_theme_options[copyright_text]', array(
	'sanitize_callback'   => 'wp_kses_post',
	'default'             => $options['copyright_text'],
	'transport'				=> 'postMessage',
) );

$wp_customize->add_control( 'yummy_theme_options[copyright_text]', array(
	'label'               => esc_html__( 'Copyright', 'yummy' ),
	'section'             => 'yummy_section_footer',
	'type'                => 'textarea',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'yummy_theme_options[copyright_text]', array(
		'selector'            => '#colophon .wrapper .site-info span.copyright',
		'settings'            => 'yummy_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'yummy_copyright_text_callback',
    ) );
}

// Scroll top visible
$wp_customize->add_setting( 'yummy_theme_options[scroll_top_visible]', array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback'		=> 'yummy_sanitize_checkbox',
) );

$wp_customize->add_control( 'yummy_theme_options[scroll_top_visible]', array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'yummy' ),
		'section'    			=> 'yummy_section_footer',
		'type'		 			=> 'checkbox',
) );
