<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */
if ( ! function_exists( 'yummy_search_posts' ) ) :
	/**
	 * content hook
	 *
	 * @since Yummy 0.1
	 */
	function yummy_search_posts( $search_index ) { 
		global $post;
		$blog_author_id    = get_the_author_meta( 'ID' );
		$options = yummy_get_theme_options();
		if( $search_index % 4 === 0 || $search_index % 4 === 3 ) {
			$addclass = 'align-right';
		} 
		else {
			$addclass = '';
		}
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( $addclass ); ?>>
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
				</div><!-- .post-content -->
			</div><!--.entry-summary-->
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>">
				<?php if( has_post_thumbnail() ) {
					the_post_thumbnail( 'post-thumbnail',  array( 'alt' => the_title_attribute( 'echo=0' ) ) );
				}
				else {
					echo '<img  src="'. esc_url( get_template_directory_uri() .'/assets/uploads/no-featured-image-300x300.jpg') .'" alt="'. esc_attr( get_the_title() ) .'">';
				} ?></a>
			</div><!--.featured-image-->
		</article><!-- #post-## -->
	<?php }
endif;
add_action( 'yummy_search_posts_action','yummy_search_posts' );