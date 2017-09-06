<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

if ( ! function_exists( 'yummy_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function yummy_posted_on() {
		$options = yummy_get_theme_options();
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		if ( 'post' === get_post_type() ) {
			$date_url = get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
		} 
					
		$time_value = '<a href="' . esc_url( $date_url ) . '" rel="bookmark">' . $time_string . '</a>';

		if( ! $options['hide_date'] ) {
			echo '<span> ' . $time_value . '</span>'; // WPCS: XSS OK.
		}
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'yummy' ) );
			if ( $categories_list && yummy_categorized_blog() && ( ! $options['hide_category'] ) ) {
				printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'yummy' ) );
			if ( $tags_list && ( ! $options['hide_tags'] ) ) {
				printf( '<span class="tags-links">%1$s</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
		if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'No comments<span class="screen-reader-text"> on %s</span>', 'yummy' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ), wp_kses( __( '1<i class="fa fa-comments"></i>','yummy' ), array( 'i' => array( 'class' => array() ) ) ), wp_kses( __( '%<i class="fa fa-comments"></i>','yummy' ), array( 'i' => array( 'class' => array() ) ) ), 'comments-number' );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'yummy_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function yummy_entry_footer() {		

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'yummy' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function yummy_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'yummy_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'yummy_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so yummy_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so yummy_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in yummy_categorized_blog.
 */
function yummy_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'yummy_categories' );
}
add_action( 'edit_category', 'yummy_category_transient_flusher' );
add_action( 'save_post',     'yummy_category_transient_flusher' );
