import { isEmail } from '../util/validations';

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
            const inputs = $(this).serializeArray();
            const data = {};
            inputs.forEach((input) => {
                if (input.name in data) {
                    if (typeof data[input.name] === 'string') {
                        data[input.name] = [data[input.name], input.value];
                    }
                    else {
                        data[input.name].push(input.value);
                    }
                }
                else {
                    data[input.name] = input.value;
                }
            });
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
                    console.log(data);
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
