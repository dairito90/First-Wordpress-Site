<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses yummy_header_style()
 */
function yummy_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'yummy_custom_header_args', array(
		'default-image'          => get_template_directory_uri().'/assets/uploads/blog-banner.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'wp-head-callback'       => 'yummy_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'yummy_custom_header_setup' );

if ( ! function_exists( 'yummy_banner_image_start' ) ) :
	/**
	 * Banner Image
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_banner_image_start() { 
		global $wp_query, $post;
		
		$options = yummy_get_theme_options(); // get theme options 	
		// Get front page ID
		$page_on_front	  = get_option('page_on_front');
		$page_for_posts   = get_option('page_for_posts');
		// Get Page ID outside Loop
		$page_id          = $wp_query->get_queried_object_id( $post );

		if( ( ! is_home() && $page_on_front == $page_id ) || is_404() ) {
			return;
		}else {
			/**
			 * Filter the default twenty-sixteen custom header sizes attribute.
			 *
			 * @since Yummy 0.1
			 *
			 */
			$header_image_meta = yummy_header_image_meta_option(); // get header image
		?>
		<section id="banner-image" style="background-image:url( '<?php echo esc_url( $header_image_meta ); ?>' );" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
        	<div class="black-overlay"></div>

		<?php
			/*
			 * @hooked yummy_banner_image_title - 10
			*/
    		do_action( 'yummy_banner_image_title' );
			/*
			 * @hooked yummy_add_breadcrumb - 10
			*/
			do_action( 'yummy_add_breadcrumb' ); ?>
			</section><!-- #banner-image -->
		<?php
		}
	}
endif;
add_action( 'yummy_banner_image_action', 'yummy_banner_image_start', 10 );

if ( ! function_exists( 'yummy_banner_image_title' ) ) :
	/**
	 * Banner Image
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_banner_image_title() { 
		if ( is_singular() ) {
			$title = get_the_title();
		} elseif( is_404() ) {
			$title = esc_html__( '404', 'yummy' );
		} elseif( is_search() ){
			$title = sprintf( esc_html__( 'Search Result for: %s', 'yummy' ), get_search_query() );
		} elseif ( is_archive() ) {
			$title = get_the_archive_title();
		} elseif ( is_home() && is_front_page() ) {
			$title = esc_html__( 'Blogs','yummy' );
		} elseif ( is_home() ) {
			$title = get_the_title( get_option( 'page_for_posts') );
		}

		if( ! empty( $title ) ): ?>
	       	<div class="wrapper">
	  			<div class="page-title-wrapper">
	    			<h2 class="page-title">
	    				<?php 
	    				if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_tax( 'product_cat' ) ) )
	    					woocommerce_page_title();
	    				else
	    					echo wp_kses_post( $title ); 
	    				?>
	    			</h2>
	  			</div><!--.banner-title-->
			</div><!-- .wrapper -->
		<?php endif;
	}
endif;
add_action( 'yummy_banner_image_title', 'yummy_banner_image_title', 10 );

if ( ! function_exists( 'yummy_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see yummy_custom_header_setup().
	 */
	function yummy_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
				// Has the text been hidden?
			if ( ! display_header_text() ) :
				$css = ".site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}";
			// If the user has set a custom color for the text use that.
			else :
				$css = ".site-branding-text .site-title a,
				.site-description {
					color: #" . esc_attr( $header_text_color ) . "}";
			endif;

		wp_add_inline_style( 'yummy-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'yummy_header_style', 10 );
