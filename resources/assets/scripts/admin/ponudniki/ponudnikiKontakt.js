import serialize from "../../core/serialize";

export default () => {
    const dataKontakt = $('[data-kontakt]');
    let kontakti = [];

    function renderKontakt () {
        dataKontakt.attr('data-kontakt', JSON.stringify(kontakti));
        dataKontakt.empty();
        kontakti.forEach(function (kontakt, index) {
            dataKontakt.append(`
                <div class="card pt8 pb8 pl16 pr8 mb8 mt0" style="width: 100%;">
                    <div class="flex flex--middle">
                        <div style="width: calc(100% - 37px);">
                            <p class="text-bold mb0"><span
                                        class="text-normal">${kontakt.vrsta}</span>: ${kontakt.kontakt}
                            </p>
                        </div>
                        <button type="button" class="btn btn--square btn--icon btn--small btn--danger"
                                data-kontakt-delete="${index}">x
                        </button>
                    </div>
                </div>
            `)
        })
    }

    $('[data-kontakt-add]').click(function () {
        const vrsta = $('[data-kontakt-add-vrsta]');
        const kontakt = $('[data-kontakt-add-kontakt]');
        console.log(kontakt.val());
        if (kontakt.val().length === 0) {
            kontakt.addClass('error');
            return;
        }
        kontakti.push({
            vrsta: vrsta.val(),
            kontakt: kontakt.val()
        });
        renderKontakt()
    });

    if (dataKontakt) {
        // kontakti = JSON.parse(dataKontakt.attr('data-kontakt'));
        // renderKontakt();
        // dataKontakt.on('click', '[data-kontakt-delete]', function () {
        //     const id = $(this).attr('data-kontakt-delete');
        //     kontakti.splice(id, 1);
        //     renderKontakt();
        // })
    }
};
