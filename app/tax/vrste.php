<?php

$labels = [
    'name' =>               _x('Vrste ponudnikov', 'taxonomy general name', APP_DOMAIN),
    'singular_name' =>      _x('Vrsta ponudnikov', 'taxonomy singular name', APP_DOMAIN),
    'search_items' =>       __('Poišči vrste ponudnikov', APP_DOMAIN),
    'all_items' =>          __('Vse vrste ponudnikov', APP_DOMAIN),
    'parent_item' =>        __('Parent vrsta ponudnikov', APP_DOMAIN),
    'parent_item_colon' =>  __('Parent vrsta ponudnikov:', APP_DOMAIN),
    'edit_item' =>          __('Uredi vrsto ponudnikov', APP_DOMAIN),
    'update_item' =>        __('Posodobi vrsto ponudnikov', APP_DOMAIN),
    'add_new_item' =>       __('Dodaj novo vrsto ponudnikov', APP_DOMAIN),
    'new_item_name' =>      __('Ime nove vrste ponudnikov', APP_DOMAIN),
    'menu_name' =>          __('Vrste ponudnikov', APP_DOMAIN),
];

return [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => false,
    'rewrite' => ['slug' => 'vrste'],
    'show_in_rest' => true,
    'capabilities'      => array(
        'manage_terms'  => 'manage_vrste',
        'edit_terms'    => 'edit_vrste',
        'delete_terms'  => 'delete_vrste',
        'assign_terms'  => 'assign_vrste'
    )
];
