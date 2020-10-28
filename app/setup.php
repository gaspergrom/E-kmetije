<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');

    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), [], APP_VERSION);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], APP_VERSION, true);
    if (is_front_page()
        || is_singular(['ponudniki', 'izdelki'])
        || basename(get_page_template()) == "template-zemljevid.blade.php"
        || is_post_type_archive(['ponudniki', 'izdelki'])
        || is_tax(['vrste-izdelkov', 'regije', 'obcine','dostava'])) {
        wp_enqueue_script('google-maps-clusers', "https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js", [], null, true);
        wp_enqueue_script('google-maps', "https://maps.googleapis.com/maps/api/js?key=" . get_field('google_maps', 'options') . "&callback=initMap&libraries=&v=weekly", [], null, true);
    }
}, 100);

add_action('login_head', function () {
    wp_enqueue_style('sage/login.css', asset_path('styles/login.css'), [], APP_VERSION);
}, 100);


add_action('init', function () {
    add_rewrite_endpoint('prikazi', EP_VRSTE_IZDELKOV);
    add_rewrite_endpoint('prikazi', EP_SEARCH);
});

add_action('pre_get_posts', function ($query) {
    if ($query->is_main_query() && !$query->is_admin() && is_tax('vrste-izdelkov')) {
        $post_type = $query->get('prikazi');
        if ($post_type) {
            $query->set('post_type', $post_type);
        } else {
            $query->set('post_type', 'izdelki');
        }
    }
    if ($query->is_search() && !$query->is_admin()) {
        $post_type = $query->get('prikazi');
        if ($post_type) {
            $query->set('post_type', $post_type);
        } else {
            $query->set('post_type', 'post');
        }
    }
});


add_action('template_redirect', function() {
    global $wp_rewrite;


    if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->get_search_permastruct()) {
        return;
    }

    $search_base = $wp_rewrite->search_base;

    if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
        if(isset($_GET['post_type']) && $_GET['post_type'] && ($_GET['post_type'] === 'izdelki' || $_GET['post_type'] === 'ponudniki')){
            wp_redirect(get_search_link(). 'prikazi/'.$_GET['post_type']);
            exit();
        }
        if(strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false){
            wp_redirect(get_search_link());
            exit();
        }
    }
});

add_filter('wpseo_json_ld_search_url', function($url) {
    return str_replace('/?s=', '/search/', str_replace('&post_type=', '/prikazi/', $url));
});


remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
//    add_theme_support('soil-nice-search');
//    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ];
    register_sidebar([
            'name' => __('Primary', 'sage'),
            'id' => 'sidebar-primary'
        ] + $config);
    register_sidebar([
            'name' => __('Footer', 'sage'),
            'id' => 'sidebar-footer'
        ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });


    /**
     * Create Blade directives
     */
//    sage('blade')->compiler()->directive('inapp', function () {
    /*        return '<?php if(!isset($_GET["inapp"])): ?>';*/
//    });
//    sage('blade')->compiler()->directive('endinapp', function () {
    /*        return "<?php endif; ?>";*/
//    });
});
