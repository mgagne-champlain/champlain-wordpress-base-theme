<?php
add_action( 'wp_enqueue_scripts', function(){
    $css_version = md5(filemtime( get_template_directory() . '/src/css/main.css' ));
    wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/src/css/main.css', [], $css_version );
});