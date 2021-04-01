<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

require_once 'admin/login.php';
/**
 * hide menu on page view
 */
add_action('after_setup_theme', function () {
    if (!current_user_can('administrator')) {
        show_admin_bar(false);
    }
});


add_action('admin_menu', function () {
    add_menu_page(
        __('Ponudniki', 'ekmetije'),
        __('Ponudniki', 'ekmetije'),
        'ponudniki',
        'ponudniki',
        function () {
            echo \App\template("admin/ponudniki/index");
        },
        'dashicons-carrot',
        85
    );
    add_submenu_page(
        null,
        __('Dodaj ponudnika', 'ekmetije'),
        __('Dodaj ponudnika', 'ekmetije'),
        'ponudniki',
        'ponudniki-add',
        function () {
            echo \App\template("admin/ponudniki/add");
        },
        85
    );
    add_submenu_page(
        null,
        __('Uredi ponudnika', 'ekmetije'),
        __('Uredi ponudnika', 'ekmetije'),
        'ponudniki',
        'ponudniki-edit',
        function () {
            echo \App\template("admin/ponudniki/edit");
        },
        85
    );
    add_submenu_page(
        'ponudniki',
        __('Izdelki', 'ekmetije'),
        __('Izdelki', 'ekmetije'),
        'izdelki',
        'izdelki',
        function () {
            echo \App\template("admin/izdelki/index");
        },
        85
    );
    add_submenu_page(
        null,
        __('Dodaj izdelek', 'ekmetije'),
        __('Dodaj izdelek', 'ekmetije'),
        'izdelki',
        'izdelki-add',
        function () {
            echo \App\template("admin/izdelki/add");
        },
        85
    );
    add_submenu_page(
        null,
        __('Uredi izdelek', 'ekmetije'),
        __('Uredi izdelek', 'ekmetije'),
        'izdelki',
        'izdelki-edit',
        function () {
            echo \App\template("admin/izdelki/edit");
        },
        85
    );
    add_menu_page(
        __('Turistični ponudniki', 'ekmetije'),
        __('Turistični ponudniki', 'ekmetije'),
        'ponudniki',
        'turisticni-ponudniki',
        function () {
            echo \App\template("admin/turisticni-ponudniki/index");
        },
        'dashicons-palmtree',
        86
    );
    add_submenu_page(
        null,
        __('Dodaj turističnega ponudnika', 'ekmetije'),
        __('Dodaj turističnega ponudnika', 'ekmetije'),
        'ponudniki',
        'turisticni-ponudniki-add',
        function () {
            echo \App\template("admin/turisticni-ponudniki/add");
        },
        86
    );
    add_submenu_page(
        null,
        __('Uredi turističnega ponudnika', 'ekmetije'),
        __('Uredi turističnega ponudnika', 'ekmetije'),
        'ponudniki',
        'turisticni-ponudniki-edit',
        function () {
            echo \App\template("admin/turisticni-ponudniki/edit");
        },
        86
    );

    add_submenu_page(
        'turisticni-ponudniki',
        __('Nastanitve', 'ekmetije'),
        __('Nastanitve', 'ekmetije'),
        'ponudniki',
        'nastanitve',
        function () {
            echo \App\template("admin/nastanitve/index");
        },
        86
    );
    add_submenu_page(
        null,
        __('Dodaj nastanitev', 'ekmetije'),
        __('Dodaj nastanitev', 'ekmetije'),
        'ponudniki',
        'nastanitve-add',
        function () {
            echo \App\template("admin/nastanitve/add");
        },
        86
    );
    add_submenu_page(
        null,
        __('Uredi nastanitev', 'ekmetije'),
        __('Uredi nastanitev', 'ekmetije'),
        'ponudniki',
        'nastanitve-edit',
        function () {
            echo \App\template("admin/nastanitve/edit");
        },
        86
    );

    add_menu_page(
        __('Pomoč', 'ekmetije'),
        __('Pomoč', 'ekmetije'),
        'ponudniki',
        'pomoc',
        function () {
            echo \App\template("admin/pomoc");
        },
        'dashicons-sos',
        90
    );

});


add_action('admin_init', function () {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
    remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal');
});

// Create the function to use in the action hook

add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
});


add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget(
        'wpexplorer_dashboard_ponudniki', // Widget slug.
        'Ponudniki', // Title.
        function () {
            $current = get_current_user_id();
            $ponudniki = get_posts([
                'author' => $current,
                'post_type' => 'ponudniki',
                'numberposts' => - 1,
                'post_status' => ['publish', 'pending']
            ]);
            if ($ponudniki)
                foreach ($ponudniki as $ponudnik) {
                    echo '<div class="card pt8 pb8 pl8 pr8 mb8">
                    <div class="flex flex--between">
                        <p class="mb0">' . $ponudnik->post_title . '</p>
                        <div class="flex flex--middle">
                            <p class="mb0"><a href="' . get_the_permalink($ponudnik->ID) . '" target="_blank" class="mr8 text-underline">poglej</a></p>
                            <p class="mb0"><a href="' . admin_url('admin.php?page=ponudniki-edit&id=' . $ponudnik->ID) . '" class=" text-underline">uredi</a></p>
                        </div>
                    </div>
                </div>';
                }
            else {
                echo "<p>Trenutno še nimate ponudnikov</p>";
            }
            echo '<div class="mt16 flex flex--middle">
<a href="'. admin_url('admin.php?page=ponudniki') .'" class="btn btn--square btn--small mr8 mb8" style="color: white">Vsi ponudniki</a>
<a href="'. admin_url('admin.php?page=ponudniki-add') . '" class="btn btn--square btn--small mb8" style="color: white">Dodaj ponudnika</a>
</div>';
        }
    );
    wp_add_dashboard_widget(
        'wpexplorer_dashboard_turisticni-ponudniki', // Widget slug.
        'Turistični ponudniki', // Title.
        function () {
            $current = get_current_user_id();
            $turisticniPonudniki = get_posts([
                'author' => $current,
                'post_type' => 'turisticni-ponudniki',
                'numberposts' => - 1,
                'post_status' => ['publish', 'pending', 'draft']
            ]);
            if($turisticniPonudniki){
                foreach ($turisticniPonudniki as $turisticniPonudnik) {
                    echo '<div class="card pt8 pb8 pl8 pr8 mb8">
                    <div class="flex flex--between">
                        <p class="mb0">' . $turisticniPonudnik->post_title . '</p>
                        <div class="flex flex--middle">
                            <p class="mb0"><a href="'. get_the_permalink($turisticniPonudnik->ID) .'" target="_blank" class="mr8 text-underline">Poglej</a></p>
                            <p class="mb0"><a href="'. admin_url('admin.php?page=turisticni-ponudniki-edit&id='.$turisticniPonudnik->ID) .'" class=" text-underline">Uredi</a></p>
                        </div>
                    </div>
                </div>';
                }
            }
            else {
                echo "<p>Trenutno še nimate turističnih ponudnikov</p>";
            }
            echo '<div class="mt16 flex flex--middle">
<a href="'. admin_url('admin.php?page=turisticni-ponudniki') .'" class="btn btn--square btn--small mr8 mb8" style="color: white">Vsi turistični ponudniki</a>
<a href="'. admin_url('admin.php?page=turisticni-ponudniki-add') . '" class="btn btn--square btn--small mb8" style="color: white">Dodaj turističnega ponudnika</a>
</div>';

        }
    );
});


