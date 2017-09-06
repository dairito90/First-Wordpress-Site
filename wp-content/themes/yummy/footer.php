<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

/**
 * yummy_content_end_action hook
 * @hooked yummy_content_end -  10
 *
 */
do_action( 'yummy_content_end_action' );

/**
 * yummy_footer_start hook
 *
 * @hooked yummy_footer_start -  10
 *
 */
do_action( 'yummy_footer_start' );

/**
 * yummy_footer hook
 *
 * @hooked yummy_footer_bottom_start - 11
 * @hooked yummy_footer_social_menu - 15
 * @hooked yummy_copyright -  20
 * @hooked yummy_footer_bottom_end - 25
 *
 */
do_action( 'yummy_footer' );

/**
 * yummy_footer_end hook
 *
 * @hooked yummy_footer_end -  100
 * @hooked yummy_back_to_top -  110
 *
 */
do_action( 'yummy_footer_end' );
/**
 * yummy_page_end_action hook
 *
 * @hooked yummy_page_end -  10
 *
 */
do_action( 'yummy_page_end_action' ); 
?>

<?php wp_footer(); ?>

</body>
</html>
