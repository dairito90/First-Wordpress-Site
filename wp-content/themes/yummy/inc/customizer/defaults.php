<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 * @return array An array of default values
 */

function yummy_get_default_theme_options() {
	$theme_data = wp_get_theme();
	
	$yummy_default_options = array(

		//slider section
		'enable_slider'                 => false,
		'slider_content_type'           => 'page',
		'enable_infinite_sliding'       => true,
		'enable_slider_arrows'			=> true,

		//about section
		'enable_about'                  => false,
		'about_content_type'            => 'page',

		//special item section
		'enable_special_item'           => false,
		'special_item_header_type'      => 'page',
		'special_item_content_type'     => 'post',

		// Call to action section
		'enable_call_to_action'			=> false,
		'call_to_action_type'			=> 'page',

		//testimonial section
		'enable_testimonial'           	=> false,
		'testimonial_header_type'      	=> 'page',
		'testimonial_content_type'     	=> 'post',

		// item menu section
		'enable_item_menu'				=> false,
		'item_menu_title'				=> esc_html__( 'Menu', 'yummy' ),
		'item_menu_type'				=> 'category',
		
		// Theme Options
		'loader_enable'         		=> false,
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',
		'short_excerpt_length'          => 10,
		'hide_author_avatar'			=> false,
		'hide_blog_date'				=> false,
		'read_more_text'		        => esc_html__( 'View Details', 'yummy' ),
		'breadcrumb_enable'         	=> true,
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',
		'scroll_top_visible'        	=> true,
		'reset_options'      			=> false,
		'enable_frontpage_content' 		=> true,
		'hide_author'					=> false,
		'hide_category'					=> false,
		'hide_tags'						=> false,
		'hide_date'						=> false,
		'site_title_enable'				=> true,
		'site_description_enable'		=> true,
		'site_logo_enable'				=> true,

		//Footer Editor Options
		'copyright_text'                => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved', '1: Year, 2: Site Title with home URL', 'yummy' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'            => true,

	);

	$output = apply_filters( 'yummy_default_theme_options', $yummy_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}