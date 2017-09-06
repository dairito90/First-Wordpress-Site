<?php
/**
 * Call to action options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

// Add Call to action section
$wp_customize->add_section( 'yummy_call_to_action_section', array(
	'title'             => esc_html__( 'Call To Action Section','yummy' ),
	'description'       => esc_html__( 'Call To Action options.', 'yummy' ),
	'panel'             => 'yummy_sections_panel',
) );

/**
 * Call To Action Options
 */
// Enable Call To Action.
$wp_customize->add_setting( 'yummy_theme_options[enable_call_to_action]', array(
	'default'           => $options['enable_call_to_action'],
	'sanitize_callback' => 'yummy_sanitize_checkbox',
) );

$wp_customize->add_control( 'yummy_theme_options[enable_call_to_action]', array(
	'label'             => esc_html__( 'Enable Call To Action Section', 'yummy' ),
	'section'           => 'yummy_call_to_action_section',
	'type'				=> 'checkbox'
) );

/**
 * Call To Action Header type options.
 *
 * Choices options are similar to special item header section therefore choices function is reused. 
 */
$wp_customize->add_setting( 'yummy_theme_options[call_to_action_type]', array(
	'default'           => $options['call_to_action_type'],
	'sanitize_callback' => 'yummy_sanitize_select',
) );

$wp_customize->add_control( 'yummy_theme_options[call_to_action_type]', array(
	'active_callback'	=> 'yummy_is_call_to_action_active',
	'label'             => esc_html__( 'Content Type', 'yummy' ),
	'section'           => 'yummy_call_to_action_section',
	'choices'			=> array(
            'page'      => esc_html__( 'Page', 'yummy' ),
        ),
	'type'				=> 'select'
) );

/**
 * Call To Action type page Options
 */
$wp_customize->add_setting( 'yummy_theme_options[call_to_action_page]', array(
	'sanitize_callback' => 'yummy_sanitize_page',
) );

$wp_customize->add_control( 'yummy_theme_options[call_to_action_page]', array(
	'active_callback'	=> 'yummy_is_call_to_action_active',
	'label'             => esc_html__( 'Select Page', 'yummy' ),
	'description'       => esc_html__( 'Info: Make sure selected page has featured image.', 'yummy' ),
	'section'           => 'yummy_call_to_action_section',
	'type'				=> 'dropdown-pages'
) );