jQuery(document).ready(function ($) {

    if (localStorage.getItem('style-mode') == 'dark') {
        $("div.site-logo a img").attr('src', "/wp-content/themes/homeleaderrealty/assets/images/logo-dark.png");
        $('#style-css').attr('href', darkStyle).addClass('dark-mode');
        localStorage.setItem('style-mode', 'dark');
        $('.sw-mode').toggleClass('d-none d-block');
    } else {
        $('#style-css').attr('href', lightStyle).removeClass('dark-mode');
        localStorage.setItem('style-mode', 'light');
    }


    $(".listing-wrap").owlCarousel({
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
        lazyLoad: true,
        margin: 5,
    });

    $(".neighborhood").owlCarousel({
        responsive: { 200: { items: 1, }, 300: { items: 1, }, 600: { items: 2, }, 768: { items: 2, }, 992: { items: 4, }, 1100: { items: 4 }, },
        loop: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        autoplay: true,
        autoplaySpeed: 2000,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        rtl: false,
        center: false,
        dots: false,
        // autoWidth: true,
        lazyLoad: true,
        margin: 10,
    });

    $(".teams").owlCarousel({
        responsive: { 200: { items: 1, }, 300: { items: 1, }, 600: { items: 2.5, }, 768: { items: 3.5, }, 1000: { items: 6, }, 1200: { items: 6 }, },
        loop: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        autoplay: true,
        autoplaySpeed: 5000,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        rtl: false,
        center: true,
        dots: false,
        margin: 10,
        autoWidth: true,
    });

    $(".postlist").owlCarousel({
        responsive: { 200: { items: 1, }, 300: { items: 1, }, 600: { items: 2, }, 768: { items: 3, }, 1000: { items: 4, }, 1200: { items: 4 }, },
        loop: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        autoplay: true,
        autoplaySpeed: 5000,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        rtl: false,
        center: false,
        dots: false,
        autoWidth: false,
        margin: 10,
    });

    $(".post-related").owlCarousel({
        responsive: { 200: { items: 1, }, 300: { items: 1, }, 600: { items: 2, }, 768: { items: 2, }, 1000: { items: 3, }, 1200: { items: 3 }, },
        loop: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        autoplay: true,
        autoplaySpeed: 5000,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        rtl: false,
        center: false,
        dots: false,
        autoWidth: false,
        margin: 10,
    });

    $(".testimonials").owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        autoplaySpeed: 3000,
        autoplayTimeout: 8000,
        onInitialized: startProgressBar,
        onTranslate: resetProgressBar,
        onTranslated: startProgressBar
    });

    $(".buy-with-10-percent-down").owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        autoplay: true,
        dots: true,
        autoplayHoverPause: true,
        autoplaySpeed: 3000,
        autoplayTimeout: 8000,
        margin: 10,
        onInitialized: startProgressBar,
        onTranslate: resetProgressBar,
        onTranslated: startProgressBar
    });


    $('.testimonials .owl-dots').addClass('mystyle-owl-dots');
    $('.properties-category .owl-dots').addClass('mystyle-owl-dots');

    function startProgressBar() {
        $(".slide-progress").css({
            width: "100%",
            transition: "width 5000ms"
        });
    }

    function resetProgressBar() {
        $(".slide-progress").css({
            width: 0,
            transition: "width 0s"
        });
    }




    //menu drop down
    $('.nav-item').click(function (event) {
        if ($(this).find('.submenu').hasClass('setshow')) {
            $(this).find('.submenu').removeClass('setshow').slideUp(200);
        } else {
            $('.setshow').slideUp(200).removeClass('setshow');
            $(this).find('.submenu').addClass('setshow').slideDown(200);
        }
    });
    $(document).click(function (e) {
        var target = e.target;
        if (!$(target).is('.nav-item') && !$(target).parents().is('.nav-item')) { $(this).find('.submenu').slideUp(200).removeClass('setshow'); }
    });
    var timeout;
    $('.sub-item').mouseover(function () {
        clearTimeout(timeout);
        $(this).find('.submenu2').removeClass('setshow2');
        $('.setshow2').slideUp(200).removeClass('setshow2');
        $(this).find('.submenu2').addClass('setshow2').slideDown(200);
    });
    $('.sub-item').mouseout(function () {
        timeout = setTimeout(() => {
            if (!$(this).find('.submenu2:hover').length > 0) {
                $(this).find('.submenu2').slideUp(200);
            }

        }, 500);
    });

    $('.sub-menu ul').hide();
    $(".sub-menu a").click(function () {
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });

    $('.carousel').carousel({
        interval: 12000
    });

    $('.fa-share-alt').click(function () {
        $(this).parents('.card-listing').find('.card-share').addClass('opened');
    });
    $('.share-close').click(function () {
        $(this).parent().removeClass('opened');
    });

    $('.fa-share-square-o').click(function () {
        $(this).parent().toggleClass('opened-share-float');
    });

    $('.hlr-tooltip').mouseover(function () {
        $('.hlr-tooltip-popup').remove();
        var item = this;
        var direction = $(item).data('hlr-tooltip-direction');
        if ($(item).find('.hlr-tooltip-popup').length > 0) {
            console.log('yes');
        } else {
            $(item).append('<span class="hlr-tooltip-popup d-none">' + $(item).data('hlr-tooltip-title') + '</span>');
            switch (direction) {
                case 'top':
                    $('.hlr-tooltip-popup').addClass('toptooltip').removeClass('d-none');
                    break;

                case 'right':
                    $('.hlr-tooltip-popup').addClass('righttooltip').removeClass('d-none');
                    break;

                case 'bottom':
                    $('.hlr-tooltip-popup').addClass('bottomttooltip').removeClass('d-none');
                    break;

                case 'left':
                    $('.hlr-tooltip-popup').addClass('lefttooltip').removeClass('d-none');
                    break;

                default:
                    $('.hlr-tooltip-popup').addClass('toptooltip').removeClass('d-none');
                    break;
            }
        }
    });
    $('.hlr-tooltip').mouseout(function () {
        $('.hlr-tooltip-popup').remove();
    });


    $('.btn-register').click(function () {
        $('.login-form').addClass('d-none');
        $('.register-form').removeClass('d-none');
        $('.forgot-password-form').addClass('d-none');
    });

    $('.btn-login').click(function () {
        $('.login-form').removeClass('d-none');
        $('.register-form').addClass('d-none');
        $('.forgot-password-form').addClass('d-none');
    });

    $('.btn-forgot-password').click(function () {
        $('.forgot-password-form').removeClass('d-none');
        $('.login-form').addClass('d-none');
        $('.register-form').addClass('d-none');
    });

    $('.menu-account-name').click(function () {
        if ($(this).parent().children('.menu-account-body').hasClass('openAnimation')) {
            $('.menu-account-body').addClass('closeAnimation').removeClass('openAnimation');
            setTimeout(() => {
                $('.menu-account-body').removeClass('d-block')
            }, 300);
        } else {
            $('.menu-account-body').removeClass('closeAnimation').addClass(['d-block', 'openAnimation']);
        }
    });

    $(document).click(function (e) {
        var target = e.target;
        if (!$(target).is('.menu-account-name')) {
            $(this).find('.menu-account-body').addClass('closeAnimation').removeClass('openAnimation');
            setTimeout(() => {
                $('.menu-account-body').removeClass('d-block')
            }, 300);
        }
    });

    $('.close-hlr-navigation').click(function () {
        $('.close-hlr-navigation i').toggleClass('fa-arrow-left fa-arrow-right');
        $('.wrap-hlr-navigation').toggleClass('close-nav');
    });


    $('.hlr-navigation-item').on('click', function (event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });

    $('.hlr-navigation-item-fixed').on('click', function (event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });

    $('.switch-mode').click(function () {
        console.log('t');
        if ($('#style-css').hasClass('dark-mode')) {
            $("div.site-logo a img").attr('src', "/wp-content/themes/homeleaderrealty/assets/images/logo-light.png");
            $('#style-css').attr('href', lightStyle).removeClass('dark-mode');
            localStorage.setItem('style-mode', 'light');
        } else {
            $("div.site-logo a img").attr('src', "/wp-content/themes/homeleaderrealty/assets/images/logo-dark.png");
            $('#style-css').attr('href', darkStyle).addClass('dark-mode');
            localStorage.setItem('style-mode', 'dark');
        }
        $('.sw-mode').toggleClass('d-none d-block');
    });

    var btn = document.getElementById("back-to-top");
    window.addEventListener("scroll", function () {
        if (window.pageYOffset > 100) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    });
    btn.addEventListener("click", function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
    });



    try {
        dataTable = $("#example").DataTable({});

        $('.filter-checkbox').on('change', function (e) {
            var searchTerms = []
            $.each($('.filter-checkbox'), function (i, elem) {
                if ($(elem).prop('checked')) {
                    searchTerms.push("^" + $(this).val() + "$")
                }
            })
            dataTable.column(1).search(searchTerms.join('|'), true, false, true).draw();
        });

        $('.status-dropdown').on('change', function (e) {
            var status = $(this).val();
            $('.status-dropdown').val(status)
            dataTable.column(0).search(status).draw();
        })
    } catch (error) {

    }


});

document.addEventListener('alpine:init', () => {
    Alpine.data('commingsoon', () => ({
        showContent: false,
        loading: true,
        commingsoon: [],
        commingsoons: [],
        init() {

            fetch('https://hlrtest.hlric.com/wp-json/hlri-ajax/get-properties')
                .then(
                    (response) => {
                        if (response.status == 200) {
                            return response.json();
                        }
                    }
                )
                .then(
                    (data) => {
                        this.commingsoons = data.list;
                        this.showContent = true;
                        this.loading = false;
                    }
                );
        },
    }))
})



var app = new Vue({
    el: '#app',
    data: {
        showContent: false,
        loading: true,
        commingsoons: [],
    },
    methods: {
        getPosts() {
        console.log('333');

            fetch('https://hlrtest.hlric.com/wp-json/hlri-ajax/get-properties')
                .then(
                    (response) => {
                        if (response.status == 200) {
                            return response.json();
                        }
                    }
                )
                .then(
                    (data) => {
                        this.commingsoons = data.list;
                        this.showContent = true;
                        this.loading = false;
                    }
                );
        }
    },
    created () {
        this.getPosts();
    }
})