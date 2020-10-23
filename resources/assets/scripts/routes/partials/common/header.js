export default () => {
    let headerBtn = $('.header__btn');
    let headerLinks = $('.header__links');
    let header = $('.header');
    headerBtn.click(function (e) {
        e.preventDefault();
        headerLinks.toggleClass('open');
        headerBtn.toggleClass('open');
        header.toggleClass('open');
        body.toggleClass('overflow');
    });
}
