<?php 
/**
 * Special Item section
 *
 * This is the template for the content of Special Item section
 *
 * @package Yummy
 * @since Yummy 0.3
 */
if ( ! function_exists( 'yummy_add_special_item_section' ) ) :
    /**
    * Add Special Item section
    *
    *@since Yummy 0.3
    */
    function yummy_add_special_item_section() {
        // Check if Special Item is enabled
        $enable_special_item = apply_filters( 'yummy_section_status', true, 'enable_special_item' );

        if ( true !== $enable_special_item ) {
            return false;
        }

        // Get Special Item section details
        $section_details = array();
        $section_details = apply_filters( 'yummy_filter_special_item_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Special Item section now.
        yummy_render_special_item_section( $section_details );
    }
endif;
add_action( 'yummy_primary_content_action', 'yummy_add_special_item_section', 30 );


if ( ! function_exists( 'yummy_get_special_item_section_details' ) ) :
    /**
    * Special Item section details.
    *
    * @since Yummy 0.3
    * @param array $input Special Item section details.
    */
    function yummy_get_special_item_section_details( $input ) {
        $options = yummy_get_theme_options();

        // Special Item type
        $special_item_header_type      = $options['special_item_header_type'];
        $special_item_content_type     = $options['special_item_content_type'];

        $content = array();

        // header section
        switch ( $special_item_header_type  ) {

            case 'page' :
                $id = ( ! empty( $options['special_item_header_page'] ) ) ? absint( $options['special_item_header_page'] ) : '';

                $args = array( 
                    'post_type' => 'page',
                    'page_id'   => $id,
                 );

                $posts = get_posts( $args );
                foreach ( $posts as $post ) {
                    $img_array = null;
                    if ( has_post_thumbnail( $post->ID ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                    } else {
                        $img_array[0] =  get_template_directory_uri() . '/assets/uploads/no-featured-image-1500x1000.jpg';
                    }

                    $content['header'][1]['title'] = get_the_title( $post->ID );
                    $content['header'][1]['url']   = get_the_permalink( $post->ID );
                    $content['header'][1]['img']   = $img_array[0];
                }
            break;            
        }


        // content section 
        switch ( $special_item_content_type ) {   

          	case 'post':
                $ids = array();
                
                if ( ! empty( $options['special_item_content_post'] ) )
                    $ids = ( array ) $options['special_item_content_post'];

                // Bail if no valid pages are selected.
                if ( empty( $ids ) ) {
                    return $input;
                }

                $args = array(
                    'no_found_rows'  => true,
                    'orderby'        => 'post__in',
                    'post_type'      => 'post',
                    'post__in'       => $ids,
                    'posts_per_page' => 4,
                );                  
            break;
        }

        if ( ! empty( $args ) ) {
            $posts = get_posts( $args );
            $i = 1;
            foreach ( $posts as $post ) :
                $page_id = $post->ID;
                $img_array = null;
                if ( has_post_thumbnail( $page_id ) ) {
                    $img_array          = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'post-thumbnail' );
                    $img_array_lg       = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
                } else {
                    $img_array[0]       = get_template_directory_uri() . '/assets/uploads/no-featured-image-300x300.jpg';
                    $img_array[1]       = 300;
                    $img_array[2]       = 300;
                    $img_array_lg[0]    = '';
                }
                $content['content'][$i]['id']           = $page_id;
                $content['content'][$i]['title']        = get_the_title( $page_id );
                $content['content'][$i]['url']          = get_the_permalink( $page_id );
                $content['content'][$i]['excerpt']      = yummy_trim_content( 15, $post );
                $content['content'][$i]['img_array']    = $img_array;
                $content['content'][$i]['img_array_lg'] = $img_array_lg;
                $i++;
            endforeach;
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// Special Item section content details.
add_filter( 'yummy_filter_special_item_section_details', 'yummy_get_special_item_section_details' );


if ( ! function_exists( 'yummy_render_special_item_section' ) ) :
    /**
    * Start Special Item section
    *
    * @return string Special Item content
    * @since Yummy 0.3
    *
    */
    function yummy_render_special_item_section( $content_details = array() ) {
        $options = yummy_get_theme_options();
        $special_item_content_type     = $options['special_item_content_type'];

        if ( empty( $content_details ) ) {
          return;
        } 

        if ( ! empty( $content_details['header'] ) ) :
            foreach ( $content_details['header'] as $content_detail ) :?>
                <section id="parallax-1" class="parallax" style="background-image:url('<?php echo esc_url( $content_detail['img'] ); ?>');" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                    <div class="black-overlay"></div>
                    <div class="wrapper">
                        <?php if ( ! empty( $content_detail['title'] ) ) : ?>
                            <header class="entry-header">
                                <h2 class="entry-title color-white">
                                    <a href="<?php echo esc_url( $content_detail['url'] ); ?>">
                                        <?php echo esc_html( $content_detail['title'] );  ?>        
                                    </a>
                                </h2>
                            </header>
                        <?php endif; ?>
                    </div><!--.wrapper-->
                </section><!-- #parallax-1 -->
            <?php endforeach; 
        endif; 

        if ( ! empty( $content_details['content'] ) ) : ?>
            <section id="recent-products" class="col-2">
                <div class="wrapper">
                    <ul class="products gallery-popup col-2 clear">
                        <?php foreach ( $content_details['content'] as $content_detail ) : ?>
                            <li class="product">
                                <div class="product-description">
                                    <h3><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h3>
                                    <p><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                                </div><!-- .product-description -->

                                <div class="featured-product-image">
                                    <div class="hover-icons">
                                        <?php if ( ! empty( $content_detail['img_array_lg'][0] ) ) : ?>
                                            <a href="<?php echo esc_url( $content_detail['img_array_lg'][0] ); ?>" class="popup"><i class="fa fa-eye"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="link"><i class="fa fa-link"></i></a>
                                    </div><!-- .hover-icons -->
                                    <a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="woocommerce-LoopProduct-link">
                                        <div class="black-overlay"></div>
                                        <img src="<?php echo esc_url( $content_detail['img_array'][0] ) ?>" width="<?php echo esc_attr( $content_detail['img_array'][1] ); ?>" height="<?php echo esc_attr( $content_detail['img_array'][2] ); ?>" alt="<?php echo esc_attr( $content_detail['title'] ); ?>"> 
                                    </a>
                                </div><!-- .featured-product-image -->
                            </li><!-- .product -->
                        <?php endforeach; ?>
                    </ul><!-- .products -->
                </div><!--.wrapper-->  
            </section><!-- #recent-products -->
        <?php endif;
    }
endif;