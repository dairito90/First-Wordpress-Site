<?php
/**
 * Customizer Partial Functions
 *
 * @package Theme Palace
 * @subpackage Yummy 
 * @since Yummy 0.3
 */

if ( ! function_exists( 'yummy_copyright_text_callback' ) ) :
	// copyright text
	function yummy_copyright_text_callback() {
		$options = yummy_get_theme_options();
		return esc_html( $options['copyright_text'] );
	}
endif;
