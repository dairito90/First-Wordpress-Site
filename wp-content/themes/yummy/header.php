<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package yummy
	 */

	/**
	 * yummy_doctype hook
	 *
	 * @hooked yummy_doctype -  10
	 *
	 */
	do_action( 'yummy_doctype' );
?>
<head>
<?php
	/**
	 * yummy_before_wp_head hook
	 *
	 * @hooked yummy_head -  10
	 *
	 */
	do_action( 'yummy_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>
<?php
	/**
	 * yummy_page_start_action hook
	 *
	 * @hooked yummy_page_start -  10
	 *
	 */
	do_action( 'yummy_page_start_action' ); 

	/**
	 * yummy_loader_action hook
	 *
	 * @hooked yummy_loader -  10
	 *
	 */
	do_action( 'yummy_before_header' );

	/**
	 * yummy_header_action hook
	 *
	 * @hooked yummy_header_start -  10
	 * @hooked yummy_site_branding -  20
	 * @hooked yummy_site_navigation -  30
	 * @hooked yummy_header_end -  50
	 *
	 */
	do_action( 'yummy_header_action' );

	/**
	 * yummy_content_start_action hook
	 *
	 * @hooked yummy_content_start -  10
	 *
	 */
	do_action( 'yummy_content_start_action' );

	if( is_home() || !is_front_page() ) { 
		/**
		 * yummy_banner_image_action hook
		 *
		 * @hooked yummy_banner_image_start -  10
		 */
		do_action( 'yummy_banner_image_action' );
	}
	/**
	 * yummy_primary_content_action hook
	 *
	 * @hooked yummy_add_slider_section -  10
	 * @hooked yummy_add_about_section - 20
	 * @hooked yummy_add_special_item_section - 30
	 * @hooked yummy_add_call_to_action_section - 40
	 * @hooked yummy_add_item_menu_section - 60
	 * @hooked yummy_add_testimonial_section -70
	 */
	do_action( 'yummy_primary_content_action' );
