<?php
// Load styles and scripts
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/assets/css/custom.css', [], time());
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', ['jquery'], time(), true);
});
