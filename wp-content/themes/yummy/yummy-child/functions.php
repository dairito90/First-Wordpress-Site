<?php
add_action('wp_enqueue_scripts','enqueue_parents_styles');

function enqueue_parents_styles() {
    wp_enqueue_style('parent-styles', get_template_directory_uri().'/style.css');
}
