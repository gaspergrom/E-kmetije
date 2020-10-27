<?php
///**
// * USER Roles
// */
//
//
add_action("init", function () {
    $admin = get_role( 'administrator' );

    $admin->add_cap('read_ponudniki');
    $admin->add_cap('edit_ponudnik');
    $admin->add_cap('edit_ponudniki');
    $admin->add_cap('edit_other_ponudniki');
    $admin->add_cap('publish_ponudniki');
    $admin->add_cap('read_private_ponudniki');
    $admin->add_cap('delete_ponudniki');

    $admin->add_cap('read_turisticni-ponudniki');
    $admin->add_cap('edit_turisticni-ponudnik');
    $admin->add_cap('edit_turisticni-ponudniki');
    $admin->add_cap('edit_other_turisticni-ponudniki');
    $admin->add_cap('publish_turisticni-ponudniki');
    $admin->add_cap('read_private_turisticni-ponudniki');
    $admin->add_cap('delete_turisticni-ponudniki');

    $admin->add_cap('read_izdelki');
    $admin->add_cap('publish_izdelki');
    $admin->add_cap('edit_izdelek');
    $admin->add_cap('edit_izdelki');
    $admin->add_cap('edit_other_izdelki');
    $admin->add_cap('read_private_izdelki');
    $admin->add_cap('delete_izdelki');

    $admin->add_cap('edit_sponzor');
    $admin->add_cap('edit_sponzorji');
    $admin->add_cap('edit_other_sponzorji');
    $admin->add_cap('publish_splonzorji');
    $admin->add_cap('read_splonzor');
    $admin->add_cap('read_private_sponzorji');
    $admin->add_cap('delete_sponzor');

    $admin->add_cap('manage_dostava');
    $admin->add_cap('edit_dostava');
    $admin->add_cap('delete_dostava');
    $admin->add_cap('assign_dostava');

    $admin->add_cap('manage_obcine');
    $admin->add_cap('edit_obcine');
    $admin->add_cap('delete_obcine');
    $admin->add_cap('assign_obcine');

    $admin->add_cap('manage_regije');
    $admin->add_cap('edit_regije');
    $admin->add_cap('delete_regije');
    $admin->add_cap('assign_regije');

    $admin->add_cap('manage_vrste');
    $admin->add_cap('edit_vrste');
    $admin->add_cap('delete_vrste');
    $admin->add_cap('assign_vrste');

    $admin->add_cap('manage_vrste-izdelkov');
    $admin->add_cap('edit_vrste-izdelkov');
    $admin->add_cap('delete_vrste-izdelkov');
    $admin->add_cap('assign_vrste-izdelkov');
    add_role('ponudnik','Ponudnik', include 'users/ponudnik.php');
    $ponudnik = get_role('ponudnik');
    $ponudnik->add_cap('publish_ponudniki');
});
include 'users/roles/index.php';



