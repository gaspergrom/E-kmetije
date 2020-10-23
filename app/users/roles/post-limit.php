<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 20/10/2020
 * Time: 22:20
 */
add_filter('pre_get_posts', function ($query) {
    if (!current_user_can('administrator')) {
        global $user_ID;
        if (!$query->is_admin) {
            return $query;
        }
        if (in_array($query->get("post_type"), [
            'izdelki',
            'ponudniki',
            'post',
            'page',
            'attachment'
        ])) {
            $query->set('author', $user_ID);
        }

        return $query;
    }
});
