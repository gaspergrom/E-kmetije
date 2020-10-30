export default () => {
    setTimeout(() => {
        const cookie = $('.cookie');
        const save = localStorage.getItem('cookies');
        if (!save) {
            cookie.addClass('active');
            cookie.find('.cookie__close').click(() => {
                cookie.removeClass('active');
                localStorage.setItem('cookies', 'true');
            })
        }
    }, 1000);
}
