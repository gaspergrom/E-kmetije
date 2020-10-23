<?php

$labels = [
    'name' =>               _x('Vrste dostav', 'taxonomy general name', APP_DOMAIN),
    'singular_name' =>      _x('Vrsta dostave', 'taxonomy singular name', APP_DOMAIN),
    'search_items' =>       __('Poišči vrste dostav', APP_DOMAIN),
    'all_items' =>          __('Vse vrste dostav', APP_DOMAIN),
    'parent_item' =>        __('Parent vrsta dostave', APP_DOMAIN),
    'parent_item_colon' =>  __('Parent vrsta dostave:', APP_DOMAIN),
    'edit_item' =>          __('Uredi vrsto dostave', APP_DOMAIN),
    'update_item' =>        __('Posodobi vrsto dostave', APP_DOMAIN),
    'add_new_item' =>       __('Dodaj novo vrsto dostave', APP_DOMAIN),
    'new_item_name' =>      __('Ime nove vrste dostave', APP_DOMAIN),
    'menu_name' =>          __('Vrste dostav', APP_DOMAIN),
];

return [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => false,
    'rewrite' => ['slug' => 'dostava'],
    'show_in_rest' => true,
    'capabilities'      => array(
        'manage_terms'  => 'manage_dostava',
        'edit_terms'    => 'edit_dostava',
        'delete_terms'  => 'delete_dostava',
        'assign_terms'  => 'assign_dostava'
    )
];
