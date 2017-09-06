<?php
/**
 * yummy custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Yummy
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

if( ! function_exists( 'yummy_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Yummy 0.1
	 */
  	function yummy_check_enable_status( $input, $content_enable ){
		$options = yummy_get_theme_options();
		// Content status.
		$content_status = $options[ $content_enable ];

		// Get Page ID outside Loop.
		$query_obj = get_queried_object();
		$page_id   = null;
	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		// Front page displays in Reading Settings.
		$page_on_front  = get_option( 'page_on_front' );

		if ( ( ! is_home() && is_front_page() ) && $content_status ) {
			$input = true;
		}
		else {
			$input = false;
		}
		return ( $input );
  	}
endif;
add_filter( 'yummy_section_status', 'yummy_check_enable_status', 10, 2 );


if ( ! function_exists( 'yummy_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since Yummy 0.1
	 */
	function yummy_is_sidebar_enable() {
		$options               = yummy_get_theme_options();
		$sidebar_position      = $options['sidebar_position'];

		if ( is_search() ) {
			$post_sidebar_position = '';
		} else {
			$post_id = get_the_id();
			$post_sidebar_position = get_post_meta( $post_id, 'yummy-sidebar-position', true );
		}

		if ( ( $sidebar_position == 'no-sidebar' && $post_sidebar_position == "" ) || $post_sidebar_position == 'no-sidebar' ) {
			return false;
		} else {
			return true;
		}

	}
endif;


if ( ! function_exists( 'yummy_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function yummy_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = yummy_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'yummy_filter_frontpage_content_enable', 'yummy_is_frontpage_content_enable' );


add_action( 'yummy_simple_breadcrumb', 'yummy_simple_breadcrumb' , 10 );
if ( ! function_exists( 'yummy_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 *
	 * @param  array $args Arguments
	 */
	function yummy_simple_breadcrumb( $args = array() ) {

		/**
		 * Add breadcrumb.
		 *
		 */
		$options = yummy_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}

		$args = array(
			'show_on_front'   => false,
			'show_title'      => true,
			'show_browse'     => false,
		);
		breadcrumb_trail( $args );      

		return;
	}

endif;


add_action( 'yummy_action_pagination', 'yummy_pagination', 10 );
if ( ! function_exists( 'yummy_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since Yummy 0.1
	 */
	function yummy_pagination() {
		$options = yummy_get_theme_options();
		if ( true == $options['pagination_enable'] ) {
			$pagination = $options['pagination_type'];
			if ( $pagination == 'default' ) :
				the_posts_navigation();
			elseif ( $pagination == 'numeric' ) :
				the_posts_pagination( array(
				    'mid_size' => 4,
				    'prev_text' => esc_html__( 'Previous Posts', 'yummy' ),
				    'next_text' => esc_html__( 'Next Posts', 'yummy' ),
				) );
			else :
				the_posts_pagination();
			endif;
		}
	}

endif;

if ( ! function_exists( 'yummy_custom_excerpt' ) ) :
	/**
	 * create the custom excerpts callback
	 *
	 * @since Yummy 0.1
	 * @return  custom excerpts callback
	 */
	function yummy_custom_excerpt( $length_callback = '', $more_callback = '' ){
		$post_id = get_queried_object_id();
		if ( function_exists( $length_callback ) ){
			add_filter( 'excerpt_length', $length_callback );
		}
		$output = get_the_excerpt( $post_id );
		$output = apply_filters( 'wptexturize', $output );
		$output = apply_filters( 'convert_chars', $output );
		$output = $output;
		echo esc_html( $output );
	}
endif;


if ( ! function_exists( 'yummy_excerpt_more' ) ) :
	// read more
	function yummy_excerpt_more( $more ){
		return '...';
	}
endif;
add_filter( 'excerpt_more', 'yummy_excerpt_more' );


if ( ! function_exists( 'yummy_trim_content' ) ) :
	/**
	 * custom excerpt function
	 * 
	 * @since Yummy 0.1
	 * @return  no of words to display
	 */
	function yummy_trim_content( $length = 40, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );

	   return apply_filters( 'yummy_trim_content', $trimmed_content );
	}
endif;


if ( ! function_exists( 'yummy_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since Yummy 0.1
	 */
	function yummy_custom_content_width() {

		global $content_width;
		$sidebar_position = yummy_layout();
		switch ( $sidebar_position ) {

		  case 'no-sidebar':
		    $content_width = 1170;
		    break;

		  case 'right-sidebar':
		    $content_width = 819;
		    break;

		  default:
		    break;
		}
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$content_width = 1170;
		}

	}
endif;
add_action( 'template_redirect', 'yummy_custom_content_width' );


if ( ! function_exists( 'yummy_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since Yummy 0.1
	 *
	 * @return string Theme Palace layout value
	 */
	function yummy_layout() {
		$options = yummy_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position = apply_filters( 'yummy_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular()  ) {
			
			$post_sidebar_position = get_post_meta( get_the_ID(), 'yummy-sidebar-position', true );
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}
		if ( is_archive() || is_home() || is_search() ) {
			$sidebar_position = 'no-sidebar';
		}
		return $sidebar_position;
	}
endif;

if ( ! function_exists( 'yummy_header_image_meta_option' ) ) :
	/**
	 * Check header image option meta
	 *
	 * @since Yummy 0.1
	 *
	 * @return string Header image meta option
	 */
	function yummy_header_image_meta_option() {
		if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() ) ) :
			$post_id = get_option( 'woocommerce_shop_page_id' ); 
			if( has_post_thumbnail( $post_id ) ) {
				return get_the_post_thumbnail_url( $post_id, 'yummy-header-image' );
			} elseif ( get_header_image() ){
				return esc_url( get_header_image() );
			} else {
				return get_template_directory_uri().'/assets/uploads/blog-banner.jpg';
			}  
		elseif ( is_archive() || is_search() || is_404() ) :
			if( get_header_image() ){
				return esc_url( get_header_image() );
			} else {
				return get_template_directory_uri().'/assets/uploads/blog-banner.jpg';
			}
		else :
			global $post;

			if ( is_object( $post ) ) :
				$post_id = $post->ID;
				$header_image_meta = get_post_meta( $post_id, 'yummy-header-image', true );

				if ( 'enable' == $header_image_meta ) {
					if( has_post_thumbnail( $post_id ) ) {
						return get_the_post_thumbnail_url( $post_id, 'yummy-header-image' );
					} elseif ( get_header_image() ){
						return esc_url( get_header_image() );
					} else {
						return get_template_directory_uri().'/assets/uploads/blog-banner.jpg';
					}
				} elseif ( 'default' == $header_image_meta ) {
					if( get_header_image() ){
						return esc_url( get_header_image() );
					} elseif ( has_post_thumbnail( $post_id ) ) {
						return get_the_post_thumbnail_url( $post_id, 'yummy-header-image' );
					} else {
						return get_template_directory_uri().'/assets/uploads/blog-banner.jpg';
					}
				} else {
					if( get_header_image() ){
						return esc_url( get_header_image() );
					} else {
						return get_template_directory_uri().'/assets/uploads/blog-banner.jpg';
					}
				}
			else :
				if( get_header_image() ){
					return esc_url( get_header_image() );
				} else {
					return get_template_directory_uri().'/assets/uploads/blog-banner.jpg';
				}
			endif;
		endif;
	}
endif;

if ( ! function_exists( 'yummy_get_thumbnail_image' ) ) :
	/**
	 * display post or page thumbnail image
	 *
	 * @since Yummy 0.1
	 *
	 * @return string value
	 */
	function yummy_get_thumbnail_image() {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( is_singular() ) {
			global $post;
			$post_id = $post->ID;

			$header_image_meta = get_post_meta( $post_id, 'yummy-header-image', true );

			if( 'enable' == $header_image_meta ) {
				return; // retun if thumbnail image is used as a header image.
			}
			if( has_post_thumbnail() ) {
				echo '<div class="post-thumbnail">';
				the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); 
				echo '</div>';
			}
		} 
		elseif ( is_archive() || is_search() ) {
			if( has_post_thumbnail() ){
				echo '<div class="post-thumbnail">';
				the_post_thumbnail( 'post-thumbnail',  array( 'alt' => the_title_attribute( 'echo=0' ) ) );
				echo '</div>';
			}else {
				echo '<div class="post-thumbnail">';
				echo '<img  src="'. esc_url( get_template_directory_uri() .'/assets/uploads/no-featured-image-300x300.jpg') .'" alt="'. esc_attr( get_the_title() ) .'">';
				echo '</div>';
			}
		}
		else {
			echo '<div class="post-thumbnail">';
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) );
			echo '</div>';
		} 
	}
endif;

if( !function_exists( 'yummy_get_author_profile' ) ) :
	/*
	 * Function to get author profile
	 */           
	function yummy_get_author_profile(){
		$author_id          = get_the_author_meta( 'ID' );
		$author_description = get_the_author_meta( 'description');
	    ?>
	    <article id="about-author">
	    	<div class="entry-content">
                <div class="about-author">
					<div class="author-image">
						<?php echo get_avatar( $author_id, 100 );  ?>
					</div><!-- .author-image -->
				<div class="author-content">
					<div class="author-name clear">
				    	<span><?php esc_html_e( 'Author:','yummy' ); ?></span><h6><?php the_author_posts_link(); ?></h6>
				  	</div>
					<?php if( !empty( $author_description ) ) : ?>
						<p><?php echo esc_html( $author_description ); ?></p>
					<?php endif; ?>
				</div><!-- .author-content -->
			</div><!-- .entry-content -->
	    </article><!-- #about-author -->
	    <?php
	}
endif;
add_action( 'yummy_author_profile', 'yummy_get_author_profile' );

if ( ! function_exists( 'yummy_get_home_thumbnail_image' ) ) :
	/**
	 * display post or page thumbnail image
	 *
	 * @since Yummy 0.1
	 *
	 * @return string value
	 */
	function yummy_get_home_thumbnail_image( $index ) {

		if ( post_password_required() || is_attachment() ) {
			return;
		}
		elseif ( is_home() || is_archive() ) {
			if( has_post_thumbnail() ){
				if( 2 === $index || 4 === $index ) {
					the_post_thumbnail( 'post-thumbnail',  array( 'width' => 600, 'height' => 600, 'alt' => the_title_attribute( 'echo=0' ) ) );
				}
				else {
					if( 6 === $index ) {
						$index == 0;
					}
					the_post_thumbnail( 'post-thumbnail',  array( 'width' => 300, 'height' => 300, 'alt' => the_title_attribute( 'echo=0' ) ) );
				}
			}
			else {
				if( 2 === $index || 4 === $index ) {

				echo '<img  src="'. esc_url( get_template_directory_uri() .'/assets/uploads/no-featured-image-600x600.jpg') .'" alt="'. esc_attr( get_the_title() ) .'">';
				}
				else {
					if( 6 === $index ) {
						$index == 0;
					}
					echo '<img  src="'. esc_url( get_template_directory_uri() .'/assets/uploads/no-featured-image-300x300.jpg') .'" alt="'. esc_attr( get_the_title() ) .'">';
				}
			}
		}
		else {
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) );
		} 
	}
endif;

