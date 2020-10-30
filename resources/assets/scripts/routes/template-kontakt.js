import { isEmail } from '../util/validations';
import serialize from "./partials/common/serialize";

export default {
    init () {
        // JavaScript to be fired on the home page
    },
    finalize () {
        const message = $('#formkontakt #message');
        const body = $('html, body');
        const form = $('#formkontakt');
        form.submit(function (e) {
            e.preventDefault();
            message.text('');
            const data = serialize($(this));
            let el = [];
            if (data.email.length === 0) {
                el.push('email');
            }
            if (!isEmail(data.email)) {
                el.push('email');
            }
            if (data.ime.length === 0) {
                el.push('ime');
            }
            if (data.sporocilo.length === 0) {
                el.push('sporocilo');
            }
            if (el.length > 0) {
                el.forEach((name) => {
                    $(`[name=${name}]`).addClass('error');
                });
                message.text('Prosim vnesite vsa potrebna polja');
                message.removeClass('success-text').addClass('error-text');
                body.animate({
                    scrollTop: $(`[name=${el[0]}]`).offset().top - 150
                }, 500);
                return;
            }
            const submitbtn = $(this).find('button[type="submit"]');
            const loading = $(this).find('.loading');
            submitbtn.css('display', 'none');
            loading.css('display', 'block');
            $.post('/wp-json/ekmetije/v1/kontakt', data)
                .done(function (data) {
                    submitbtn.css('display', 'block');
                    loading.css('display', 'none');
                    message.removeClass('error-text').addClass('success-text');
                    message.text(data);
                    document.getElementById('formkontakt').reset();
                })
                .fail(function (data) {
                    message.removeClass('success-text').addClass('error-text');
                    if (data.responseJSON && data.responseJSON.message) {
                        message.text(data.responseJSON.message);
                    }
                    else {
                        message.text('Prišlo je do napake, prosim kontaktirajte podporo')
                    }
                })
        });
    },
};
