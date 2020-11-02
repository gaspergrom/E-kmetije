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
    $cenavrsta = $request->get_param('cenavrsta');
    if (strlen($cenavrsta) === 0) {
        return new WP_Error('validation', __('Prosim izberite vrsto cene'), array('status' => 422));
    }
    $cenavrednost = $request->get_param('cenavrednost');
    if ($cenavrsta == 'cena' && strlen($cenavrednost) === 0) {
        return new WP_Error('validation', __('Prosim vnesite vrednost cene'), array('status' => 422));
    }
    $author = $request->get_param('author');
    if (strlen($author) === 0) {
        return new WP_Error('validation', __('Avtor ni naveden'), array('status' => 422));
    }
    $postId = $request->get_param('post_id');
    if (strlen($postId) === 0) {
        return new WP_Error('validation', __('Ponudnik ni naveden'), array('status' => 422));
    }
    $post = wp_update_post([
        'ID' => $postId,
        'post_author' => $author,
        'post_title' => $name,
        'meta_input' => [
            'ponudnik' => $ponudnik
        ],
    ]);
    if (is_wp_error($post)) {
        $error = $post->get_error_message();
        if ($error) {
            return new WP_Error('postcreation', __($error), array('status' => 422));
        } else {
            return new WP_Error('postcreation', __('Prišlo je do napake pri posodobitvi izdelka'), array('status' => 422));
        }
    } else {
//        wp_set_object_terms($post, intval($regija), 'regije');
        update_field('cena', array(
            'vrsta' => $cenavrsta,
            'vrednost' => $cenavrednost,
        ), $post);
        return new WP_REST_Response('Izdelek uspešno posodobljen!');
    }

};
