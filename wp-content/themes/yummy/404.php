<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

get_header(); ?>
	<div class="wrapper page-section">
		<section class="error-404 not-found">
			<div class="page-content">
				<p><?php esc_html_e( 'The page you were looking for does not exist', 'yummy' ); ?></p>
				<?php get_search_form(); ?>
	        	<a href="<?php echo esc_url( home_url('/') ); ?>" class="more-link fill-black"><?php esc_html_e( 'GO Back','yummy' ); ?></a>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</div><!-- .wrapper/.page-section-->
<?php
get_footer();
