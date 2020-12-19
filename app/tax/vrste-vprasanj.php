<?php

$labels = [
    'name' =>               _x('Vrste vprašanj', 'taxonomy general name', APP_DOMAIN),
    'singular_name' =>      _x('Vrsta vprašanj', 'taxonomy singular name', APP_DOMAIN),
    'search_items' =>       __('Poišči vrste vprašanj', APP_DOMAIN),
    'all_items' =>          __('Vse vrste vprašanj', APP_DOMAIN),
    'parent_item' =>        __('Parent vrsta vprašanj', APP_DOMAIN),
    'parent_item_colon' =>  __('Parent vrsta vprašanj:', APP_DOMAIN),
    'edit_item' =>          __('Uredi vrsto vprašanj', APP_DOMAIN),
    'update_item' =>        __('Posodobi vrsto vprašanj', APP_DOMAIN),
    'add_new_item' =>       __('Dodaj novo vrsto vprašanj', APP_DOMAIN),
    'new_item_name' =>      __('Ime nove vrste vprašanj', APP_DOMAIN),
    'menu_name' =>          __('Vrste vprašanj', APP_DOMAIN),
];

return [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => false,
    'rewrite' => [
        'slug' => 'vrste-vprasanj',
        'ep_mask' => EP_VRSTE_IZDELKOV
    ],
    'show_in_rest' => true,
];
