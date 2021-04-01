<?php

return function (WP_REST_Request $request) {
    $naziv = $request->get_param('naziv');
    if (strlen($naziv) === 0) {
        return new WP_Error('validation', __('Prosim vnesite naziv ponudnika'), array('status' => 422));
    }
    $ulica = $request->get_param('ulica');
    if (strlen($ulica) === 0) {
        return new WP_Error('validation', __('Prosim vnesite ulico'), array('status' => 422));
    }
    $postnastevilka = $request->get_param('postnastevilka');
    if (strlen($postnastevilka) === 0) {
        return new WP_Error('validation', __('Prosim vnesite poštno številko'), array('status' => 422));
    }
    $kraj = $request->get_param('kraj');
    if (strlen($kraj) === 0) {
        return new WP_Error('validation', __('Prosim vnesite kraj'), array('status' => 422));
    }
    $regija = $request->get_param('regija');
    if (strlen($regija) === 0) {
        return new WP_Error('validation', __('Prosim vnesite regijo'), array('status' => 422));
    }
    $obcina = $request->get_param('obcina');
    if (strlen($obcina) === 0) {
        return new WP_Error('validation', __('Prosim vnesite občino'), array('status' => 422));
    }
    $author = $request->get_param('author');
    if (strlen($author) === 0) {
        return new WP_Error('validation', __('Avtor ni naveden'), array('status' => 422));
    }
    $telefon = $request->get_param('telefon');
    $spletnastran = $request->get_param('spletnastran');
    $facebook = $request->get_param('facebook');
    $instagram = $request->get_param('instagram');
    $opis = $request->get_param('opis');
    $email = get_the_author_meta('user_email', $author);

    $post = wp_insert_post([
        'post_type' => 'turisticni-ponudniki',
        'post_author' => $author,
        'post_title' => $naziv,
        'post_content' => $opis,
        'post_status' => 'pending',
        'meta_input' => [
            'kraj' => $kraj,
            'ulica' => $ulica,
            'postna_stevilka' => $postnastevilka,
            'naslov' => $ulica . ',
' . $postnastevilka . ' ' . $kraj,
            'kontakti' => [],
        ],
    ]);
    if ($telefon) {
        add_row('kontakti', [
            'vrsta' => 'tel',
            'kontakt' => $telefon,
        ], $post);
    }
    add_row('kontakti', [
        'vrsta' => 'email',
        'kontakt' => $email,
    ], $post);
    if ($spletnastran) {
        if(!str_starts_with($spletnastran, 'http')){
            $spletnastran = "http://".$spletnastran;
        }
        add_row('kontakti', [
            'vrsta' => 'web',
            'kontakt' => $spletnastran,
        ], $post);
    }
    if ($facebook) {
        add_row('druzbena_omrezja', [
            'platforma' => 'facebook',
            'povezava' => $facebook,
        ], $post);
    }
    if ($instagram) {
        if(!str_starts_with($instagram, 'http')){
            $instagram = "https://www.instagram.com/".$instagram;
        }
        add_row('druzbena_omrezja', [
            'platforma' => 'instagram',
            'povezava' => $instagram,
        ], $post);
    }
    if (is_wp_error($post)) {
        $error = $post->get_error_message();
        if ($error) {
            return new WP_Error('postcreation', __($error), array('status' => 422));
        } else {
            return new WP_Error('postcreation', __('Prišlo je do napake pri kreiranju ponudnika'), array('status' => 422));
        }
    } else {
        wp_set_object_terms($post, intval($regija), 'regije');
        wp_set_object_terms($post, intval($obcina), 'obcine');
        wp_mail($email, 'E-kmetije - vaša prijava je bila uspešna!', '
                Pozdravljeni,<br>
                <br>
                Uspešno ste dodali ponudnika! Vaši podatki o ponudniku bodo pregledani s strani ekipe E-kmetije v roku 1-2 dni. Ko bodo vaši podatki ponudnika objavljeni, vas bomo obvestili na vaš email naslov.<br>
                <br>
                Lep pozdrav,<br>
                Ekipa E-kmetije<br>
                <a href="mailto:ekmetije@gmail.com" target="_blank">ekmetije@gmail.com</a><br>
                <a href="tel:+386 41 943 929" target="_blank">+386 41 943 929</a><br>
                <a href="https://e-kmetije.si" target="_blank">e-kmetije.si</a><br>
                <img src="https://e-kmetije.si/wp-content/uploads/logo-1-latest-black.png">
            ');
        wp_mail(['ekmetije@gmail.com', 'gasper.grom@gmail.com', 'ziga.petelinsek@gmail.com'], 'E-kmetije - Nov turistični ponudnik!', '
                Na spletni strani je bil dodan nov turistični ponudnik<br>
                <br>
                <b>Podatki:</b><br>
                E-mail: ' . $email . '<br>
                <br>
                Ponudnik: ' . $naziv . '<br>
                Naslov: ' . $ulica . ', ' . $postnastevilka . ' ' . $kraj . '<br>
                Opis: ' . $opis . '<br>
                Telefon: ' . $telefon . '<br>
                Spletna stran: ' . $spletnastran . '<br>

                Lep pozdrav,<br>
                Ekipa E-kmetije<br>
                <a href="mailto:ekmetije@gmail.com" target="_blank">ekmetije@gmail.com</a><br>
                <a href="tel:+386 41 943 929" target="_blank">+386 41 943 929</a><br>
                <a href="https://e-kmetije.si" target="_blank">e-kmetije.si</a><br>
                <img src="https://e-kmetije.si/wp-content/uploads/logo-1-latest-black.png">
            ');
        return new WP_REST_Response('Ponudnik uspešno dodan!');
    }

};
