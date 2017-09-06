<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

get_header(); 
$options = yummy_get_theme_options();?>
	<div class="wrapper page-section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single' );

				the_post_navigation();
				
				if( ! $options['hide_author'] ) :
					/**
					* Hook yummy_author_profile
					*  
					* @hooked yummy_get_author_profile 
					*/
					do_action( 'yummy_author_profile' );
				endif;

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
		if ( yummy_is_sidebar_enable() ) {
			get_sidebar();
		} ?>
	</div><!-- .wrapper/.page-section-->
<?php get_footer();
