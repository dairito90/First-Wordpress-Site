<?php 
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

if ( ! function_exists( 'yummy_blog_posts' ) ) :
	/**
	 * content hook
	 *
	 * @since Yummy 0.1
	 */
	function yummy_blog_posts( $index ) { 
		global $post;
		$options = yummy_get_theme_options();
		$addclass = ( $index % 6 === 3 ) ? 'move-up' : '';
		$blog_author_id    = get_the_author_meta( 'ID' );						
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( $addclass ); ?>>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>">
				<?php yummy_get_home_thumbnail_image( $index ); ?></a>
			</div><!--.featured-image-->
			<div class="entry-summary">
				<div class="post-content">
					<?php if( ! $options['hide_blog_date'] ) { ?>
						<time><?php echo date_i18n( get_option('date_format'), strtotime ( get_the_date( '', $post ) ) ); ?></time>
					<?php } ?>
					<header class="entry-header">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</header>
					<?php if( ! $options['hide_author_avatar'] ) { ?>
						<p class="entry-meta">
							<span><?php echo get_avatar( $blog_author_id, 100 ); ?></span>
						</p>
					<?php }
					if( ! empty( $options['read_more_text'] ) ) { ?>
						<a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html( $options['read_more_text'] ); ?></a>
					<?php } ?>
				</div>
			</div><!--.entry-summary-->
		</article><!--.hentry has-post-thumbnail-->
	<?php }
endif;
add_action( 'yummy_blog_posts_action','yummy_blog_posts' );