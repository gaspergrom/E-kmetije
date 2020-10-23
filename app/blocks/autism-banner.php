<?php
return [
    'name'              => 'blub-autism-banner',
    'title'             => __('Blub Autism Banner'),
    'description'       => __('A autism banner block.'),
    'render_callback'   => function($block){ echo \App\template("blocks/autism-banner", ['block' => $block]);},
    'category'          => 'common',
    'icon'              => 'screenoptions',
    'keywords'          => array( 'autism', 'banner' ),
    'post_types'        => array('post'), // for blog posts only
    'mode'              => 'auto'
];
