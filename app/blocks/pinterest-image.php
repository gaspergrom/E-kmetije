<?php
return [
    'name'              => 'blub-pinterest-image',
    'title'             => __('Blub Pinterest Image'),
    'description'       => __('A pinterest image block.'),
    'render_callback'   => function($block){ echo \App\template("blocks/pinterest-image", ['block' => $block]);},
    'category'          => 'common',
    'icon'              => 'format-image',
    'keywords'          => array( 'pinterest', 'image' ),
    'post_types'        => array('post'), // for blog posts only
    'mode'              => 'auto'
];
