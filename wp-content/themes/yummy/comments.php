<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

// You can start editing here -- including this comment!
if ( have_comments() ) : ?>

	<div id="comments" class="comments-area page-section no-padding-bottom">

			<h2 class="comments-title entry-title">
				<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
						/* translators: %s: post title */
						esc_html_x( 'One comment', 'comments title', 'yummy' );
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: number of comments, 2: post title */
						esc_html( _nx(
							'%1$s comment',
							'%1$s comments',
							$comments_number,
							'comments title',
							'yummy'
						) ),
						number_format_i18n( $comments_number )
					);
				}
				?>
			</h2>
			<div class="separator"></div>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'yummy' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'yummy' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'yummy' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
			<?php endif; // Check for comment navigation. ?>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
						'avatar_size'=> 65,
					) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'yummy' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'yummy' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'yummy' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php
			endif; // Check for comment navigation.

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'yummy' ); ?></p>
		<?php
		endif;

		?>
	</div><!-- #comments -->
<?php endif; // Check for have_comments().

/*
 * Removes default comment form 
 *
 * @since Yummy 0.1
 */

function yummy_remove_default_comment_form( $fields ) {

    unset( $fields['comment'] );
    $fields['comment'] = '<p class="comment-form-comment clear">
                <textarea name="comment" placeholder="' . esc_attr__( 'Your Message *','yummy' ) . '" id="comment"></textarea>
              </p>';
    
    return $fields;
}
add_filter( 'comment_form_fields', 'yummy_remove_default_comment_form' );

if ( ! function_exists( 'yummy_alter_comment_form_fields' ) ) {
	/**
	* Alter the comment form fields
	* @param  array Array of fields to be customized
	* @return array Array of customized fields
	*/
	function yummy_alter_comment_form_fields( $fields ) {
		$fields['author'] = '<p class="comment-form-author">
            <input id="author" name="author" type="text" value="" placeholder="'.esc_attr__( 'Full Name *', 'yummy' ) .'" size="30" maxlength="245" aria-required="true" required="required">
          </p>';
		$fields['email'] 	= '<p class="comment-form-email">
	        <input id="email" name="email" type="email" value="" placeholder="'.esc_attr__( 'Email *', 'yummy' ) .'" size="30" maxlength="100" aria-describedby="email-notes" aria-required="true" required="required">
	      </p>';
	    unset( $fields['url'] );
		return $fields;
	}
	add_filter('comment_form_default_fields','yummy_alter_comment_form_fields');
}

$args = array(
	'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title entry-title">',
	'title_reply_after' => '</h2>',
	);
comment_form( $args );