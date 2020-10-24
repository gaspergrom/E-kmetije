import { isEmail } from '../util/validations';
import serialize from "./partials/common/serialize";

export default {
    init () {
        // JavaScript to be fired on the home page
    },
    finalize () {
        const error = $('#formponudnik .error-text');
        const body = $('html, body');
        $('#formponudnik').submit(function (e) {
            e.preventDefault();
            error.text('');
            const data = serialize($(this));
            let el = [];
            if (data.email.length === 0) {
                el.push('email');
            }
            if (!isEmail(data.email)) {
                el.push('email');
            }
            if (data.username.length === 0) {
                el.push('username');
            }
            if (data.geslo.length === 0) {
                el.push('geslo');
            }
            if (data.ponovigeslo.length === 0) {
                el.push('ponovigeslo');
            }
            if (data.geslo !== data.ponovigeslo) {
                el.push('geslo');
                el.push('ponovigeslo');
                error.text('Vnešeni gesli se ne ujemata')
            }

            if (data.naziv.length === 0) {
                el.push('naziv');
            }

            if (data.ulica.length === 0) {
                el.push('ulica');
            }
            if (data.postnastevilka.length === 0) {
                el.push('postnastevilka');
            }
            if (data.kraj.length === 0) {
                el.push('kraj');
            }
            if (!data.regija) {
                el.push('regija');
            }
            if (!data.obcina) {
                el.push('obcina');
            }

            if (!data.zasebnost) {
                if(!error.text().length) {
                    error.text('Strinjati se morate s politiko zasebnosti');
                }
                el.push('zasebnost');
            }
            if (el.length > 0) {
                el.forEach((name) => {
                    $(`[name=${name}]`).addClass('error');
                });
                if(!error.text().length){
                    error.text('Prosim vnesite vsa potrebna polja');
                }
                body.animate({
                    scrollTop: $(`[name=${el[0]}]`).offset().top - 150
                }, 500);
                return;
            }
            $.post('/wp-json/ekmetije/v1/ponudnik', data)
                .done(function (data) {
                    window.location = '/ponudniki-zakljucek'
                })
                .fail(function (data) {
                    if (data.responseJSON && data.responseJSON.message) {
                        error.text(data.responseJSON.message);
                    }
                    else {
                        error.text('Prišlo je do napake, prosim kontaktirajte podporo')
                    }
                })
        });
    },
};
