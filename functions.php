<?php

add_action( 'wp_enqueue_scripts', 'olc_twentyseventeen_theme_enqueue_styles' );

function olc_twentyseventeen_theme_enqueue_styles() {

    $theme = wp_get_theme();
    
    wp_enqueue_style( 'twentyseventeen-style', get_template_directory_uri() . '/style.css', 
        array(),
        $theme->parent()->get('Version')
    );
    
    wp_enqueue_style( 'olc-twentyseventeen-style', get_stylesheet_uri(),
        array( 'twentyseventeen-style' ),
        $theme->get('Version')
    );
}
