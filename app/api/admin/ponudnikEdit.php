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
    $postId = $request->get_param('post_id');
    if (strlen($postId) === 0) {
        return new WP_Error('validation', __('Ponudnik ni naveden'), array('status' => 422));
    }
    $kontakti = $request->get_param('kontakti');
    $vrste = $request->get_param('vrste');
    $dostava = $request->get_param('dostava');
    $email = get_the_author_meta('user_email', $author);

    $post = wp_update_post([
        'ID' => $postId,
        'post_author' => $author,
        'post_title' => $naziv,
        'meta_input' => [
            'kraj' => $kraj,
            'ulica' => $ulica,
            'postna_stevilka' => $postnastevilka,
            'naslov' => $ulica . ',
' . $postnastevilka . ' ' . $kraj,
            'kontakti' => [],
        ],
    ]);
    foreach($kontakti as $kontakt){
        add_row('kontakti', [
            'vrsta' => $kontakt['vrsta'],
            'kontakt' => $kontakt['kontakt'],
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
        wp_set_object_terms($post, arrayInt($vrste), 'vrste-izdelkov');
        wp_set_object_terms($post, arrayInt($dostava), 'dostava');
        return new WP_REST_Response('Ponudnik uspešno posodobljen!');
    }

};
