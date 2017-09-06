<?php 
/**
 * Testimonial section
 *
 * This is the template for the content of Testimonial section
 *
 * @package Yummy
 * @since Yummy 0.1
 */
if ( ! function_exists( 'yummy_add_testimonial_section' ) ) :
    /**
    * Add Testimonial section
    *
    *@since Yummy 0.1
    */
    function yummy_add_testimonial_section() {
        // Check if Testimonial is enabled
        $enable_testimonial = apply_filters( 'yummy_section_status', true, 'enable_testimonial' );

        if ( true !== $enable_testimonial ) {
            return false;
        }

        // Get Testimonial section details
        $section_details = array();
        $section_details = apply_filters( 'yummy_filter_testimonial_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Testimonial section now.
        yummy_render_testimonial_section( $section_details );
    }
endif;
add_action( 'yummy_primary_content_action', 'yummy_add_testimonial_section', 70 );


if ( ! function_exists( 'yummy_get_testimonial_section_details' ) ) :
    /**
    * Testimonial section details.
    *
    * @since Yummy 0.1
    * @param array $input Testimonial section details.
    */
    function yummy_get_testimonial_section_details( $input ) {
        $options = yummy_get_theme_options();
        // Testimonial type
        $testimonial_header_type      = $options['testimonial_header_type'];
        $testimonial_content_type     = $options['testimonial_content_type'];

        $content = array();

        // header section
        switch ( $testimonial_header_type  ) {

            case 'page' :
                $id = ( ! empty( $options['testimonial_header_page'] ) ) ? absint( $options['testimonial_header_page'] ) : '';
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
        switch ( $testimonial_content_type ) {

          	case 'post':
                $ids = array();
                
                if ( ! empty( $options['testimonial_default_posts'] ) )
                    $ids = ( array ) $options['testimonial_default_posts'];

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
                    }
                    $content['content'][$i]['title']        = get_the_title( $page_id );
                    $content['content'][$i]['url']          = get_the_permalink( $page_id );
                    $content['content'][$i]['excerpt']      = yummy_trim_content( 10, $post );
                    $content['content'][$i]['img_array']    = $img_array;
                    $content['content'][$i]['id']           = $post->ID;

                    $i++;
                endforeach;
            break;
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// Testimonial section content details.
add_filter( 'yummy_filter_testimonial_section_details', 'yummy_get_testimonial_section_details' );


if ( ! function_exists( 'yummy_render_testimonial_section' ) ) :
    /**
     * Start Testimonial section
     *
     * @return string Testimonial content
     * @since Yummy 0.1
     *
    */
    function yummy_render_testimonial_section( $content_details = array() ) {
        $options = yummy_get_theme_options();
        $testimonial_content_type     = $options['testimonial_content_type'];

        if ( empty( $content_details ) ) {
          return;
        } 

        if ( ! empty( $content_details['header'] ) ) :
            foreach ( $content_details['header'] as $content ) :?>
                <section id="parallax-3" class="parallax" style="background-image:url( '<?php echo esc_url( $content['img'] ); ?>' );" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                    <div class="black-overlay"></div>
                    <?php if ( ! empty( $content['title'] ) ) : ?>
                    <div class="wrapper">
                        <header class="entry-header">
                            <h2 class="entry-title color-white">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>">
                                        <?php echo esc_html( $content['title'] );  ?>        
                                    </a>
                            </h2>
                        </header>
                    </div><!--.wrapper-->
                    <?php endif; ?>
                </section><!-- #parallax-3 -->
            <?php endforeach;
        endif;

        if ( ! empty( $content_details['content'] ) ) :
            $index = 1; ?>
            <section id="client-testimonial" class="col-2 team-member">
                <div class="wrapper">
                    <div class="row no-margin">
                    <?php foreach ( $content_details['content'] as $content ) { ?>
                        <div class="column-wrapper">
                            <div class="team-content">
                                <div class="team-content-details">
                                    <h4 class="color-black"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h4>
                                    <?php
                                    if ( ! empty( $content['excerpt'] ) ) { ?>
                                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                    <?php } ?>
                                </div><!--.team-content-details -->
                            </div><!--.team-content-->
                            <div class="featured-image">
                                <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" width="<?php echo absint( $content['img_array'][1] ); ?>" height="<?php echo absint( $content['img_array'][2] ); ?>"></a>
                            </div><!--.featured-image-->
                        </div><!--.column-wrapper-->
                    <?php $index++; } ?>
                    </div><!--.row-->
                </div><!--.wrapper-->  
            </section><!-- #recent-products -->
        <?php endif;
    }
endif;
