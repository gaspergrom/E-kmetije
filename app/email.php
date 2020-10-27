<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23/10/2020
 * Time: 19:34
 */

add_filter('wp_mail_content_type', function () {
    return "text/html";
});

add_filter('wp_mail_from', function ($original_email_address) {
    return 'info@e-kmetije.si';
});

add_filter('wp_mail_from_name', function ($original_email_from) {
    return 'E-kmetije';
});


add_action('pending_to_publish', function ($post) {
    var_dump($post_id);
    die();
}, 10, 1);
