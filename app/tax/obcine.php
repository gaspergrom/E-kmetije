<?php

$labels = [
    'name' =>               _x('Občine', 'taxonomy general name', APP_DOMAIN),
    'singular_name' =>      _x('Občina', 'taxonomy singular name', APP_DOMAIN),
    'search_items' =>       __('Poišči občine', APP_DOMAIN),
    'all_items' =>          __('Vse občine', APP_DOMAIN),
    'parent_item' =>        __('Parent občina', APP_DOMAIN),
    'parent_item_colon' =>  __('Parent občina:', APP_DOMAIN),
    'edit_item' =>          __('Uredi občino', APP_DOMAIN),
    'update_item' =>        __('Posodobi občino', APP_DOMAIN),
    'add_new_item' =>       __('Dodaj novo občino', APP_DOMAIN),
    'new_item_name' =>      __('Ime nove občine', APP_DOMAIN),
    'menu_name' =>          __('Občine', APP_DOMAIN),
];

return [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => false,
    'rewrite' => ['slug' => 'obcine'],
    'show_in_rest' => true,
    'capabilities'      => array(
        'manage_terms'  => 'manage_obcine',
        'edit_terms'    => 'edit_obcine',
        'delete_terms'  => 'delete_obcine',
        'assign_terms'  => 'assign_obcine'
    )
];
