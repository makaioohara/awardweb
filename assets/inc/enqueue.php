<?php

function keenness_css_js_file_calling() {
    wp_register_style('main-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ), 'all');
    wp_register_style('extra-style', get_template_directory_uri().'/extra.css', array('main-style'), filemtime( get_template_directory() . '/extra.css' ), 'all');
    
    wp_register_style('360-custom-style', get_template_directory_uri().'/css/360/custom.css', array('extra-style'), filemtime( get_template_directory() . '/css/360/custom.css' ), 'screen and (min-width: 360px)');
    
    wp_register_style('600-custom-style', get_template_directory_uri().'/css/600/custom.css', array('extra-style'), filemtime( get_template_directory() . '/css/600/custom.css' ), 'screen and (min-width: 600px)');
    
    wp_register_style('750-custom-style', get_template_directory_uri().'/css/750/custom.css', array('extra-style'), filemtime( get_template_directory() . '/css/750/custom.css' ), 'screen and (min-width: 750px)'); 
    
    wp_register_style('1024-custom-style', get_template_directory_uri().'/css/1024/custom.css', array('extra-style'), filemtime( get_template_directory() . '/css/1024/custom.css' ), 'screen and (min-width: 1024px)');
    
    wp_register_script('main-js', get_template_directory_uri().'/js/main.js', array(), filemtime( get_template_directory() . '/js/main.js' ), true);
    
    // Enqueue
    wp_enqueue_style('main-style');
    wp_enqueue_style('extra-style');
    wp_enqueue_style('320-custom-style');
    wp_enqueue_style('360-custom-style');
    wp_enqueue_style('600-custom-style');
    wp_enqueue_style('750-custom-style');
    wp_enqueue_style('1024-custom-style');
    wp_enqueue_script('main-js');
}
add_action('wp_enqueue_scripts', 'keenness_css_js_file_calling');
