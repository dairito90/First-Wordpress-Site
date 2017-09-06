<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

get_header(); ?>
	<div class="wrapper page-section">
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<div class="search-results-wrapper clear">
			<?php
			if ( have_posts() ) : 
				$search_index = 1; 
				
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * @hooked yummy_search_posts -  10
					*/
					do_action( 'yummy_search_posts_action', $search_index );
					$search_index++;
				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
			</div><!-- .search-results-wrapper -->
			<?php

			/**
			* Hook - yummy_action_pagination.
			*/
			do_action( 'yummy_action_pagination' ); 
			?>

			</main><!-- #main -->
		</section><!-- #primary -->
	</div>
<?php get_footer();
