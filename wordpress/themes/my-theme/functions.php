<?php
// Add theme support
function custom_theme_setup() {
    // Add post thumbnail support
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'custom_theme_setup');
