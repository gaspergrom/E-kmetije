<?php
add_action('init', function () {
     register_post_type('ponudniki', include "posts/ponudniki.php");
     register_post_type('izdelki', include "posts/izdelki.php");
     register_post_type('turisticni-ponudniki', include "posts/turisticni-ponudniki.php");
     register_post_type('nastanitve', include "posts/nastanitve.php");
     register_post_type('sponzorji', include "posts/sponzorji.php");
     register_post_type('pogosta-vprasanja', include "posts/pogosta-vprasanja.php");
});
