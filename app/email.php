<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23/10/2020
 * Time: 19:34
 */

add_filter('wp_mail_content_type', function () {
    return "text/html";
});

add_filter('wp_mail_from', function ($original_email_address) {
    return 'info@e-kmetije.si';
});

add_filter('wp_mail_from_name', function ($original_email_from) {
    return 'E-kmetije';
});


add_action('pending_to_publish', function ($post) {
    $url = get_permalink($post->ID);
    $authorId = $post->post_author;
    $email = $address = get_the_author_meta('user_email', $authorId);
    if($email){
        wp_mail($email, 'E-kmetije - Vaš ponudnik je bil objavljen!', '
            Pozdravljeni,<br>
            <br>
            Ekipa E-kmetije se vam iskreno zahvaljuje za zaupanje.<br>
            Vašo objavo smo pregledali in jo objavili na naši strani.<br>
            Dosegljiva je na naslednjem naslovu:<br>
            <a href="' . $url . '" target="_blank">' . $url . '</a><br>
            <br>
            V nadzorni plošči za ponudnike lahko kadarkoli dodate in uredite vaše izdelke in informacije o ponudniku. V naslednjih dneh vas bo tudi kontaktirala naša ekipa, ki vam bo pomagala izboljšati stran na E-kmetije, da bo le ta dosegla najboljše rezultate.<br>
            Povezava do nadzorne plošče:<br>
            <a href="https://e-kmetije.si/wp-admin" target="_blank">https://e-kmetije.si/wp-admin</a><br>
            <br>
            V primeru kakršnihkoli vprašanj smo vam na voljo na tem email naslovu.<br>
            <br>
            Lep pozdrav,<br>
            Ekipa E-kmetije<br>
            <a href="mailto:ekmetije@gmail.com" target="_blank">ekmetije@gmail.com</a><br>
            <a href="tel:+386 41 943 929" target="_blank">+386 41 943 929</a><br>
            <a href="https://e-kmetije.si" target="_blank">e-kmetije.si</a><br>
            <img src="https://e-kmetije.si/wp-content/uploads/logo-1-latest-black.png">
        ');
    }

}, 10, 1);
