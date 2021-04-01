<?php

namespace App;

/*
* register ACF options pages
*/
if (function_exists("acf_add_options_page")) {
    if(current_user_can('administrator')){
        acf_add_options_page(array('page_title' => 'Globals', 'slug' => 'globals_parent'));
        acf_add_options_sub_page(array('page_title' => 'Globals', 'slug' => 'globals', 'parent_slug' => 'globals_parent'));
        acf_add_options_sub_page(array('page_title' => 'Header', 'slug' => 'header', 'parent_slug' => 'globals_parent'));
        acf_add_options_sub_page(array('page_title' => 'Footer', 'slug' => 'footer', 'parent_slug' => 'globals_parent'));
        acf_add_options_sub_page(array('page_title' => 'Code', 'slug' => 'code', 'parent_slug' => 'globals_parent'));
    }

}


add_filter( 'manage_ponudniki_posts_columns', function ( $columns ) {
    return array_merge ( $columns, array (
        'izdelki' => __( 'Izdelki' ),
    ) );
}, 'ponudniki');

add_filter( 'manage_turisticni-ponudniki_posts_columns', function ( $columns ) {
    return array_merge ( $columns, array (
        'nastanitve' => __( 'Nastanitve' ),
    ) );
}, 'turisticni-ponudniki');

add_filter( 'manage_izdelki_posts_columns', function ( $columns ) {
    return array_merge ( $columns, array (
        'ponudnik' => __( 'Ponudnik' ),
    ) );
}, 'izdelki');


add_filter( 'manage_nastanitve_posts_columns', function ( $columns ) {
    return array_merge ( $columns, array (
        'ponudnik' => __( 'Ponudnik' ),
    ) );
}, 'nastanitve');

add_action ( 'manage_izdelki_posts_custom_column', function ( $column, $post_id ) {
    switch ( $column ) {

        case 'ponudnik':
            $ponudnik = get_field('ponudnik', $post_id);
            if($ponudnik){
                echo "<a href='" . get_edit_post_link($ponudnik) ."'>" . get_the_title($ponudnik) . "</a>";
            }
            else{
                echo '-';
            }
            break;

    }
}, 10, 2 );

add_action ( 'manage_nastanitve_posts_custom_column', function ( $column, $post_id ) {
    switch ( $column ) {

        case 'ponudnik':
            $ponudnik = get_field('ponudnik', $post_id);
            if($ponudnik){
                echo "<a href='" . get_edit_post_link($ponudnik) ."'>" . get_the_title($ponudnik) . "</a>";
            }
            else{
                echo '-';
            }
            break;

    }
}, 10, 2 );

add_action ( 'manage_ponudniki_posts_custom_column', function ( $column, $post_id ) {
    switch ( $column ) {

        case 'izdelki':
            $izdelki = get_posts(array(
                'posts_per_page'	=> -1,
                'post_type'			=> 'izdelki',
                'meta_key'		=> 'ponudnik',
                'meta_value'	=> $post_id
            ));
            if(count($izdelki) > 0){
                echo implode(", ", array_map(function($izdelek){
                    return "<a href='". get_edit_post_link($izdelek->ID) . "'>". $izdelek->post_title . "</a>";
                }, $izdelki));
            }
            else{
                echo "-";
            }
            break;

    }
}, 10, 2 );

add_action ( 'manage_turisticni-ponudniki_posts_custom_column', function ( $column, $post_id ) {
    switch ( $column ) {

        case 'nastanitve':
            $nastanitve = get_posts(array(
                'posts_per_page'	=> -1,
                'post_type'			=> 'nastanitve',
                'meta_key'		=> 'ponudnik',
                'meta_value'	=> $post_id
            ));
            if(count($nastanitve) > 0){
                echo implode(", ", array_map(function($nastanitev){
                    return "<a href='". get_edit_post_link($nastanitev->ID) . "'>". $nastanitev->post_title . "</a>";
                }, $nastanitve));
            }
            else{
                echo "-";
            }
            break;

    }
}, 10, 2 );


add_filter('acf/fields/google_map/api', function( $api ){
    $api['key'] = get_field('google_maps', 'options');
    return $api;
});

