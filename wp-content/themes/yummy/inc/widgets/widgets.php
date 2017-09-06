<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of Theme Palace
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yummy_extra_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'About Section Widget Area', 'yummy' ),
		'id'            => 'about_section_widget_area',
		'description'   => esc_html__( 'This widget area supports Image from Text Widget For About Section in Front-page.', 'yummy' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="entry-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'yummy_extra_widgets_init' );

/*
 * Add Latest Posts widget
 */
require get_template_directory() . '/inc/widgets/latest-posts.php';