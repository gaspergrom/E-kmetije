<?php
$labels = [
    'name'                => _x( 'Izdelki', 'Post Type General Name', APP_DOMAIN ),
    'singular_name'       => _x( 'Izdelek', 'Post Type Singular Name', APP_DOMAIN ),
    'menu_name'           => __( 'Izdelki', APP_DOMAIN ),
    'parent_item_colon'   => __( 'Parent izdelek', APP_DOMAIN ),
    'all_items'           => __( 'Vsi izdelki', APP_DOMAIN ),
    'view_item'           => __( 'Poglej izdelke', APP_DOMAIN ),
    'add_new_item'        => __( 'Dodaj nov izdelek', APP_DOMAIN ),
    'add_new'             => __( 'Dodaj nov izdelek', APP_DOMAIN ),
    'edit_item'           => __( 'Uredi', APP_DOMAIN ),
    'update_item'         => __( 'Posodobi', APP_DOMAIN ),
    'search_items'        => __( 'Išči', APP_DOMAIN ),
    'not_found'           => __( 'Ni najdenih izdelkov', APP_DOMAIN ),
    'not_found_in_trash'  => __( 'Ni najdenih izdelkov v smeteh', APP_DOMAIN ),
];
return [
    'label'               => __( 'Izdelki', APP_DOMAIN ),
    'description'         => __( 'Izdelki za ponudnike', APP_DOMAIN ),
    'labels'              => $labels,
    'supports'            => ['title', 'editor', 'revisions', 'author', 'thumbnail', 'excerpt'],
    'taxonomies'          => [],
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 4,
    'menu_icon'           => 'dashicons-tag',
    'rewrite'             => ['slug' => 'izdelki', 'with_front' => false],
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_in_rest'        => true,
    'capability_type'     => 'post',
    'capabilities'        => [
        'edit_post' => 'edit_izdelek',
        'edit_posts' => 'edit_izdelki',
        'edit_others_posts' => 'edit_other_izdelki',
        'publish_posts' => 'publish_izdelki',
        'read_post' => 'read_izdelki',
        'read_private_posts' => 'read_private_izdelki',
        'delete_post' => 'delete_izdelki'
    ]
];
