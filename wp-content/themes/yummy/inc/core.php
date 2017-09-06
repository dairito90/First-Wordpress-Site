<?php
/**
 * Core file.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';

// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';


/**
 * Merge values from default options array and values from customizer
 *
 * @return array Values returned from customizer
 * @since Yummy 0.1
 */
function yummy_get_theme_options() {
  $yummy_default_options = yummy_get_default_theme_options();

  return array_merge( $yummy_default_options , get_theme_mod( 'yummy_theme_options', $yummy_default_options ) ) ;
}


/**
  * Write message for featured image upload
  *
  * @return array Values returned from customizer
  * @since Yummy 0.1
*/
function yummy_slider_image_instruction( $content, $post_id ) {
  $allowed = array( 'page' );
  if ( in_array( get_post_type( $post_id ), $allowed ) ) {
      return $content .= '<p><b>' . esc_html__( 'Note', 'yummy' ) . ':</b>' . esc_html__( ' The recommended size for image is 1350px by 760px while using it for slider', 'yummy' ) . '</p>';
  }
  return $content;
}
add_filter( 'admin_post_thumbnail_html', 'yummy_slider_image_instruction', 10, 2);

/**
 * Add breadcrumb functions.
 */
require get_template_directory() . '/inc/breadcrumb-class.php';

/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add structural hooks.
 */
require get_template_directory() . '/inc/structure.php';

/**
 * Add metabox
 */
require get_template_directory() . '/inc/metabox/metabox.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Section additions.
 */
require get_template_directory() . '/inc/modules/modules.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgm-hook.php';

/**
* WooCommerce Hook.
*/
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Add content functions.
 */
require get_template_directory() . '/template-parts/content.php';

/**
 * Add content-search functions.
 */
require get_template_directory() . '/template-parts/content-search.php';

