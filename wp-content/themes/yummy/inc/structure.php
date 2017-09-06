<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

$options = yummy_get_theme_options();


if ( ! function_exists( 'yummy_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Yummy 0.1
	 */
	function yummy_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'yummy_doctype', 'yummy_doctype', 10 );


if ( ! function_exists( 'yummy_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'yummy_before_wp_head', 'yummy_head', 10 );

if ( ! function_exists( 'yummy_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'yummy' ); ?></a>

		<?php
	}
endif;

add_action( 'yummy_page_start_action', 'yummy_page_start', 10 );

if ( ! function_exists( 'yummy_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'yummy_page_end_action', 'yummy_page_end', 10 );

if ( ! function_exists( 'yummy_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_header_start() {
		?>
		<header id="masthead" class="site-header sticky" role="banner">
			<div class="wrapper">
		<?php
	}
endif;
add_action( 'yummy_header_action', 'yummy_header_start', 10 );

if ( ! function_exists( 'yummy_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_site_branding() {
		$options = yummy_get_theme_options();
		$sitetitle = get_bloginfo( 'name' );
		$sitedescription = get_bloginfo( 'description', 'display' );
		if( has_custom_logo() || display_header_text() ) : ?>
			<div class="site-branding">
	            <?php if ( has_custom_logo() && true === $options['site_logo_enable'] ) : ?>
					<div class="site-logo">
			        	<?php the_custom_logo(); ?>
	          		</div><!-- end .site-logo -->
			    <?php endif;
			    if( display_header_text() && ( true === $options['site_title_enable'] || true === $options['site_description_enable'] ) ) { ?>
		          	<div class="site-branding-text">
						<?php if ( true === $options['site_title_enable'] ) :
							if ( is_front_page() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
							endif;
						endif;
						if ( true === $options['site_description_enable'] ) :
							if ( $sitedescription || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo esc_html( $sitedescription ); /* WPCS: xss ok. */ ?></p>
							<?php
							endif;
						endif; ?>
					</div>
				<?php } ?>
			</div><!-- .site-branding -->
		<?php
		endif;
	}
endif;
add_action( 'yummy_header_action', 'yummy_site_branding', 20 );

if ( ! function_exists( 'yummy_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_site_navigation() { ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle">
				<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            </button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false ) ); ?>
		</nav><!-- #site-navigation -->
	<?php
	}
endif;
add_action( 'yummy_header_action', 'yummy_site_navigation', 30 );


if ( ! function_exists( 'yummy_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_header_end() {
		?>
			</div><!--.wrapper-->
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'yummy_header_action', 'yummy_header_end', 50 );

if ( ! function_exists( 'yummy_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'yummy_content_start_action', 'yummy_content_start', 10 );

if ( ! function_exists( 'yummy_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'yummy_content_end_action', 'yummy_content_end', 10 );

if ( ! function_exists( 'yummy_footer_start' ) ) :
	/**
	 * End div id #content
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_footer_start() {	?>
		<footer id="colophon" class="site-footer col-1" role="contentinfo">
		<?php
	}
endif;
add_action( 'yummy_footer_start', 'yummy_footer_start', 10 );

if ( ! function_exists( 'yummy_footer_bottom_start' ) ) :
	/**
	 * start div class .bottom-footer
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_footer_bottom_start() { ?>
		<div class="bottom-footer page-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/uploads/site-info.jpg');">
        	<div class="wrapper">
	<?php }
endif;
add_action( 'yummy_footer', 'yummy_footer_bottom_start', 11 );

if ( ! function_exists( 'yummy_footer_social_menu' ) ) :
	/**
	 * social link
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_footer_social_menu() { 
		if ( has_nav_menu( 'social' ) ) : ?> 
			<div class="social-link">
	            <?php wp_nav_menu( array( 'theme_location' => 'social', 'container' => 'ul', 'menu_class' => 'social-icons' ) ); ?>
	        </div><!--.social-link-->
		<?php endif;
	}
endif;
add_action( 'yummy_footer', 'yummy_footer_social_menu', 15 );

if ( ! function_exists( 'yummy_copyright' ) ) :
	/**
	 * End div class .site-info
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_copyright() { 
		$options = yummy_get_theme_options();

		$search = array( '[the-year]', '[site-link]' );

        $replace = array(  date( esc_html_x( 'Y', 'yearly archives date format',  'yummy' ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text 	= $options['copyright_text'];
		
		if ( ! empty( $copyright_text ) ) :  ?>
	    <div class="site-info">
	    	<span class="copyright"><?php echo wp_kses_post( $copyright_text ); ?></span>
	    	<span><?php printf( esc_html__( '%1$s by %2$s', 'yummy' ), 'Yummy', '<a href="' . esc_url( 'http://www.themepalace.com/' ) . '" rel="designer" target="_blank">Theme Palace</a>' ); ?></span>
	    </div><!-- end .site-info -->  	
	<?php
		endif;
	}
endif;
add_action( 'yummy_footer', 'yummy_copyright', 20 );

if ( ! function_exists( 'yummy_footer_bottom_end' ) ) :
	/**
	 * end div class .bottom-footer
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_footer_bottom_end() { ?>
			</div><!--.wrapper-->
    	</div><!-- .bottom-footer -->
	<?php }
endif;
add_action( 'yummy_footer', 'yummy_footer_bottom_end', 25 );

if ( ! function_exists( 'yummy_footer_end' ) ) :
	/**
	 * End footer id #colophon
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_footer_end() {
		?>
        </footer><!-- end .site-footer -->
		<?php
	}
endif;
add_action( 'yummy_footer_end', 'yummy_footer_end', 100 );

if ( ! function_exists( 'yummy_back_to_top' ) ) :
	/**
	 * Back to top class .backtotop
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_back_to_top() {
		$options = yummy_get_theme_options();
		if ( $options['scroll_top_visible'] ) : ?>
        	<div class="backtotop"><i class="fa fa-angle-up"></i></div><!--end .backtotop-->
		<?php endif;
	}
endif;
add_action( 'yummy_footer_end', 'yummy_back_to_top', 110 );

if ( ! function_exists( 'yummy_loader' ) ) :
	/**
	 * Start div id #loader
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_loader() {
		$options = yummy_get_theme_options();
		if ( $options['loader_enable'] ) { ?>
			<div id="loader">
	         <div class="loader-container">
         		<i class="fa fa-spinner fa-spin"></i>
	         </div>
	     	</div><!-- end loader -->
		<?php }
	}
endif;
add_action( 'yummy_before_header', 'yummy_loader', 10 );


if ( ! function_exists( 'yummy_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since Yummy 0.1
	 */
	function yummy_add_breadcrumb() {
		$options = yummy_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		// Bail if Home Page.
		if ( is_front_page() && ! is_home() ) {
			return;
		}

		echo '<div class="container">';
				/**
				 * yummy_simple_breadcrumb hook
				 *
				 * @hooked yummy_simple_breadcrumb -  10
				 *
				 */
				do_action( 'yummy_simple_breadcrumb' );
		echo '<div class="icon-scroll"></div>
        </div><!--.container--> ';
		return;
	}

endif;
add_action( 'yummy_add_breadcrumb', 'yummy_add_breadcrumb' , 10 );