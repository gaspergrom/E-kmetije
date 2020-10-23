<?php
return [
    'name'              => 'blub-screener-banner',
    'title'             => __('Blub Screener Banner'),
    'description'       => __('A screener banner block.'),
    'render_callback'   => function($block){ echo \App\template("blocks/screener-banner", ['block' => $block]);},
    'category'          => 'common',
    'icon'              => 'screenoptions',
    'keywords'          => array( 'screener', 'banner' ),
    'post_types'        => array('post'), // for blog posts only
    'mode'              => 'auto'
];
