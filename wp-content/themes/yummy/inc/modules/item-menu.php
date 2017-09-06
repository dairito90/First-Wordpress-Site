<?php 
/**
 * Item menu section
 *
 * This is the template for the content of Item menu section
 *
 * @package Yummy
 * @since Yummy 0.1
 */
if ( ! function_exists( 'yummy_add_item_menu_section' ) ) :
    /**
    * Add Item menu section
    *
    *@since Yummy 0.1
    */
    function yummy_add_item_menu_section() {
        // Check if Item menu is enabled
        $enable_item_menu = apply_filters( 'yummy_section_status', true, 'enable_item_menu' );

        if ( true !== $enable_item_menu ) {
            return false;
        }

        // Get Item menu section details
        $section_details = array();
        $section_details = apply_filters( 'yummy_filter_item_menu_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Item menu section now.
        yummy_render_item_menu_section( $section_details );
    }
endif;
add_action( 'yummy_primary_content_action', 'yummy_add_item_menu_section', 60 );


if ( ! function_exists( 'yummy_get_item_menu_section_details' ) ) :
    /**
    * Item menu section details.
    *
    * @since Yummy 0.1
    * @param array $input Item menu section details.
    */
    function yummy_get_item_menu_section_details( $input ) {
        $options = yummy_get_theme_options();

        // Item menu type
        $item_menu_content_type  = $options['item_menu_type'];

        $content = array();
        switch ( $item_menu_content_type ) {        

          	case 'category':

                $cat_id = array();

                for ( $i = 1; $i <= 2; $i++ ) {
                    if ( ! empty( $options['item_menu_category_' . $i ] ) )
                        $cat_id[$i] = $options['item_menu_category_' . $i ];
                }

                // Bail if no valid pages are selected.
                if ( empty( $cat_id ) ) {
                    return $input;
                }

                $args = array();
                foreach ( $cat_id as $id ) {
                    if ( ! empty( $id ) ) :
                        $args[] = array(
                          'no_found_rows'  => true,
                          'cat'            => $id,
                          'post_type'      => 'post',
                          'posts_per_page' => 4,
                        );  
                        $term = get_the_category_by_ID( $id );
                        $content[]['cat_title'] = ! empty( $term ) ? $term : '';  
                    endif; 
                }

            break;

            case 'woo-category':

                $cat_id = array();

                for ( $i = 1; $i <= 2; $i++ ) {
                    if ( ! empty( $options['item_menu_woo_category_' . $i ] ) )
                        $cat_id[$i] = $options['item_menu_woo_category_' . $i ];
                }

                // Bail if no valid pages are selected.
                if ( empty( $cat_id ) ) {
                    return $input;
                }

                $args = array();
                foreach ( $cat_id as $id ) {
                    if ( ! empty( $id ) ) :
                        $args[] = array(
                            'post_type'         => 'product',
                            'posts_per_page'    => 4,
                            'tax_query'         => array(
                                array(
                                    'taxonomy'  => 'product_cat',
                                    'field'     => 'id',
                                    'terms'     => $id,
                        ) ) );  
                        $term = get_term( $id, $taxonomy = 'product_cat' );
                        $content[]['cat_title'] = ! empty( $term ) ? $term->name : '';
                    endif; 
                }

            break;
        }
        
        // Fetch posts.
        if ( ! empty( $args ) ) {
            $count = 0;
            foreach ( $args as $query_args ) {
                $posts = get_posts( $query_args );
                $i = 1;
                foreach ( $posts as $post ) :
                    $page_id = $post->ID;
                    if ( 'woo-category' == $item_menu_content_type ) {
                        $product = new WC_Product( $page_id );
                        $content[$count]['val'][$i]['price']  = $product->get_price_html();
                    } else {
                        $content[$count]['val'][$i]['price']  = '';
                    }
                    $content[$count]['val'][$i]['title']      = get_the_title( $page_id );
                    $content[$count]['val'][$i]['url']        = get_the_permalink( $page_id );
                    $content[$count]['val'][$i]['excerpt']    = yummy_trim_content( 11, $post );
                    $i++;
                endforeach;
                $count++;
            }
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// Item menu section content details.
add_filter( 'yummy_filter_item_menu_section_details', 'yummy_get_item_menu_section_details' );


if ( ! function_exists( 'yummy_render_item_menu_section' ) ) :
    /**
    * Start Item menu section
    *
    * @return string Item menu content
    * @since Yummy 0.1
    *
    */
    function yummy_render_item_menu_section( $content_details = array() ) {
        $options        = yummy_get_theme_options();
        $header_title   = ! empty( $options['item_menu_title'] ) ? $options['item_menu_title'] : '';

        if ( empty( $content_details ) ) {
          return;
        } 
        ?>
        <section id="food-menu" class="page-section bg-white">
            <div class="wrapper">
                <?php if ( ! empty( $header_title ) ) : ?>
                    <header class="entry-header">
                        <h2 class="entry-title"><?php echo esc_html( $header_title ); ?></h2>
                        <div class="separator"></div>
                    </header><!-- .entry-header -->
                <?php endif; ?>
                <div class="entry-content">
                    <?php foreach ( $content_details as $content_detail ) : ?>
                        <div class="food-item-list clear">
                            <div class="item-title">
                                <h4><?php echo esc_html( $content_detail['cat_title'] ); ?></h4>
                            </div><!-- .item-title -->
                            <div class="list-items">
                                <div class="food-item-list-wrapper">
                                    <?php foreach ( $content_detail['val'] as $content_detail ) : ?>
                                        <div class="menu-list">
                                            <h5><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h5>
                                            <p><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                                            <?php if ( ! empty( $content_detail['price'] ) ) : ?>
                                                <?php echo wp_kses_post( $content_detail['price'] ); ?>
                                            <?php endif; ?>
                                        </div><!--.menu-list-->
                                    <?php endforeach; ?>
                                </div><!-- .food-item-list-wrapper -->
                            </div><!-- .list-items -->
                        </div><!-- .food-item-list -->
                    <?php endforeach; ?>
                </div><!-- .entry-content -->
            </div><!-- .wrapper -->

            <div class="page-decoration">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/dish-01.png" alt="<?php echo esc_attr__( 'decoration', 'yummy' ) ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/dish-02.png" alt="<?php echo esc_attr__( 'decoration', 'yummy' ) ?>">
            </div><!-- .page-decoration -->
        </section><!-- #food-menu -->
    <?php }
endif;