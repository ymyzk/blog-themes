<?php

/* Inherit a parent theme stylesheet */
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/* Remove Jetpack Share */
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );

/* Remove Jetpack Related Posts */
function jetpackme_remove_rp() {
    $jprp = Jetpack_RelatedPosts::init();
    $callback = array( $jprp, 'filter_add_target_to_dom' );
    remove_filter( 'the_content', $callback, 40 );
}
add_action( 'loop_start', 'jetpackme_remove_rp' );

/* highlight.js */
add_action( 'wp_enqueue_scripts', 'append_highlight_js' );
function append_highlight_js() {
    wp_enqueue_style( 'highlight.js', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/styles/monokai.min.css' );
    wp_enqueue_script( 'highlight.js', get_stylesheet_directory_uri() . '/js/highlight.pack.js', array(), false, true );
    wp_enqueue_script( 'highlight-loader.js', get_stylesheet_directory_uri() . '/js/highlight-loader.js', array('jquery', 'highlight.js'), false, true );
}
