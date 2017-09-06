<?php 
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Yummy
 * @since Yummy 0.1
 */
if ( ! function_exists( 'yummy_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since Yummy 0.1
    */
    function yummy_add_slider_section() {
        // Check if slider is enabled
        $enable_slider = apply_filters( 'yummy_section_status', true, 'enable_slider' );

        if ( true !== $enable_slider ) {
            return false;
        }
        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'yummy_filter_slider_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render slider section now.
        yummy_render_slider_section( $section_details );
    }
endif;
add_action( 'yummy_primary_content_action', 'yummy_add_slider_section', 10 );


if ( ! function_exists( 'yummy_get_slider_section_details' ) ) :
    /**
    * Slider section details.
    *
    * @since Yummy 0.1
    * @param array $input Slider section details.
    */
    function yummy_get_slider_section_details( $input ) {
        $options = yummy_get_theme_options();

        // Slider type
        $slider_content_type  = $options['slider_content_type'];

        $content = array();
        switch ( $slider_content_type ) {        

          	case 'page':
                $ids = array();
                for ( $i = 1; $i <= 3; $i++ ) {
                    $id = null;
                    if ( isset( $options[ 'slider_page_'.$i ] ) ) {
                        $id = $options[ 'slider_page_'.$i ];
                    }
                    if ( ! empty( $id ) ) {
                        $ids[] = absint( $id );
                    }
                }
                // Bail if no valid pages are selected.
                if ( empty( $ids ) ) {
                    return $input;
                }

                $args = array(
                    'no_found_rows'  => true,
                    'orderby'        => 'post__in',
                    'post_type'      => 'page',
                    'post__in'       => $ids,
                );

                // Fetch posts.
                $posts = get_posts( $args );

                if ( ! empty( $posts ) ) {

                    $i = 1;
                    foreach ( $posts as $key => $post ) {
                        $page_id = $post->ID;
                        $img_array = null;
                        if ( has_post_thumbnail( $page_id ) ) {
                            $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                        } 
                        else {
                            $img_array[0] =  get_template_directory_uri() . '/assets/uploads/no-featured-image-1500x1000.jpg';
                        }

                        if ( isset( $img_array ) ) {
                            $content[$i]['img_array'] = $img_array[0];
                        }
                        $content[ $i ]['url']         = get_permalink( $page_id );
                        $content[ $i ]['title']       = get_the_title( $page_id ); 
                        $i++;
                    }
                }
            break;

          	default:
          	break;
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// Slider section content details.
add_filter( 'yummy_filter_slider_section_details', 'yummy_get_slider_section_details' );


if ( ! function_exists( 'yummy_render_slider_section' ) ) :
    /**
    * Start slider section
    *
    * @return string Slider content
    * @since Yummy 0.1
    *
    */
    function yummy_render_slider_section( $content_details = array() ) {
        $options                 = yummy_get_theme_options();
        $enable_infinite_sliding = ( $options['enable_infinite_sliding'] ) ? 'true' : 'false';
        $enable_slider_arrows    = ( $options['enable_slider_arrows'] ) ? 'true' : 'false';

        if ( empty( $content_details ) ) {
          return;
        }
        ?>
        <section id="main-slider" class="align-center main-featured-slider" 
        data-slick='{ 
        "slidesToShow": 1, "slidesToScroll": 1, 
        "infinite": <?php echo esc_attr( $enable_infinite_sliding );?>, 
        "speed": 800, 
        "dots": false, 
        "arrows": <?php echo esc_attr( $enable_slider_arrows ); ?>, 
        "autoplay": true, 
        "fade": true, 
        "draggable": false  }'>
            <?php foreach( $content_details as $content ){ ?>
            <div class="slider-item" style="background-image:url( '<?php echo esc_url( $content['img_array'] ); ?>' );">
                <div class="main-slider-contents wrapper">
                    <h2><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                </div><!-- .main-slider-contents -->
            </div><!-- .slider-item -->
            <?php } ?>
        </section><!-- #main-slider --> 
    <?php }
endif;