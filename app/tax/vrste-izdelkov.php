<?php

$labels = [
    'name' =>               _x('Vrste izdelkov', 'taxonomy general name', APP_DOMAIN),
    'singular_name' =>      _x('Vrsta izdelkov', 'taxonomy singular name', APP_DOMAIN),
    'search_items' =>       __('Poišči vrste izdelkov', APP_DOMAIN),
    'all_items' =>          __('Vse vrste izdelkov', APP_DOMAIN),
    'parent_item' =>        __('Parent vrsta izdelkov', APP_DOMAIN),
    'parent_item_colon' =>  __('Parent vrsta izdelkov:', APP_DOMAIN),
    'edit_item' =>          __('Uredi vrsto izdelkov', APP_DOMAIN),
    'update_item' =>        __('Posodobi vrsto izdelkov', APP_DOMAIN),
    'add_new_item' =>       __('Dodaj novo vrsto izdelkov', APP_DOMAIN),
    'new_item_name' =>      __('Ime nove vrste izdelkov', APP_DOMAIN),
    'menu_name' =>          __('Vrste izdelkov', APP_DOMAIN),
];

return [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => false,
    'rewrite' => ['slug' => 'vrste-izdelkov'],
    'show_in_rest' => true,
    'capabilities'      => array(
        'manage_terms'  => 'manage_vrste-izdelkov',
        'edit_terms'    => 'edit_vrste-izdelkov',
        'delete_terms'  => 'delete_vrste-izdelkov',
        'assign_terms'  => 'assign_vrste-izdelkov'
    )
];
