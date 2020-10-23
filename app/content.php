<?php

namespace App;


/**
 * change content on save
 */
//add_filter('the_content', function ($content) {
//    $content = preg_replace('/(<img.+)(src)/Ui', '$1data-$2', $content);
//    $content = preg_replace('/(<img.+)(srcset)/Ui', '$1data-$2', $content);
//    return $content;
//});
//add_filter('widget_text', function ($content) {
//    $content = preg_replace('/(<img.+)(src)/Ui', '$1data-$2', $content);
//    $content = preg_replace('/(<img.+)(srcset)/Ui', '$1data-$2', $content);
//    return $content;
//});
//add_filter('wp_get_attachment_image_attributes', function ($atts, $attachment) {
//    $atts['data-src'] = $atts['src'];
//    unset($atts['src']);
//
//    if (isset($atts['srcset'])) {
//        $atts['data-srcset'] = $atts['srcset'];
//        unset($atts['srcset']);
//    }
//
//    return $atts;
//}, 10, 2);


/**
 * add custom shortcodes
 */


/* Sample shortcode: [button url="/" target="_blank"]]Learn more ›[[/button] */
/*
add_shortcode('button', function ( $atts, $content = null ) {
    //set default attributes and values
    $values = shortcode_atts( array(
        'url'   	=> '#',
        'target'	=> '_self',
    ), $atts );
    return '<a href="'. esc_attr($values['url']) .'"  target="'. esc_attr($values['target']) .'" class="btn btn-green">'. $content .'</a>';
});
*/
