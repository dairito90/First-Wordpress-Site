<?php
/**
 * WooCommerce content product
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?>>
	<div class="featured-product">
		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );

		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
		<div class="black-overlay"></div>
		<div class="hover-icons">
			<?php 
			/**
			 * yummy_add_to_cart hook.
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'yummy_add_to_cart' );
			?>
			<a href="<?php the_post_thumbnail_url( 'shop_single' ) ?>" class="popup"><i class="fa fa-eye"></i></a>
			<a href="<?php the_permalink(); ?>" class="link"><i class="fa fa-link"></i></a>
		</div><!-- .hover-icons -->
	</div><!-- .featured-product -->

	<div class="product-content">
		<?php  
		/**
		 * yummy_star_rating hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 10
		 */
		do_action( 'yummy_star_rating' );
		?>
		<h3><a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link"><?php the_title(); ?></a></h3>
		<?php $tags = get_the_terms( get_the_ID(), 'product_tag' ); 
		if ( ! empty( $tags ) ) : ?>
			<div class="product_meta">
				<span class="cat-links">
					<?php foreach ( $tags as $tag ) : ?>
						<a href="<?php echo esc_url( get_term_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
					<?php endforeach; ?>
				</span>
			</div><!-- .product_meta -->
		<?php endif; ?>
		<?php  
		/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
	</div><!-- .product-content -->
</li><!-- .product -->