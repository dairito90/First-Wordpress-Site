<?php
/**
 * Blog options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

// Add excerpt section
$wp_customize->add_section( 'yummy_blog_section', array(
	'title'             => esc_html__( 'Blog Options','yummy' ),
	'description'       => esc_html__( 'Applies to archive and search page too.', 'yummy' ),
	'panel'             => 'yummy_theme_options_panel',
) );

// Author Image.
$wp_customize->add_setting( 'yummy_theme_options[hide_author_avatar]', array(
	'sanitize_callback' => 'yummy_sanitize_checkbox',
	'default'			  => $options['hide_author_avatar'],
) );

$wp_customize->add_control( 'yummy_theme_options[hide_author_avatar]', array(
	'label'       => esc_html__( 'Hide Author Avatar', 'yummy' ),
	'section'     => 'yummy_blog_section',
	'type'        => 'checkbox',
) );

// Date.
$wp_customize->add_setting( 'yummy_theme_options[hide_blog_date]', array(
	'sanitize_callback' => 'yummy_sanitize_checkbox',
	'default'			  => $options['hide_blog_date'],
) );

$wp_customize->add_control( 'yummy_theme_options[hide_blog_date]', array(
	'label'       => esc_html__( 'Hide Blog Date', 'yummy' ),
	'section'     => 'yummy_blog_section',
	'type'        => 'checkbox',
) );

// Read more text.
$wp_customize->add_setting( 'yummy_theme_options[read_more_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			  => $options['read_more_text'],
) );

$wp_customize->add_control( 'yummy_theme_options[read_more_text]', array(
	'label'       => esc_html__( 'Read More Text', 'yummy' ),
	'section'     => 'yummy_blog_section',
	'type'        => 'text',
) );
