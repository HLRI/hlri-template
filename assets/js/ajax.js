jQuery(document).ready(function ($) {

    $('#latest-tab').html('<div class="text-center"> <div class="spinner-border spinner-border-sm text-warning" role="status"></div></div>');
    $.ajax({
        type: "post",
        url: '/wp-admin/admin-ajax.php',
        data: {
            'action': 'getlatestpost',
        },
        success: function (data) {
            $('#latest-tab').html(data);
        }
    });


    $('#Latest').click(function () {
        $('#latest-tab').html('<div class="text-center"> <div class="spinner-border spinner-border-sm text-warning" role="status"></div></div>');
        $.ajax({
            type: "post",
            url: '/wp-admin/admin-ajax.php',
            data: {
                'action': 'getlatestpost',
            },
            success: function (data) {
                $('#latest-tab').html(data);
            }
        });
    });


    $('#Popular').click(function () {
        $('#popular-tab').html('<div class="text-center"> <div class="spinner-border spinner-border-sm text-warning" role="status"></div></div>');
        $.ajax({
            type: "post",
            url: '/wp-admin/admin-ajax.php',
            data: {
                'action': 'getpopularpost',
            },
            success: function (data) {
                $('#popular-tab').html(data);
            }
        });
    });


});


function bookmark(element, post_id) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    jQuery.ajax({
        type: "post",
        url: '/wp-admin/admin-ajax.php',
        data: {
            'action': 'propertoesFavorites',
            'post_id': post_id
        },
        success: function (data) {
            if (data.status == 'notLogin') {

                Toast.fire({
                    icon: 'error',
                    title: 'To save a property you should login first.'
                })

            } else if (data.status == 'added') {
                Toast.fire({
                    icon: 'success',
                    title: 'Saved to your collection'
                })
                jQuery(element).css({
                    color: '#9de450'
                });
            } else if (data.status == 'removed') {
                Toast.fire({
                    icon: 'success',
                    title: 'Removed from your collection'
                })
                jQuery(element).css({
                    color: '#aaa'
                });
            }
        }
    });
}

function setLikeProperties(item, properties_id) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    jQuery.ajax({
        type: "post",
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'set_like_properties',
            properties_id: properties_id,
        },
        success: function (response) {
            if (response.status == "set") {
                // Toast.fire({
                //     icon: 'success',
                //     title: 'Liked successfully'
                // })
                jQuery(item).css({
                    color: 'red'
                });
            } else {
                // Toast.fire({
                //     icon: 'success',
                //     title: 'Unliked successfully'
                // })
                jQuery(item).css({
                    color: '#aaa'
                });
            }
            jQuery(item).parent().find('#like-total').html(response.total);
        }
    });
}

jQuery('#submit-login').on('click', function (e) {
    jQuery('.login-form .form-loading').removeClass('d-none');
    jQuery('.login-form .notif-info').removeClass('success-info').addClass('d-none');
    jQuery('.login-form .notif-info').removeClass('error-info').addClass('d-none');
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/wp-admin/admin-ajax.php',
        data: {
            'action': 'ajax_login',
            'username': jQuery('.login-form #username').val(),
            'password': jQuery('.login-form #password').val(),
            'security': jQuery('.login-form #security').val()
        },
        success: function (data) {
            // console.log(data);
            jQuery('.login-form .form-loading').addClass('d-none');
            if (data.loggedin == true) {
                jQuery('.login-form .notif-info').addClass('success-info').removeClass('d-none').text(data.message);
                document.location.href = data.url;
            } else {
                jQuery('.login-form .notif-info').addClass('error-info').removeClass('d-none').text(data.message);
            }
        }
    });
    e.preventDefault();
});

jQuery('#submit-register').on('click', function (e) {
    jQuery('.register-form .form-loading').removeClass('d-none');
    jQuery('.register-form .notif-info').removeClass('success-info').addClass('d-none');
    jQuery('.register-form .notif-info').removeClass('error-info').addClass('d-none');
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/wp-admin/admin-ajax.php',
        data: {
            'action': 'ajax_register',
            'username': jQuery('.register-form #username').val(),
            'email': jQuery('.register-form #email').val(),
            'password': jQuery('.register-form #password').val(),
            'security': jQuery('.register-form #security').val()
        },
        success: function (data) {
            // console.log(data);
            jQuery('.register-form .form-loading').addClass('d-none');
            if (data.status == true) {
                jQuery('.register-form .notif-info').addClass('success-info').removeClass('d-none').text(data.message);
                document.location.href = data.url;
            } else {
                jQuery('.register-form .notif-info').addClass('error-info').removeClass('d-none').text(data.message);
            }
        }
    });
    e.preventDefault();
});

jQuery('#submit-forgot-password').on('click', function (e) {
    jQuery('.forgot-password-form .form-loading').removeClass('d-none');
    jQuery('.forgot-password-form .notif-info').removeClass('success-info').addClass('d-none');
    jQuery('.forgot-password-form .notif-info').removeClass('error-info').addClass('d-none');
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/wp-admin/admin-ajax.php',
        data: {
            'action': 'ajax_forgot_password',
            'username': jQuery('.forgot-password-form #username').val(),
            'security': jQuery('.forgot-password-form #security').val()
        },
        success: function (data) {
            // console.log(data);
            jQuery('.forgot-password-form .form-loading').addClass('d-none');
            if (data.loggedin == true) {
                jQuery('.forgot-password-form .notif-info').addClass('success-info').removeClass('d-none').text(data.message);
            } else {
                jQuery('.forgot-password-form .notif-info').addClass('error-info').removeClass('d-none').text(data.message);
            }
        }
    });
    e.preventDefault();
});


// function hlr_search() {
//     jQuery('.search-result').removeClass('d-block');
//     jQuery('.search-result').html('').hide();
//     var value = jQuery('#keyword').val();
//     if (value.length > 3) {
//         jQuery('.search-icon').html('<div class="text-center"> <div class="spinner-border" role="status"></div> </div>');
//         jQuery.ajax({
//             url: '/wp-admin/admin-ajax.php',
//             type: 'post',
//             data: {
//                 action: 'hlr_search',
//                 keyword: jQuery('#keyword').val()
//             },
//             success: function(data) {
//                 jQuery('.search-result').addClass('d-block').html(data).fadeIn(300);
//             }
//         });
//     }
// }

function hlr_search() {
    var query = jQuery('.keyword').val();
console.log(query);
    if(query == null || query == ''){
        jQuery('.search-result').removeClass('d-block');
        return;
    }

    fetch('https://api.mapbox.com/geocoding/v5/mapbox.places/' + query + '.json?access_token=pk.eyJ1IjoiZWhzYW5iYXZhZ2hhciIsImEiOiJjbGdkeDZ2c20waHh6M2xwajlzbmhzaHFnIn0.zK6XBntMDbVlFWxY-QhPGg')
        .then(response => response.json())
        .then(data_mapbox => {

            jQuery('.search-result').removeClass('d-block');
            jQuery('.search-result').html('').hide();
            jQuery('.search-icon').html('<div class="text-center"> <div class="spinner-border" role="status"></div> </div>');
            jQuery.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'post',
                data: {
                    action: 'hlr_search',
                    keyword: jQuery('.keyword').val()
                },
                success: function (data) {
                    jQuery('.search-result').html(data);
                    // setTimeout(() => {
                    // var items = jQuery('.pac-item');
                    // if (items.length != 0) {
                    // jQuery('.search-result').prepend(items);
                    // jQuery('.pac-item').addClass('result-card mt-1 mb-2 px-3').removeClass('pac-item');
                    // jQuery('.pac-icon').removeClass('pac-icon-marker').removeClass('pac-icon');
                    // jQuery('.pac-item-query').removeClass('pac-item-query');
                    // jQuery('.pac-matched').removeClass('pac-matched');
                    if (data_mapbox.features != '') {
                        jQuery.each(data_mapbox.features, function (i, item) {
                            jQuery('.search-result').prepend('<div class="result-card mt-1 mb-2 px-3"><a href="#">' + item.place_name + '</a></div>');
                        });
                        jQuery('.search-result').prepend('<h4 class="info-title">Locations</h4>');
                    }
                    // }
                    jQuery('.search-result').addClass('d-block').fadeIn(300);


                    // }, 1000);
                }
            });
        })
        .catch(error => {
            console.error(error);
        });

}

function hlr_search_mobile() {
    var query = jQuery('.keyword').val();
console.log(query);
    if(query == null || query == ''){
        jQuery('.search-result').removeClass('d-block');
        return;
    }

    fetch('https://api.mapbox.com/geocoding/v5/mapbox.places/' + query + '.json?access_token=pk.eyJ1IjoiZWhzYW5iYXZhZ2hhciIsImEiOiJjbGdkeDZ2c20waHh6M2xwajlzbmhzaHFnIn0.zK6XBntMDbVlFWxY-QhPGg')
        .then(response => response.json())
        .then(data_mapbox => {

            jQuery('.search-result').removeClass('d-block');
            jQuery('.search-result').html('').hide();
            jQuery('.search-icon').html('<div class="text-center"> <div class="spinner-border" role="status"></div> </div>');
            jQuery.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'post',
                data: {
                    action: 'hlr_search',
                    keyword: jQuery('.keyword').val()
                },
                success: function (data) {
                    jQuery('.search-result').html(data);
                    // setTimeout(() => {
                    // var items = jQuery('.pac-item');
                    // if (items.length != 0) {
                    // jQuery('.search-result').prepend(items);
                    // jQuery('.pac-item').addClass('result-card mt-1 mb-2 px-3').removeClass('pac-item');
                    // jQuery('.pac-icon').removeClass('pac-icon-marker').removeClass('pac-icon');
                    // jQuery('.pac-item-query').removeClass('pac-item-query');
                    // jQuery('.pac-matched').removeClass('pac-matched');
                    if (data_mapbox.features != '') {
                        jQuery.each(data_mapbox.features, function (i, item) {
                            jQuery('.search-result').prepend('<div class="result-card mt-1 mb-2 px-3"><a href="#">' + item.place_name + '</a></div>');
                        });
                        jQuery('.search-result').prepend('<h4 class="info-title">Locations</h4>');
                    }
                    // }
                    jQuery('.search-result').addClass('d-block').fadeIn(300);


                    // }, 1000);
                }
            });
        })
        .catch(error => {
            console.error(error);
        });

}


