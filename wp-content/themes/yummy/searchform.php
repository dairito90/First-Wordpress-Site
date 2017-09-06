<?php
/**
 * The template for displaying search form
 *
 * @package Theme Palace
 * @subpackage Yummy 
 * @since Yummy 0.1
 */

$options = yummy_get_theme_options();
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
    <label>
        <span class="screen-reader-text"></span>
        <input type="search" name="s" class="search-field" placeholder="<?php esc_attr_e( 'Search..','yummy' ); ?>" value="<?php echo get_search_query(); ?>" />
    </label>
    <button type="submit" class="search-submit"><i class="fa fa-search"></i><span class="screen-reader-text"></span></button>
    <span class="close-search"><img src="<?php echo get_template_directory_uri() . '/assets/uploads/close-icon.png'; ?>" alt="<?php esc_attr_e( 'Close Search','yummy' ); ?>"></span>
</form><!-- .search-form -->