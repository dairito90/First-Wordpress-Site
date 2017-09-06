<?php
/**
 * Item Menu options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

// Add Item Menu section
$wp_customize->add_section( 'yummy_item_menu_section', array(
	'title'             => esc_html__( 'Items Menu Section','yummy' ),
	'description'       => esc_html__( 'Items Menu options.', 'yummy' ),
	'panel'             => 'yummy_sections_panel',
) );

/**
 * Item Menu Options
 */
// Enable Item Menu.
$wp_customize->add_setting( 'yummy_theme_options[enable_item_menu]', array(
	'default'           => $options['enable_item_menu'],
	'sanitize_callback' => 'yummy_sanitize_checkbox',
) );

$wp_customize->add_control( 'yummy_theme_options[enable_item_menu]', array(
	'label'             => esc_html__( 'Enable Item Menu Section', 'yummy' ),
	'section'           => 'yummy_item_menu_section',
	'type'				=> 'checkbox'
) );

/**
 * Title Options
 */
$wp_customize->add_setting( 'yummy_theme_options[item_menu_title]', array(
	'default'           => $options['item_menu_title'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'yummy_theme_options[item_menu_title]', array(
	'active_callback'	=> 'yummy_is_item_menu_active',
	'label'             => esc_html__( 'Title', 'yummy' ),
	'section'           => 'yummy_item_menu_section',
	'type'				=> 'text'
) );

/**
 * Item Menu Header type options.
 *
 */
$wp_customize->add_setting( 'yummy_theme_options[item_menu_type]', array(
	'default'           => $options['item_menu_type'],
	'sanitize_callback' => 'yummy_sanitize_select',
) );

$wp_customize->add_control( 'yummy_theme_options[item_menu_type]', array(
	'active_callback'	=> 'yummy_is_item_menu_active',
	'label'             => esc_html__( 'Content Type', 'yummy' ),
	'section'           => 'yummy_item_menu_section',
	'choices'			=> yummy_item_menu_type_options(),
	'type'				=> 'select'
) );

/**
 * Category Content Type Options
 */
for ( $i = 1; $i <= 2; $i++ ) {
	// Show category type setting and control
	$wp_customize->add_setting( 'yummy_theme_options[item_menu_category_' . $i . ']', array(
		'sanitize_callback' => 'yummy_sanitize_single_category'
	) );

	$wp_customize->add_control( new Yummy_Dropdown_Single_Category_Control( $wp_customize, 'yummy_theme_options[item_menu_category_' . $i . ']', array(
		'label'           => sprintf( esc_html__( 'Select Category %d', 'yummy' ), $i ),
		'description'     => esc_html__( 'Max 4 latest posts from selected category will be shown.', 'yummy' ),
		'section'         => 'yummy_item_menu_section',
		'type'			  => 'dropdown-category',
		'active_callback' => 'yummy_is_item_menu_content_category',
	) ) );
}

/**
 * Woo Category Content Type Options
 */
for ( $i = 1; $i <= 2; $i++ ) {
	// Show category type setting and control
	$wp_customize->add_setting( 'yummy_theme_options[item_menu_woo_category_' . $i . ']', array(
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new Yummy_Dropdown_Single_Category_Control( $wp_customize, 'yummy_theme_options[item_menu_woo_category_' . $i . ']', array(
		'label'           => sprintf( esc_html__( 'Select Product Category %d', 'yummy' ), $i ),
		'description'     => esc_html__( 'Max 4 latest products from selected category will be shown.', 'yummy' ),
		'section'         => 'yummy_item_menu_section',
		'taxonomy'		  => 'product_cat',
		'type'			  => 'dropdown-category',
		'active_callback' => 'yummy_is_item_menu_content_woo_category',
	) ) );
}