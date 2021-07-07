<?php

add_action('wp_enqueue_scripts', static function () {
    $deps = [];

    if (class_exists(\Elementor\Plugin::class)) {
        $deps[] = 'elementor-frontend';
    }

    wp_enqueue_style('vehica', get_template_directory_uri() . '/style.css', $deps, VEHICA_VERSION);
    wp_enqueue_style('vehica-child', get_stylesheet_directory_uri() . '/style.css', ['vehica']);
});

function my_custom_scripts() {
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/custom.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );


add_action('after_setup_theme', static function () {
    load_child_theme_textdomain('vehica', get_stylesheet_directory() . '/languages');
});
