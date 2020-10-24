<?php


add_action('rest_api_init', function() {
    register_rest_route(API_PREFIX, '/ponudnik', [
        'methods' => 'POST',
        'callback' => include('api/ponudnik.php'),
        'permission_callback' => '__return_true'
    ]);
});