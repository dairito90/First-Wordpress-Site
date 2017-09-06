<?php 
/**
 * About section
 *
 * This is the template for the content of about section
 *
 * @package Yummy
 * @since Yummy 0.1
 */
if ( ! function_exists( 'yummy_add_about_section' ) ) :
    /**
    * Add about section
    *
    *@since Yummy 0.1
    */
    function yummy_add_about_section() {
        // Check if about is enabled
        $enable_about = apply_filters( 'yummy_section_status', true, 'enable_about' );

        if ( true !== $enable_about ) {
            return false;
        }
        // Get about section details
        $section_details = array();
        $section_details = apply_filters( 'yummy_filter_about_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render about section now.
        yummy_render_about_section( $section_details );
    }
endif;
add_action( 'yummy_primary_content_action', 'yummy_add_about_section', 20 );


if ( ! function_exists( 'yummy_get_about_section_details' ) ) :
    /**
    * about section details.
    *
    * @since Yummy 0.1
    * @param array $input about section details.
    */
    function yummy_get_about_section_details( $input ) {
        $options = yummy_get_theme_options();

        // about type
        $about_content_type  = $options['about_content_type'];

        $content = array();
        switch ( $about_content_type ) {

          	case 'page':
                $post_id = null;
                if ( isset( $options[ 'about_page' ] ) ) {
                    $post_id = $options[ 'about_page' ];
                }                    
                
                if ( ! empty( $post_id ) ) {
                    $content['title']       = get_the_title( $post_id );
                    $content['excerpt']     = yummy_trim_content( 100, get_post( $post_id ) );
                }
            break;
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// about section content details.
add_filter( 'yummy_filter_about_section_details', 'yummy_get_about_section_details' );


if ( ! function_exists( 'yummy_render_about_section' ) ) :
    /**
    * Start about section
    *
    * @return string about content
    * @since Yummy 0.1
    *
    */
    function yummy_render_about_section( $content_details = array() ) {
        $options = yummy_get_theme_options();

        if ( empty( $content_details ) ) {
          return;
        }
        
        if( ( $options['about_content_type'] == 'page' ) && is_active_sidebar( 'about_section_widget_area' ) ) {
            $addcolumn = 2;
        }
        else {
            $addcolumn = 1;
        }
        ?>
        <section id="reservation-information" class="col-<?php echo $addcolumn; ?>">
            <div class="wrapper">
                <?php if( is_active_sidebar( 'about_section_widget_area' ) ) { ?>
                    <div class="column-wrapper">
                        <?php dynamic_sidebar( 'about_section_widget_area' ); ?> 
                    </div><!--.column-wrapper-->                
                <?php } ?>

                <div class="column-wrapper">
                    <div class="page-section">
                        <header class="entry-header">
                            <h2 class="entry-title"><?php echo esc_html( $content_details['title'] ); ?></h2>
                        </header><!--.entry-header-->
                        <?php if( ! empty( $content_details['excerpt'] ) ) { ?>
                            <div class="entry-content">
                                <p><?php echo esc_html( $content_details['excerpt'] ); ?></p>
                            </div><!--.entry-content-->
                        <?php } ?>
                    </div><!-- .page-section -->
                </div><!--.column-wrapper-->
            </div><!--.wrapper-->
        </section><!--#reservation-form--> 
    <?php }
endif;