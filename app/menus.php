<?php

namespace App;

add_action('init', function() {
    /**
     * Register navigation menus
     */
    register_nav_menus(array(
        'main' => __('Main menu', APP_DOMAIN),
    ));
});
