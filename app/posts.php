<?php
add_action('init', function () {
     register_post_type('ponudniki', include "posts/ponudniki.php" );
     register_post_type('izdelki', include "posts/izdelki.php" );
});
