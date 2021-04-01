import serialize from "../../core/serialize";

export default () => {
    const body = $('html, body');
    const form = $('#formadminizdelkiadd');
    const message = form.find('#message');
    form.submit(function (e) {
        e.preventDefault();
        message.text('');
        const data = serialize($(this));
        let el = [];
        if (data.name.length === 0) {
            el.push('name');
        }

        if (data.ponudnik.length === 0) {
            el.push('ponudnik');
        }

        if (data.cenavrsta.length === 0) {
            el.push('cenavrsta');
        }
        if (!data.vrsta) {
            el.push('vrsta');
        }
        if (data.cenavrsta === 'cena' && data.cenavrednost.length === 0) {
            el.push('cenavrednost');
        }
        data.opis = tinymce.get('tinymceeditor').getContent();

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
        $.post('/wp-json/ekmetije/v1/admin/izdelek', data)
            .done(function (data) {
                submitbtn.css('display', 'block');
                loading.css('display', 'none');
                message.removeClass('error-text').addClass('success-text');
                message.text(data);
                document.getElementById('formadminizdelkiadd').reset();
            })
            .fail(function (data) {
              submitbtn.css('display', 'block');
              loading.css('display', 'none');
                message.removeClass('success-text').addClass('error-text');
                if (data.responseJSON && data.responseJSON.message) {
                    message.text(data.responseJSON.message);
                }
                else {
                    message.text('Prišlo je do napake, prosim kontaktirajte podporo')
                }
            })
    });
};
