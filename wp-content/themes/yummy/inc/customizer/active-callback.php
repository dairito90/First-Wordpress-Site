<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

if ( ! function_exists( 'yummy_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Yummy 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'yummy_theme_options[pagination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'yummy_is_slider_enable' ) ) :
	/**
	 * Check if slider is enabled.
	 *
	 * @since Yummy 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_slider_enable( $control ) {
		if ( $control->manager->get_setting( 'yummy_theme_options[enable_slider]' )->value() ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'yummy_is_about_enable' ) ) :
	/**
	 * Check if about is enabled.
	 *
	 * @since Yummy 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_about_enable( $control ) {
		if ( $control->manager->get_setting( 'yummy_theme_options[enable_about]' )->value() ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'yummy_is_special_item_section_active' ) ) :
	/**
	 * Check if special item section is active.
	 *
	 * @since yummy 0.3
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_special_item_section_active( $control ) {		
		if ( $control->manager->get_setting( 'yummy_theme_options[enable_special_item]' )->value() ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'yummy_is_call_to_action_active' ) ) :
	/**
	 * Check if call to action section is active.
	 *
	 * @since Yummy 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_call_to_action_active( $control ) {		
		if ( $control->manager->get_setting( 'yummy_theme_options[enable_call_to_action]' )->value() ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'yummy_is_item_menu_active' ) ) :
	/**
	 * Check if special item menu section is active.
	 *
	 * @since Yummy 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_item_menu_active( $control ) {		
		if ( $control->manager->get_setting( 'yummy_theme_options[enable_item_menu]' )->value() ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'yummy_is_item_menu_content_category' ) ) :
	/**
	 * Check if item menu content is category.
	 *
	 * @since Yummy 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_item_menu_content_category( $control ) {		
		$item_menu_type = $control->manager->get_setting( 'yummy_theme_options[item_menu_type]' )->value();
		if ( yummy_is_item_menu_active( $control ) && 'category' == $item_menu_type ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'yummy_is_item_menu_content_woo_category' ) ) :
	/**
	 * Check if item menu content is woo category.
	 *
	 * @since Yummy 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_item_menu_content_woo_category( $control ) {		
		$item_menu_type = $control->manager->get_setting( 'yummy_theme_options[item_menu_type]' )->value();
		if ( yummy_is_item_menu_active( $control ) && 'woo-category' == $item_menu_type ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'yummy_is_testimonial_section_active' ) ) :
	/**
	 * Check if testimonial section is active.
	 *
	 * @since Yummy 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function yummy_is_testimonial_section_active( $control ) {
		if ( $control->manager->get_setting( 'yummy_theme_options[enable_testimonial]' )->value() ) {
			return true;
		}

		return false;
	}
endif;

