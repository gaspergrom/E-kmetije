<?php
return [
    'name'              => 'blub-solution-banner',
    'title'             => __('Blub Solution Banner'),
    'description'       => __('A solution banner block.'),
    'render_callback'   => function($block){ echo \App\template("blocks/solution-banner", ['block' => $block]);},
    'category'          => 'common',
    'icon'              => 'screenoptions',
    'keywords'          => array( 'solution', 'banner' ),
    'post_types'        => array('post'), // for blog posts only
    'mode'              => 'auto'
];
