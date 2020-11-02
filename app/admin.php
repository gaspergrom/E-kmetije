<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

require_once 'admin/login.php';
/**
 * hide menu on page view
 */
add_action('after_setup_theme', function () {
    if (!current_user_can('administrator')) {
        show_admin_bar(false);
    }
});


add_action('admin_menu', function () {
    add_menu_page(
        __('Ponudniki', 'ekmetije'),
        __('Ponudniki', 'ekmetije'),
        'ponudniki',
        'ponudniki',
        function(){ echo \App\template("admin/ponudniki/index");},
        'dashicons-carrot',
        85
    );
    add_submenu_page(
        'ponudniki',
        __('Dodaj ponudnika', 'ekmetije'),
        __('Dodaj ponudnika', 'ekmetije'),
        'ponudniki',
        'ponudniki-add',
        function(){ echo \App\template("admin/ponudniki/add");},
        85
    );
    add_submenu_page(
        null,
        __('Uredi ponudnika', 'ekmetije'),
        __('Uredi ponudnika', 'ekmetije'),
        'ponudniki',
        'ponudniki-edit',
        function(){ echo \App\template("admin/ponudniki/edit");},
        85
    );
    add_menu_page(
        __('Izdelki', 'ekmetije'),
        __('Izdelki', 'ekmetije'),
        'izdelki',
        'izdelki',
        function(){ echo \App\template("admin/izdelki/index");},
        'dashicons-tag',
        86
    );
    add_submenu_page(
        'izdelki',
        __('Dodaj izdelek', 'ekmetije'),
        __('Dodaj izdelek', 'ekmetije'),
        'izdelki',
        'izdelki-add',
        function(){ echo \App\template("admin/izdelki/add");},
        86
    );
    add_submenu_page(
        null,
        __('Uredi izdelek', 'ekmetije'),
        __('Uredi izdelek', 'ekmetije'),
        'izdelki',
        'izdelki-edit',
        function(){ echo \App\template("admin/izdelki/edit");},
        86
    );
});



