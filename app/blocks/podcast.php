<?php
return [
    'name'              => 'blub-podcast',
    'title'             => __('Blub Podcast'),
    'description'       => __('A podcast block.'),
    'render_callback'   => function($block){ echo \App\template("blocks/podcast", ['block' => $block]);},
    'category'          => 'common',
    'icon'              => 'playlist-audio',
    'keywords'          => array( 'podcast' ),
    'post_types'        => array('post'), // for blog posts only
    'mode'              => 'auto'
];
