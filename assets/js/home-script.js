jQuery(".listing-wrap").owlCarousel({
  responsive: {
    200: { items: 1 },
    300: { items: 1 },
    500: { items: 1.4 },
    600: { items: 2 },
    768: { items: 2 },
    800: { items: 2.4 },
    1000: { items: 2.6 },
    1200: { items: 3 },
    1250: { items: 3.5 },
    1400: { items: 4 },
    1600: { items: 4.3 },
  },
  loop: true,
  nav: true,
  navText: [
    '<i class="fa fa-angle-left" aria-hidden="true"></i>',
    '<i class="fa fa-angle-right" aria-hidden="true"></i>',
  ],
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
var token = getCookie("uthlri");
getPropertiesRestApi("just-launched", 6, 7, token);
getPropertiesRestApi("buy-with-five-percent-down", 6, 9, token);
getPropertiesRestApi("buy-with-10-percent-down", 6, 10, token);
getPropertiesRestApi("immediate-occupancy", 6, 1172, token);
getPropertiesRestApi("commingsoon", 6, 6, token);
getPropertiesRestApi("hot-deals", 6, 8, token);
