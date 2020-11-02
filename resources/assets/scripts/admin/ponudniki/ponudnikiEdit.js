import serialize from "../../core/serialize";

export default () => {
    const body = $('html, body');
    const form = $('#formadminponudnikedit');
    const message = form.find('#message');
    form.submit(function (e) {
        e.preventDefault();
        message.text('');
        const data = serialize($(this));
        console.log(data)
        let el = [];
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
        data.kontakti = JSON.parse($('[data-kontakt]').attr('data-kontakt'));

        if (el.length > 0) {
            el.forEach((name) => {
                $(`[name=${name}]`).addClass('error');
            });
            if(!message.text().length){
                message.removeClass('success-text').addClass('error-text');
                message.text('Prosim vnesite vsa potrebna polja');
            }
            body.animate({
                scrollTop: $(`[name=${el[0]}]`).offset().top - 150
            }, 500);
            return;
        }
        const submitbtn = $(this).find('button[type="submit"]');
        const loading = $(this).find('.loading');
        submitbtn.css('display', 'none');
        loading.css('display', 'block');
        $.post('/wp-json/ekmetije/v1/admin/ponudnik/edit', data)
            .done(function (data) {
                console.log(data);
                submitbtn.css('display', 'block');
                loading.css('display', 'none');
                message.removeClass('error-text').addClass('success-text');
                message.text(data);
                document.getElementById('formadminponudnikadd').reset();
            })
            .fail(function (data) {
                console.log(data);
                submitbtn.css('display', 'block');
                loading.css('display', 'none');
                message.removeClass('success-text').addClass('error-text');
                if (data.responseJSON && data.responseJSON.message) {
                    error.text(data.responseJSON.message);
                }
                else {
                    error.text('Prišlo je do napake, prosim kontaktirajte podporo')
                }
            })
    });
};
