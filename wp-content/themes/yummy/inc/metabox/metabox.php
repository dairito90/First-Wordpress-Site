<?php

/**
 * Yummy metabox file.
 *
 * This is the template that includes all the other files for metaboxes of Yummy theme
 *
 * @package Theme Palace
 * @subpackage Yummy
 * @since Yummy 0.1
 */ 

/**
 * Class to Renders and save metabox options
 *
 * @since Yummy 0.1
 */
class Yummy_MetaBox {
    private $meta_box;

    private $fields;

    /**
    * Constructor
    *
    * @since Yummy 0.1
    *
    * @access public
    *
    */
    public function __construct( $meta_box_id, $meta_box_title, $post_type ) {
        
        $this->meta_box = array (
                            'id'        => $meta_box_id,
                            'title'     => $meta_box_title,
                            'post_type' => $post_type,
                            );

        $this->fields = array(
                            'yummy-sidebar-position',
                            'yummy-selected-sidebar',
                            'yummy-header-image',
                            );


        // Add metaboxes
        add_action( 'add_meta_boxes', array( $this, 'add' ) );
        
        add_action( 'save_post', array( $this, 'save' ) );  
    }

    /**
    * Add Meta Box for multiple post types.
    *
    * @since Yummy 0.1
    *
    * @access public
    */
    public function add($postType) {
        if( in_array( $postType, $this->meta_box['post_type'] ) ) {
            add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $postType );
        }
    }

    /**
    * Renders metabox
    *
    * @since Yummy 0.1
    *
    * @access public
    */
    public function show() {
        global $post;

        $layout_options         = yummy_sidebar_position();
        $sidebar_options        = yummy_selected_sidebar();
        $header_image_options   = yummy_header_image();
        
        
        // Use nonce for verification  
        wp_nonce_field( basename( __FILE__ ), 'yummy_custom_meta_box_nonce' );

        // Begin the field table and loop  ?>  
        <div id="yummy-ui-tabs" class="ui-tabs">
            <ul class="yummy-ui-tabs-nav" id="yummy-ui-tabs-nav">
                <li><a href="#frag1"><?php esc_html_e( 'Layout Options', 'yummy' ); ?></a></li>
                <li><a href="#frag3"><?php esc_html_e( 'Header Image Options', 'yummy' ); ?></a></li>
                <li><a href="#frag2"><?php esc_html_e( 'Select Sidebar', 'yummy' ); ?></a></li>
            </ul> 
            <div id="frag1" class="catch_ad_tabhead">
                <table id="layout-options" class="form-table" width="100%">
                    <tbody>
                        <tr>
                            <select name="yummy-sidebar-position" id="custom_element_grid_class">
                                <option value=""><?php esc_html_e( 'Default ( to customizer option )', 'yummy' ); ?></option>
                                <?php  
                                    $metalayout = get_post_meta( $post->ID, 'yummy-sidebar-position', true );
                                    if( empty( $metalayout ) ){
                                        $metalayout='';
                                    }
                                    foreach ( $layout_options as $field => $value ) {  
                                ?>
                                    <option value="<?php echo esc_attr( $field ); ?>" <?php selected( $metalayout, $field ); ?>><?php echo esc_html( $value ); ?></option>
                                <?php
                                } // end foreach 
                                ?>
                            </select>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="frag2" class="catch_ad_tabhead">
                <table id="sidebar-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>
                            <?php
                            $metasidebar = get_post_meta( $post->ID, 'yummy-selected-sidebar', true );
                            if ( empty( $metasidebar ) ){
                                $metasidebar='sidebar-1';
                            } 
                            foreach ( $sidebar_options as $field => $value ) {  
                            ?>
                                <td style="vertical-align: top;">
                                    <label class="description">
                                        <input type="radio" name="yummy-selected-sidebar" value="<?php echo esc_attr( $field ); ?>" <?php checked( $field, $metasidebar ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $value ); ?>
                                    </label>
                                </td>
                                
                            <?php
                            } // end foreach 
                            ?>
                        </tr>
                    </tbody>
                </table>        
            </div>

            <div id="frag3" class="catch_ad_tabhead">
                <table id="header-image-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>                
                            <?php  
                            $metaheader = get_post_meta( $post->ID, 'yummy-header-image', true );
                            if ( empty( $metaheader ) ){
                                $metaheader='default';
                            }
                            foreach ( $header_image_options as $field => $value ) { 
                            ?>
                                <td style="width: 100px;">
                                    <label class="description">
                                        <input type="radio" name="yummy-header-image" value="<?php echo esc_attr( $field ); ?>" <?php checked( $field, $metaheader ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $value ); ?>
                                    </label>
                                </td>
                                
                            <?php
                            } // end foreach 
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php 
    }

    /**
     * Save custom metabox data
     * 
     * @action save_post
     *
     * @since Yummy 0.1
     *
     * @access public
     */
    public function save( $post_id ) { 
    
        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'yummy_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'yummy_nonce' ] ), basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
            return;
        }
      
        foreach ( $this->fields as $field ) {      
            // Checks for input and sanitizes/saves if needed
            if( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
            }
        } // end foreach         
    }
}

$yummy_metabox = new Yummy_MetaBox( 
                                    'yummy-options',                  //metabox id
                                    esc_html__( 'Yummy Meta Options', 'yummy' ), //metabox title
                                    array( 'page', 'post' )             //metabox post types
                                    );

/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_enqueue_script, and  wp_enqueue_style
 *
 * @since yummy 1.0
 */
function yummy_enqueue_metabox_scripts( $hook ) {
    if( $hook == 'post.php' || $hook == 'post-new.php'  ){
        $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        //Scripts
        wp_enqueue_script( 'yummy-metabox', get_template_directory_uri() . '/assets/js/metabox' .$min. '.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );
        //CSS Styles
        wp_enqueue_style( 'yummy-metabox-tabs', get_template_directory_uri() . '/assets/css/metabox-tabs' .$min. '.css' );
    }
    return;
}
add_action( 'admin_enqueue_scripts', 'yummy_enqueue_metabox_scripts', 11 );