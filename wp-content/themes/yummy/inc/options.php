<?php
/**
 * yummy options
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

if ( ! function_exists( 'yummy_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function yummy_site_layout() {
        $yummy_site_layout = array(
            'wide'  => esc_html__( 'Wide', 'yummy' ),
            'boxed' => esc_html__( 'Boxed', 'yummy' ),
        );
        $output = apply_filters( 'yummy_site_layout', $yummy_site_layout );
        return $output;
    }
endif;

if ( ! function_exists( 'yummy_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function yummy_sidebar_position() {
        $yummy_sidebar_position = array(
            'right-sidebar' => esc_html__( 'Right', 'yummy' ),
            'no-sidebar'    => esc_html__( 'No Sidebar', 'yummy' ),
        );
        $output = apply_filters( 'yummy_sidebar_position', $yummy_sidebar_position );
        return $output;
    }
endif;

if ( ! function_exists( 'yummy_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function yummy_pagination_options() {
        $yummy_pagination_options = array(
            'numeric'  => esc_html__( 'Numeric', 'yummy' ),
            'default' => esc_html__( 'Default(Older/Newer)', 'yummy' ),
        );
        $output = apply_filters( 'yummy_pagination_options', $yummy_pagination_options );
        return $output;
    }
endif;

if( !function_exists( 'yummy_selected_sidebar' ) ) :
    /**
     * Selected sidebar
     * @return array available Sidbar
     */
    function yummy_selected_sidebar() {
      $yummy_selected_sidebar = array(
        'sidebar-1'          => esc_html__( 'Default ( Primary Sidebar )', 'yummy' ),
        'optional_sidebar_1' => esc_html__( 'Optional Sidebar 1', 'yummy' ),
      );

      $output = apply_filters( 'yummy_selected_sidebar', $yummy_selected_sidebar );

      return $output;
    }
endif;

if( !function_exists( 'yummy_header_image' ) ) :
    /**
     * Header image options
     * @return array Header image options
     */
    function yummy_header_image() {
      $yummy_header_image = array(
        'default'   => esc_html__( 'Default ( Customizer Header Image )', 'yummy' ),
        'enable'    => esc_html__( 'Enable( Featured Image )', 'yummy' ),
      );

      $output = apply_filters( 'yummy_header_image', $yummy_header_image );

      return $output;
    }
endif;

if ( ! function_exists( 'yummy_item_menu_type_options' ) ) :
    /**
     * item menu content type options
     * @return array Content type options
     */
    function yummy_item_menu_type_options() {
        $yummy_item_menu_type_options = array(
            'category'  => esc_html__( 'Category', 'yummy' ),
        );
        if ( class_exists( 'WooCommerce' ) ) {
            $yummy_item_menu_type_options = array_merge( $yummy_item_menu_type_options, array( 'woo-category' => esc_html__( 'Woo Product Category','yummy' ) ) );
        }
        $output = apply_filters( 'yummy_item_menu_type_options', $yummy_item_menu_type_options );
        return $output;
    }
endif;