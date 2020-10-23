<?php

add_filter('login_headerurl', function () {
    return home_url();
});


add_filter('login_headertext', function () {
    return 'E-kmetije';
});

//add_action( 'login_enqueue_scripts', function() {
//    wp_enqueue_script( 'custom-login-script', get_template_directory_uri() . '/_custom/scripts/login.js', array( 'jquery' ) );
//    wp_enqueue_style( 'wonderfont', get_stylesheet_directory_uri() . '/dist/fonts/wonder/style.css');
//    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/_custom/styles/login.css');
//});
//
//add_action( 'login_head', function() {
//    add_filter( 'gettext', function( $translated_text, $text, $domain ) {
//        if ( 'Username or Email Address' === $text || 'Username' === $text || 'Password' === $text ) {
//            $translated_text = "";
//        }
//        return $translated_text;
//    }, 20, 3 );
//} );
//
//?>
