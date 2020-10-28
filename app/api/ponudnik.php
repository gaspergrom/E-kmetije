<?php
function arrayInt($array){
    if(is_array($array)){
        return array_map(function($el) {
            return intval($el);
        }, $array);
    }
    else{
        return intval($array);
    }
}

return function (WP_REST_Request $request) {
    $email = $request->get_param('email');
    if (strlen($email) === 0) {
        return new WP_Error('validation', __('Prosim vnesite email'), array('status' => 422));
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return new WP_Error('validation', __('Prosim vnesite veljaven email'), array('status' => 422));
    }
    $username = $request->get_param('username');
    if (strlen($username) === 0) {
        return new WP_Error('validation', __('Prosim vnesite uporabniško ime'), array('status' => 422));
    }
    $geslo = $request->get_param('geslo');
    if (strlen($geslo) === 0) {
        return new WP_Error('validation', __('Prosim vnesite geslo'), array('status' => 422));
    }
    $ponovigeslo = $request->get_param('ponovigeslo');
    if (strlen($ponovigeslo) === 0) {
        return new WP_Error('validation', __('Prosim ponovno vnesite geslo'), array('status' => 422));
    }
    if ($geslo !== $ponovigeslo) {
        return new WP_Error('validation', __('Gesli se ne ujemata'), array('status' => 422));
    }

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
    $zasebnost = $request->get_param('zasebnost');
    if (strlen($zasebnost) === 0) {
        return new WP_Error('validation', __('Strinjati se morate s politiko zasebnosti'), array('status' => 422));
    }
    $telefon = $request->get_param('telefon');
    $spletnastran = $request->get_param('spletnastran');
    $vrste = $request->get_param('vrste');
    $dostava = $request->get_param('dostava');
    $opis = $request->get_param('opis');
    $user = wp_create_user($username, $geslo, $email);
    if (is_wp_error($user)) {
        $error = $user->get_error_message();
        if ($error) {
            return new WP_Error('usercreation', __($error), array('status' => 422));
        } else {
            return new WP_Error('usercreation', __('Prišlo je do napake pri kreiranju uporabnika'), array('status' => 422));
        }

    } else {

        $post = wp_insert_post([
            'post_type' => 'ponudniki',
            'post_author' => $user,
            'post_title' => $naziv,
            'post_excerpt' => $opis,
            'post_content' => "<!-- wp:paragraph -->
<p>" . $opis . "</p>
<!-- /wp:paragraph -->",
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
        if($telefon){
            add_row('kontakti',  [
                'vrsta' => 'tel',
                'kontakt' => $telefon,
            ], $post);
        }
        add_row('kontakti',  [
            'vrsta' => 'email',
            'kontakt' => $email,
        ], $post);
        if($spletnastran){
            add_row('kontakti',  [
                'vrsta' => 'web',
                'kontakt' => $spletnastran,
            ], $post);
        }
        if (is_wp_error($post)) {
            $error = $post->get_error_message();
            if ($error) {
                return new WP_Error('postcreation', __($error), array('status' => 422));
            } else {
                return new WP_Error('postcreation', __('Prišlo je do napake pri kreiranju ponudnika'), array('status' => 422));
            }
        }
        else{
            wp_set_object_terms( $post, intval($regija), 'regije' );
            wp_set_object_terms( $post, intval($obcina), 'obcine' );
            wp_set_object_terms( $post, arrayInt($vrste), 'vrste-izdelkov' );
            wp_set_object_terms( $post, arrayInt($dostava), 'dostava' );
            wp_mail($email, 'E-kmetije - vaša prijava je bila uspešna!', '
                Pozdravljeni,<br>
                <br>
                Ekipa e-kmetije se vam zahvaljuje za prijavo. Do naše spletne strani vam je bil dodeljen dostop s podatki, ki ste jih vnesli ob prijavi.<br>
                <br>
                E-mail: ' .$email . '<br> 
                Uporabniško ime: '. $username . '<br>
                
                Do nadzorne plošče lahko dostopate na naslednji povezavi.<br>
                <a href="https://e-kmetije.si/wp-admin" target="_blank">https://e-kmetije.si/wp-admin</a><br>
                <br>
                Vaši podatki o ponudniku bodo pregledani s strani naše ekipe v roku 1-2 dni. Ko bodo vaši podatki ponudnika objavljeni, vas bomo obvestili na vaš email naslov.<br>
                <br>
                Lep pozdrav,<br>
                Ekipa E-kmetije<br>
                <a href="mailto:ekmetije@gmail.com" target="_blank">ekmetije@gmail.com</a><br>
                <a href="tel:+386 41 943 929" target="_blank">+386 41 943 929</a><br>
                <a href="https://e-kmetije.si" target="_blank">e-kmetije.si</a><br>
                <img src="https://e-kmetije.si/wp-content/uploads/logo-1-latest-black.png">
            ');
            wp_mail('ekmetije@gmail.com', 'E-kmetije - Nov ponudnik!', '
                Na spletni strani je bil dodan nov ponudnik<br>
                <br>
                <b>Podatki:</b><br>
                Uporabniško ime: '. $username .'<br>
                E-mail: '. $email .'<br>
                <br>
                Ponudnik: '. $naziv .'<br>
                Naslov: '. $ulica .', '. $postnastevilka .' '. $kraj .'<br>
                Opis: '. $opis .'<br>
                Telefon: '. $telefon .'<br>
                Spletna stran: '. $spletnastran .'<br>
                
                Lep pozdrav,<br>
                Ekipa E-kmetije<br>
                <a href="mailto:ekmetije@gmail.com" target="_blank">ekmetije@gmail.com</a><br>
                <a href="tel:+386 41 943 929" target="_blank">+386 41 943 929</a><br>
                <a href="https://e-kmetije.si" target="_blank">e-kmetije.si</a><br>
                <img src="https://e-kmetije.si/wp-content/uploads/logo-1-latest-black.png">
            ');
            return new WP_REST_Response('Vloga uspešno poslana!');
        }

    }
};
