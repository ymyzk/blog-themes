<?php

/* Specify version number */
function specify_custom_version( $styles ) {
    $styles->default_version = 20161208;
}
add_action( 'wp_default_styles', 'specify_custom_version' );

function dequeue_twentysixteen_fonts() {
    wp_dequeue_style( 'twentysixteen-fonts' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_twentysixteen_fonts', 99 );

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
    wp_enqueue_script( 'highlight.js', get_stylesheet_directory_uri() . '/js/highlight.min.js', array(), false, true );
    wp_enqueue_script( 'highlight-loader.js', get_stylesheet_directory_uri() . '/js/highlight-loader.js', array('highlight.js'), false, true );
}
