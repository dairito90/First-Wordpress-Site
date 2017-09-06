<?php 
/**
 * Call to action section
 *
 * This is the template for the content of call_to_action section
 *
 * @package Yummy
 * @since Yummy 0.1
 */
if ( ! function_exists( 'yummy_add_call_to_action_section' ) ) :
    /**
    * Add Call to action section
    *
    *@since Yummy 0.1
    */
    function yummy_add_call_to_action_section() {
        // Check if call_to_action is enabled
        $enable_call_to_action = apply_filters( 'yummy_section_status', true, 'enable_call_to_action' );

        if ( true !== $enable_call_to_action ) {
            return false;
        }

        // Get call_to_action section details
        $section_details = array();
        $section_details = apply_filters( 'yummy_filter_call_to_action_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render call_to_action section now.
        yummy_render_call_to_action_section( $section_details );
    }
endif;
add_action( 'yummy_primary_content_action', 'yummy_add_call_to_action_section', 40 );


if ( ! function_exists( 'yummy_get_call_to_action_section_details' ) ) :
    /**
    * Call to action section details.
    *
    * @since Yummy 0.1
    * @param array $input call_to_action section details.
    */
    function yummy_get_call_to_action_section_details( $input ) {
        $options = yummy_get_theme_options();

        // call_to_action type
        $call_to_action_type  = $options['call_to_action_type'];

        $content = array();
        switch ( $call_to_action_type ) {

            case 'page':
                $page_id = null;
                if ( ! empty( $options['call_to_action_page'] ) ) {
                    $page_id = $options['call_to_action_page'];
                }
                
                if ( ! empty( $page_id ) ) {
                    $img_array = array();
                    if ( has_post_thumbnail( $page_id ) ) {
                        $img_array     = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
                    } else {
                        $img_array[0]  = get_template_directory_uri() . '/assets/uploads/no-featured-image-1500x1000.jpg';
                    }
                    $content[0]['title']        = get_the_title( $page_id );
                    $content[0]['url']          = get_the_permalink( $page_id );
                    $content[0]['img_array']    = $img_array[0];
                }
            break;
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// call_to_action section content details.
add_filter( 'yummy_filter_call_to_action_section_details', 'yummy_get_call_to_action_section_details' );


if ( ! function_exists( 'yummy_render_call_to_action_section' ) ) :
    /**
    * Start call_to_action section
    *
    * @return string call_to_action content
    * @since Yummy 0.1
    *
    */
    function yummy_render_call_to_action_section( $content_details = array() ) {
        $options = yummy_get_theme_options();

        if ( empty( $content_details ) ) {
          return;
        } 
        
        foreach ( $content_details as $content_detail ) : ?>
            <section id="parallax-2" class="parallax delicious-memory" style="background-image:url('<?php echo esc_url( $content_detail['img_array'] ) ?>');" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                <div class="black-overlay"></div>
                <div class="wrapper">
                    <header class="entry-header">
                        <h2 class="entry-title color-white"><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h2>
                        <a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="btn btn-transparent"><?php esc_html_e( 'View','yummy' ); ?></a>
                    </header>
                </div><!--.wrapper-->
            </section><!-- #parallax-2 -->
    <?php endforeach; 
    }
endif;