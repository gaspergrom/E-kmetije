<?php

return function (WP_REST_Request $request) {
    $email = $request->get_param('email');
    if (strlen($email) === 0) {
        return new WP_Error('validation', __('Prosim vnesite email'), array('status' => 422));
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return new WP_Error('validation', __('Prosim vnesite veljaven email'), array('status' => 422));
    }
    $ime = $request->get_param('ime');
    if (strlen($ime) === 0) {
        return new WP_Error('validation', __('Prosim vnesite vaše ime'), array('status' => 422));
    }
    $sporocilo = $request->get_param('sporocilo');
    if (strlen($sporocilo) === 0) {
        return new WP_Error('validation', __('Prosim vnesite vase sporocilo'), array('status' => 422));
    }
    wp_mail('ekmetije@gmail.com', 'E-kmetije - Novo sporočilo!', '
                Pozdravljeni,<br>
                <br>
                Prejeli ste novo sporočilo.<br>
                Ime: ' . $ime .'<br>
                Email: ' . $email . '<br>
                <br>
                ' . str_replace(PHP_EOL,"<br>",$sporocilo) . '<br>
            ', 'Reply-To: '. $ime .' <'.$email .'>');
    return new WP_REST_Response('Sporočilo je bilo uspešno poslano!');
};
