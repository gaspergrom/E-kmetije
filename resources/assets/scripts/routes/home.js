export default {
    init () {
        // JavaScript to be fired on all pages
    },
    finalize () {
        if (window.innerWidth < 992) {
            setTimeout(function () {
                $('#ponudnikicarousel').owlCarousel({
                    loop: true,
                    nav: false,
                    dots: true,
                    items: 1
                })
            }, 500);
        }
    },
};
