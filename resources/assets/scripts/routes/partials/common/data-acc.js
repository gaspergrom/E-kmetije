export default () => {
    $('[data-acc]').click(function () {
        $($(this).attr('data-acc')).slideToggle(400);
        $(this).toggleClass('active');
    })
}
