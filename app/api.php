<?php


add_action('rest_api_init', function() {
    register_rest_route(API_PREFIX, '/ponudnik', [
        'methods' => 'POST',
        'callback' => include('api/ponudnik.php'),
        'permission_callback' => '__return_true'
    ]);
    register_rest_route(API_PREFIX, '/kontakt', [
        'methods' => 'POST',
        'callback' => include('api/kontakt.php'),
        'permission_callback' => '__return_true'
    ]);
    register_rest_route(API_PREFIX, '/admin/ponudnik', [
        'methods' => 'POST',
        'callback' => include('api/admin/ponudnik.php'),
        'permission_callback' => '__return_true'
    ]);
    register_rest_route(API_PREFIX, '/admin/ponudnik/edit', [
        'methods' => 'POST',
        'callback' => include('api/admin/ponudnikEdit.php'),
        'permission_callback' => '__return_true'
    ]);
    register_rest_route(API_PREFIX, '/admin/izdelek', [
        'methods' => 'POST',
        'callback' => include('api/admin/izdelek.php'),
        'permission_callback' => '__return_true'
    ]);
    register_rest_route(API_PREFIX, '/admin/izdelek/edit', [
        'methods' => 'POST',
        'callback' => include('api/admin/izdelekEdit.php'),
        'permission_callback' => '__return_true'
    ]);
});
