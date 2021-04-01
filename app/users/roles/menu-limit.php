<?php
add_action('admin_menu', function () {
    if (!current_user_can('administrator')) {
        remove_menu_page('edit.php');                                           //Posts
//        remove_menu_page('upload.php');                                         //Media
        remove_menu_page('edit.php?post_type=post');                            //Pages
        remove_menu_page('edit.php?post_type=nastanitve');                            //Pages
        remove_menu_page('edit.php?post_type=turisticni-ponudniki');                            //Pages
        remove_menu_page('edit.php?post_type=ponudniki');                            //Pages
        remove_menu_page('edit.php?post_type=izdelki');                            //Pages
        remove_menu_page('edit.php?post_type=page');                            //Pages
        remove_menu_page('edit-comments.php');                                      //Comments
        remove_menu_page( 'tools.php' );                                   //Comments
        remove_menu_page('themes.php');                                         //Appearance
        remove_menu_page('users.php');                                          //Users
        remove_menu_page('options-general.php');
    }
});
