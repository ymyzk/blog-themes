<?php

/* Specify version number */
function specify_custom_version( $styles ) {
    $styles->default_version = 20171117;
}
add_action( 'wp_default_styles', 'specify_custom_version' );

/* Disable Web Fonts in twentysixteen theme */
function dequeue_twentysixteen_fonts() {
    wp_dequeue_style( 'twentysixteen-fonts' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_twentysixteen_fonts', 99 );

/* Allow users to upload svg image files via media uploader */
function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_upload' );

/* Remove Jetpack Share */
/* https://jetpack.com/2013/06/10/moving-sharing-icons/ */
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

/* main.js = highlight.js + highlight-loader.js + sharing.js */
function append_custom_js() {
    wp_enqueue_script( 'main.js', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'append_custom_js' );
