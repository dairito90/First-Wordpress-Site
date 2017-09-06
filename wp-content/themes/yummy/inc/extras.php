<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function yummy_body_classes( $classes ) {
	$options = yummy_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Get testimonial section details
	$enable_testimonial = $options['enable_testimonial'];
    $testimonial_details = array();
    $testimonial_details = apply_filters( 'yummy_filter_testimonial_section_details', $testimonial_details );

	// Get item menu section details
    $enable_item_menu = $options['enable_item_menu'];
    $item_menu_details = array();
    $item_menu_details = apply_filters( 'yummy_filter_item_menu_section_details', $item_menu_details );

	// Get call to action section details
    $enable_call_to_action = $options['enable_call_to_action'];
    $call_to_action_details = array();
    $call_to_action_details = apply_filters( 'yummy_filter_call_to_action_section_details', $call_to_action_details );
	
	$classes[] = ( empty( $testimonial_details ) || ( true !== $enable_testimonial ) ) ? 'client-testimonial-disabled' : 'client-testimonial-enabled';

	if ( ( empty( $testimonial_details ) || ( true !== $enable_testimonial ) ) && ( empty( $item_menu_details ) || ( true !== $enable_item_menu ) ) && ( empty( $call_to_action_details ) || ( true !== $enable_call_to_action ) ) ) {
		$classes[] = 'recent-products-disabled';
	}

	// Add a class for layout
	$classes[] = esc_attr( $options['site_layout'] );

	// Add a class for sidebar
	$sidebar_position = yummy_layout();

	$selected_sidebar = get_post_meta( get_the_id(), 'yummy-selected-sidebar', true );
	$post_sidebar = ! empty( $selected_sidebar ) ? $selected_sidebar : 'sidebar-1';

	if ( is_active_sidebar( $post_sidebar ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'yummy_body_classes' );

if ( ! function_exists( 'yummy_add_search_box_to_menu' ) ) :
    /**
     * Add search box to menu
     * @param  $items,$args
   * * @return html,$items
     */

    function yummy_add_search_box_to_menu( $items, $args ) {
        
        $options = yummy_get_theme_options();
        if( $args->theme_location == 'primary' ) {        
            $search = '<div class="search" id="search">' . get_search_form(false) . '</div>';
            $html = $items . '<li><a id="search-btn" href="#"><i class="fa fa-search"></i></a></li>' . '</ul>' . $search;

            return $html;      
        }
        return $items;
    }
endif;
add_filter('wp_nav_menu_items','yummy_add_search_box_to_menu', 10, 2);