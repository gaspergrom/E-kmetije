export default {
    init () {
        // JavaScript to be fired on all pages
    },
    finalize () {
        if (!!document.getElementById('ponudnikicarousel') && window.innerWidth < 992) {
            setTimeout(function () {
                $('#ponudnikicarousel').owlCarousel({
                    loop: true,
                    nav: false,
                    dots: true,
                    items: 1
                })
            }, 500);
        }
        if (!!document.getElementById('sponzorjicarousel')) {
            setTimeout(function () {
                $('#sponzorjicarousel').owlCarousel({
                    loop: true,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        768: {
                            items: 4
                        },
                        991: {
                            items: 6
                        }
                    }
                })
            }, 500);
        }
    },
};
