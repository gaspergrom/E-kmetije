<?php

$labels = [
    'name' =>               _x('Regije', 'taxonomy general name', APP_DOMAIN),
    'singular_name' =>      _x('Regija', 'taxonomy singular name', APP_DOMAIN),
    'search_items' =>       __('Poišči regije', APP_DOMAIN),
    'all_items' =>          __('Vse regije', APP_DOMAIN),
    'parent_item' =>        __('Parent regija', APP_DOMAIN),
    'parent_item_colon' =>  __('Parent regija:', APP_DOMAIN),
    'edit_item' =>          __('Uredi regijo', APP_DOMAIN),
    'update_item' =>        __('Posodobi regijo', APP_DOMAIN),
    'add_new_item' =>       __('Dodaj novo regijo', APP_DOMAIN),
    'new_item_name' =>      __('Ime nove regije', APP_DOMAIN),
    'menu_name' =>          __('Regije', APP_DOMAIN),
];

return [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => false,
    'rewrite' => ['slug' => 'regije'],
    'show_in_rest' => true,
    'capabilities'      => array(
        'manage_terms'  => 'manage_regije',
        'edit_terms'    => 'edit_regije',
        'delete_terms'  => 'delete_regije',
        'assign_terms'  => 'assign_regije'
    )
];
