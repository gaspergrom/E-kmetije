<?php

return function (WP_REST_Request $request) {
    $name = $request->get_param('name');
    if (strlen($name) === 0) {
        return new WP_Error('validation', __('Prosim vnesite ime izdelka'), array('status' => 422));
    }
    $ponudnik = $request->get_param('ponudnik');
    if (strlen($ponudnik) === 0) {
        return new WP_Error('validation', __('Prosim izberite ponudnika'), array('status' => 422));
    }
    $cena = $request->get_param('cena');
    if (strlen($cena) === 0) {
        return new WP_Error('validation', __('Prosim vnesite ceno'), array('status' => 422));
    }
    $author = $request->get_param('author');
    if (strlen($author) === 0) {
        return new WP_Error('validation', __('Avtor ni naveden'), array('status' => 422));
    }
    $images = $request->get_param('images');
    $opis = $request->get_param('opis');
    $post = wp_insert_post([
        'post_type' => 'nastanitve',
        'post_author' => $author,
        'post_title' => $name,
        'post_content' => $opis,
        'post_status' => 'publish',
        'meta_input' => [
            'ponudnik' => $ponudnik,
            'cena' => $cena,
        ],
    ]);
    foreach($images as $image) {
        add_row('slike', [
            'slika' => $image,
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
        if(count($images) > 0){
            set_post_thumbnail( $post, $images[0]);
        }
        return new WP_REST_Response('Nastanitev uspešno dodana!');
    }

};
