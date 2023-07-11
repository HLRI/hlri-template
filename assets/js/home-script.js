jQuery(".listing-wrap").owlCarousel({
    responsive: { 200: { items: 1, }, 300: { items: 1, }, 600: { items: 2, }, 768: { items: 2, }, 992: { items: 3, }, 1100: { items: 3 }, },
    loop: true,
    nav: true,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    autoplay: false,
    autoplaySpeed: 1000,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    rtl: false,
    center: false,
    dots: false,
    // autoWidth: true,
    margin: 5,
});
var token = getCookie('uthlri');
getPropertiesRestApi('just-launched', 6, 20, token);
getPropertiesRestApi('buy-with-five-percent-down', 6, 21, token);
getPropertiesRestApi('buy-with-10-percent-down', 6, 22, token);
getPropertiesRestApi('commingsoon', 6, 19, token);
$('.owl-carousel').trigger('refresh.owl.carousel');
