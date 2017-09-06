<?php
/**
 * About options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */
// Add about section
$wp_customize->add_section( 'yummy_about_section', array(
	'title'             => esc_html__( 'About Section','yummy' ),
	'description'       => esc_html__( 'About options.', 'yummy' ),
	'panel'             => 'yummy_sections_panel',
) );
/**
 * About Options
 */
// Enable About.
$wp_customize->add_setting( 'yummy_theme_options[enable_about]', array(
	'default'           => $options['enable_about'],
	'sanitize_callback' => 'yummy_sanitize_checkbox',
) );

$wp_customize->add_control( 'yummy_theme_options[enable_about]', array(
	'label'             => esc_html__( 'Enable About', 'yummy' ),
	'section'           => 'yummy_about_section',
	'description'       => sprintf ( esc_html__( 'This section support a widget area on its left side. %1$s Go to Widget Page %2$s', 'yummy' ), '<a href="'. esc_url( admin_url( 'widgets.php' ) ) .'" target="_blank">','</a>' ),
	'type'				=> 'checkbox'
) );

/**
 * About content type options.
 */
$wp_customize->add_setting( 'yummy_theme_options[about_content_type]', array(
	'default'           => $options['about_content_type'],
	'sanitize_callback' => 'yummy_sanitize_select',
) );

$wp_customize->add_control( 'yummy_theme_options[about_content_type]', array(
	'active_callback'	=> 'yummy_is_about_enable',
	'label'             => esc_html__( 'Content Type', 'yummy' ),
	'section'           => 'yummy_about_section',
	'choices'			=> array(
            'page'     => esc_html__( 'Page', 'yummy' ),
        ),
	'type'				=> 'select'
) );

/**
 * Page Content Type Options
 */
// Page Options
$wp_customize->add_setting( 'yummy_theme_options[about_page]', array(
	'sanitize_callback' => 'yummy_sanitize_page'
) );

$wp_customize->add_control( 'yummy_theme_options[about_page]', array(
	'active_callback' => 'yummy_is_about_enable',
	'label'           => esc_html__( 'Select Page ', 'yummy' ),
	'description'	  => esc_html__( 'Select a Page to show as promotional contain.','yummy' ),
	'section'         => 'yummy_about_section',
	'type'            => 'dropdown-pages',
) );