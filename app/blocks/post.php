<?php
return [
    'name'              => 'blub-post',
    'title'             => __('Blub Post'),
    'description'       => __('A post block.'),
    'render_callback'   => function($block){ echo \App\template("blocks/post", ['block' => $block]);},
    'category'          => 'common',
    'icon'              => 'admin-post',
    'keywords'          => array( 'post' ),
    'post_types'        => array('post'), // for blog posts only
    'mode'              => 'auto'
];
