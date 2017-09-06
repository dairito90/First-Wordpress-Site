<?php
/**
 * WooCommerce Hooks
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

/**
 * Make theme WooCommerce ready
 */

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );
add_action( 'yummy_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'yummy_star_rating', 'woocommerce_template_loop_rating', 10 );


// Change number or products per row to 3
add_filter('loop_shop_columns', 'yummy_loop_columns');
if ( ! function_exists('yummy_loop_columns')) {
	/**
	 * Shop Page no. of column
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_loop_columns() {
		return 3; // 3 products per row
	}
}

add_action('woocommerce_before_shop_loop', 'yummy_before_product_start', 10);
if ( ! function_exists('yummy_before_product_start')) {
	/**
	 * Shop Page product start
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_before_product_start() {
		echo '<section id="shop-products" class="page-section">
        	<div class="wrapper">';
	}
}

add_action('woocommerce_after_main_content', 'yummy_before_product_end', 10);
if ( ! function_exists('yummy_before_product_end')) {
	/**
	 * Shop Page product end
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_before_product_end() {
		echo '</div><!-- end .wrapper -->
        	</section><!-- end #shop-product -->';
	}
}


add_filter( 'woocommerce_show_page_title', 'yummy_remove_page_title' );
if ( ! function_exists('yummy_remove_page_title')) {
	/**
	 * Shop Page product start
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_remove_page_title() {
		return false;
	}
}

add_filter( 'woocommerce_product_add_to_cart_text', 'yummy_add_to_cart_btn' );
if ( ! function_exists('yummy_add_to_cart_btn')) {
	/**
	 * add to cart button
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_add_to_cart_btn() {
		return '';
	}
}

add_action( 'woocommerce_before_shop_loop', 'yummy_product_category_list', 11 );
if ( ! function_exists('yummy_product_category_list')) {
	/**
	 * product category lists
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_product_category_list() {
		$terms = get_terms( array(
		    'taxonomy' 	 => 'product_cat',
		    'hide_empty' => false,
		    'childless'	 => true,
		) ); 
		$product_category = get_query_var( 'term' );
		$shop_page = get_option( 'woocommerce_shop_page_id' ); 
		$shop_page = ! empty( $shop_page ) ? $shop_page : '#';
		?>
		<ul class="shop-tab clear">
            <li class="<?php echo ( $product_category == '' ) ? 'active' : ''; ?>"><a href="<?php the_permalink( $shop_page ); ?>"><?php esc_html_e( 'All', 'yummy' ); ?></a></li>
            <?php foreach ( $terms as $term ) : ?>
            	<li class="<?php echo ( $product_category == $term->slug ) ? 'active' : ''; ?>" ><a href="<?php echo esc_url( get_term_link( $term->term_id ), 'product_cat' ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
            <?php endforeach; ?>
      	</ul><!-- .nav-tabs -->
  	<?php
	}
}

add_action( 'woocommerce_before_single_product', 'yummy_single_product_start', 5 );
if ( ! function_exists('yummy_single_product_start') ) {
	/**
	 * add to cart button
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_single_product_start() {
		echo '<div class="wrapper page-section">
		<section id="product-detail" class="col-2">';
	}
}

add_action( 'woocommerce_after_single_product', 'yummy_single_product_end', 20 );
if ( ! function_exists('yummy_single_product_end') ) {
	/**
	 * add to cart button
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_single_product_end() {
		echo '</section>
		</div>';
	}
}

add_action( 'woocommerce_before_single_product_summary', 'yummy_single_product_img_start', 5 );
if ( ! function_exists('yummy_single_product_img_start') ) {
	/**
	 * add to cart button
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_single_product_img_start() { 
		$shop_page = get_option( 'woocommerce_shop_page_id' ); 
		$shop_page = ! empty( $shop_page ) ? $shop_page : '#';
		?>
		<div class="shop-cart clear">
			<div class="half-gray"></div>

			<div class="entry-container">
				<div class="column-wrapper">
					<div class="product-thumbnail">
						<h4 class="return-to-shop"><a href="<?php the_permalink( $shop_page ); ?>"><i class="fa fa-reply"></i><?php esc_html_e( 'Return to shop', 'yummy' ); ?></a></h4>
		<?php
	}
}

add_action( 'woocommerce_before_single_product_summary', 'yummy_single_product_img_end', 30 );
if ( ! function_exists('yummy_single_product_img_end') ) {
	/**
	 * add to cart button
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_single_product_img_end() { ?>
			</div><!--.product-thumbnail-->
      	</div><!--.column-wrapper-->
      	<div class="column-wrapper">
	<?php
	}
}

add_action( 'woocommerce_after_single_product_summary', 'yummy_single_produt_summary_end', 5 );
if ( ! function_exists('yummy_single_produt_summary_end') ) {
	/**
	 * add to cart button
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_single_produt_summary_end() { ?>
      		</div><!--.column-wrapper-->
      		</div><!-- .entry-container -->
      	</div><!--.shop-cart -->
	<?php
	}
}

add_action( 'woocommerce_single_product_summary', 'yummy_title_seperator', 5 );
if ( ! function_exists('yummy_title_seperator') ) {
	/**
	 * Seperator after title
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_title_seperator() { ?>
      	<div class="separator"></div>
	<?php
	}
}

add_filter( 'woocommerce_output_related_products_args', 'yummy_related_products_limit' );
if ( ! function_exists('yummy_related_products_limit') ) {
	/**
	 * No. of related products
	 *
	 * @since Yummy 0.1
	 *
	 */
	function yummy_related_products_limit( $args ) { 
		global $product;
	
		$args['posts_per_page'] = 3;
		return $args;
	}
}
