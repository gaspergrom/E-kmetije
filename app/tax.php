<?php
/**
 * Custom taxonomies
 */
add_action('init', function() {
    register_taxonomy('regije',     ['ponudniki'], include "tax/regije.php");
    register_taxonomy('obcine',     ['ponudniki'], include "tax/obcine.php");
    register_taxonomy('vrste-izdelkov',    ['ponudniki', 'izdelki'], include "tax/vrste-izdelkov.php");
    register_taxonomy('dostava',    ['ponudniki'], include "tax/dostava.php");
    register_taxonomy('vrste-vprasanj',    ['pogosta-vprasanja'], include "tax/vrste-vprasanj.php");
});
