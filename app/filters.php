<?php

namespace App;
/**
 * Add <body> classes
 */

add_action('admin_init', function () {
    $users = get_users(['role__in' => ['ponudnik'], 'role__not_in' => ['author']]);
    foreach ($users as $user) {
        $user->add_role('author');
    }
});

add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    if (is_archive()) {
        if (is_post_type_archive('ponudniki')) {
            $classes[] = 'archive-ponudniki';
        } elseif (is_post_type_archive('izdelki')) {
            $classes[] = 'archive-izdelki';
        } elseif (is_post_type_archive('turisticni-ponudniki')) {
            $classes[] = 'archive-turisticni-ponudniki';
        } elseif (is_post_type_archive('nastanitve')) {
            $classes[] = 'nastanitve';
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Excerpt
 */
add_filter('excerpt_more', function () {
    return '...';
});
add_filter('excerpt_length', function () {
    return 10;
});

/**
 * Comments
 */

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory() . '/index.php';
    }
    return $template;
}, PHP_INT_MAX);

//add_filter('wp_insert_post_data', function ($data, $postarr) {
//    $post_type = get_post_type( $data->ID );
//    if($post_type === 'izdelki'){
//        $ponudnik = get_field('ponudnik', $data->ID);
//        $data['post_author'] = $ponudnik->post_author;
//    }
//    return $data;
//}, '99', 2);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory() . '/index.php';
    }

    return $comments_template;
}, 100);



add_action( 'admin_menu', function() {

    global $menu;

    $ponudniki_count = count(get_posts([
        'numberposts'   => -1,
        'post_type'     => 'ponudniki',
        'post_status'   => array( 'pending' ),
    ]));
    $turisticni_ponudniki_count = count(get_posts([
        'numberposts'   => -1,
        'post_type'     => 'turisticni-ponudniki',
        'post_status'   => array( 'pending' ),
    ]));

    $ponudniki = wp_list_filter( $menu, [ 2 => 'edit.php?post_type=ponudniki' ] );
    $turisticni_ponudniki = wp_list_filter( $menu, [ 2 => 'edit.php?post_type=turisticni-ponudniki' ] );

    if ( ! empty( $ponudniki ) && is_array( $ponudniki ) ) {
        $menu[ key( $ponudniki ) ][0] .= " <span class='awaiting-mod update-plugins count-" . esc_attr( $ponudniki_count ) . "'><span class='pending-count'>" . absint( number_format_i18n( $ponudniki_count ) ) . '</span></span>';
    }
    if ( ! empty( $turisticni_ponudniki ) && is_array( $turisticni_ponudniki ) ) {
        $menu[ key( $turisticni_ponudniki ) ][0] .= " <span class='awaiting-mod update-plugins count-" . esc_attr( $turisticni_ponudniki_count ) . "'><span class='pending-count'>" . absint( number_format_i18n( $turisticni_ponudniki_count ) ) . '</span></span>';
    }
} );
