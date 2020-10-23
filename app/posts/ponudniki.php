<?php
$labels = [
    'name'                => _x( 'Ponudniki', 'Post Type General Name', APP_DOMAIN ),
    'singular_name'       => _x( 'Ponudnik', 'Post Type Singular Name', APP_DOMAIN ),
    'menu_name'           => __( 'Ponudniki', APP_DOMAIN ),
    'parent_item_colon'   => __( 'Parent ponudnik', APP_DOMAIN ),
    'all_items'           => __( 'Vsi ponudniki', APP_DOMAIN ),
    'view_item'           => __( 'Poglej ponudnika', APP_DOMAIN ),
    'add_new_item'        => __( 'Dodaj novega ponudnika', APP_DOMAIN ),
    'add_new'             => __( 'Dodaj novega', APP_DOMAIN ),
    'edit_item'           => __( 'Uredi', APP_DOMAIN ),
    'update_item'         => __( 'Posodobi', APP_DOMAIN ),
    'search_items'        => __( 'Išči', APP_DOMAIN ),
    'not_found'           => __( 'Ni najdenih ponudnikov', APP_DOMAIN ),
    'not_found_in_trash'  => __( 'Ni najdenih ponudnikov v smeteh', APP_DOMAIN ),
];
return [
    'label'               => __( 'Ponudniki', APP_DOMAIN ),
    'description'         => __( 'Ponudnik', APP_DOMAIN ),
    'labels'              => $labels,
    'supports'            => ['title', 'editor', 'revisions', 'author', 'comments'],
    'taxonomies'          => [],
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 4,
    'menu_icon'           => 'dashicons-carrot',
    'rewrite'             => ['slug' => 'ponudniki', 'with_front' => false],
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_in_rest'        => true,
    'capability_type'     => 'post',
    'capabilities'        => [
        'edit_post' => 'edit_ponudnik',
        'edit_posts' => 'edit_ponudniki',
        'edit_others_posts' => 'edit_other_ponudniki',
        'publish_posts' => 'publish_ponudniki',
        'read_post' => 'read_ponudniki',
        'read_private_posts' => 'read_private_ponudniki',
        'delete_post' => 'delete_ponudniki'
    ]
];
