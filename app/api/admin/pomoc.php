<?php

return function (WP_REST_Request $request) {
    $sporocilo = $request->get_param('sporocilo');
    if (strlen($sporocilo) === 0) {
        return new WP_Error('validation', __('Prosim vnesite vase sporocilo'), array('status' => 422));
    }
    $author = $request->get_param('author');
    if (strlen($author) === 0) {
        return new WP_Error('validation', __('Avtor ni naveden'), array('status' => 422));
    }
    $email = get_the_author_meta('user_email', $author);
    $username = get_the_author_meta('user_login', $author);
    wp_mail('ekmetije@gmail.com', 'E-kmetije - Nov zahtevek za pomoč!', '
                Pozdravljeni,<br>
                <br>
                Prejeli ste nov zahtevek za pomoč.<br>
                Uporabniško ime: ' . $username . '<br>
                Email: ' . $email . '<br>
                <br>
                ' . str_replace(PHP_EOL, "<br>", $sporocilo) . '<br>
            ', 'Reply-To: ' . $username . ' <' . $email . '>');
    return new WP_REST_Response('Sporočilo je bilo uspešno poslano!');
};
