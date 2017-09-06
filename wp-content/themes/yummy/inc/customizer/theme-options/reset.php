<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'yummy_reset_section', array(
	'title'             => esc_html__( 'Reset all settings','yummy' ),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'yummy' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'yummy_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'yummy_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'yummy_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'yummy' ),
	'description'		=> esc_html__( 'This option applies for customizer theme options values.','yummy'),
	'section'           => 'yummy_reset_section',
	'type'              => 'checkbox',
) );
