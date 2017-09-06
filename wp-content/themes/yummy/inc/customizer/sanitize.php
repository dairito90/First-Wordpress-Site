<?php
/**
 * Customizer sanitization functions
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

if ( ! function_exists( 'yummy_sanitize_select' ) ) :
	/**
	 * Sanitize select, radio.
	 *
	 * @since Yummy 0.1
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function yummy_sanitize_select( $input, $setting ) {
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
endif;

if ( ! function_exists( 'yummy_sanitize_page' ) ) :
	/**
	* Sanitizes page/post
	* @param  $input entered value
	* @return sanitized output
	*
	* @since Yummy 0.1
	*/
	function yummy_sanitize_page( $input ) {

	  // Ensure $input is an absolute integer.
	  $page_id = absint( $input );

	  // Retrieve all page ids
	  $page_ids = get_all_page_ids();

	  if ( in_array( $page_id, $page_ids ) ) {
	     // If $page_id is an ID of a published page, return it; otherwise, return false
	     return ( 'publish' == get_post_status( $page_id ) ? $page_id : false );
	  }
	}
endif;

if ( ! function_exists( 'yummy_sanitize_checkbox' ) ) :
	/**
	 * Sanitize checkbox.
	 *
	 * @since Yummy 0.1
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function yummy_sanitize_checkbox( $checked ) {

		return ( ( isset( $checked ) && true == $checked ) ? true : false );

	}
endif;

if( !function_exists( 'yummy_sanitize_single_category' ) ) :
	/**
	 * Sanitizes dropdown single category
	 * @param  $input entered value
	 * @return sanitized output
	 *
	 * @since Yummy 0.1
	 */
	function yummy_sanitize_single_category( $input ) {
		if ( $input != '' ) {
			$args = array(
							'type'			=> 'post',
							'child_of'      => 0,
							'parent'        => '',
							'orderby'       => 'name',
							'order'         => 'ASC',
							'hide_empty'    => 0,
							'hierarchical'  => 0,
							'taxonomy'      => 'category',
						);

			$categories = get_categories( $args );

			foreach ( $categories as $category )
				$category_ids[] 	= $category->term_id;

			if ( in_array( $input, $category_ids ) ) {
		    	return $input;
		    }
		    else {
	    		return '';
	   		}
	    }
	    else {
	    	return '';
	    }
	}
endif;

if ( ! function_exists( 'yummy_sanitize_post_ids' ) ) :
	/**
	* Sanitizes post ids
	* @param  $input entered value
	* @return sanitized output
	*
	* @since Yummy 0.1
	*/
	function yummy_sanitize_post_ids( $input ) {

		$ids = explode( ',', $input );

		// Ensure $input is an absolute integer.
		$posts_ids = array_map( 'absint', $ids );

		$output = array();

		foreach ( $posts_ids as $post_id ) {
			if ( 'publish' == get_post_status( $post_id ) )
				$output[] = $post_id;
		}

		return $output;
	}
endif;


