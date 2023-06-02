<?php

add_action('wp_enqueue_scripts', 'theme_scripts');
function theme_scripts()
{

    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css');
    wp_register_style('owl-carousel', HLR_THEME_ASSETS . 'css/owl.carousel.css');
    wp_register_style('owl-theme-default', HLR_THEME_ASSETS . 'css/owl.theme.default.css');
    wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_register_style('font-awesome2', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css');
    wp_register_style('imagehover', HLR_THEME_ASSETS . 'css/imagehover.css');
    wp_register_style('style', HLR_THEME_ASSETS . 'css/style.css');
    wp_register_style('responsive', HLR_THEME_ASSETS . 'css/responsive.css');

    wp_enqueue_style('bootstrap');
    wp_enqueue_style('owl-carousel');
    wp_enqueue_style('owl-theme-default');
    wp_enqueue_style('font-awesome2');
    wp_enqueue_style('font-awesome');

    // wp_enqueue_style('imagehover');
    wp_enqueue_style('style');
    wp_enqueue_style('responsive');


    wp_register_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('owl-carousel', HLR_THEME_ASSETS . 'js/owl.carousel.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('nicescroll', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('sweetalert2', HLR_THEME_ASSETS . 'js/sweetalert2@11.js', [], "1.0.0", true);
    wp_register_script('HLR-googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDRDql7G99eM5ij1iv2XjBX3GBw1TollJc&libraries=places&callback=initAutocomplete', [], "1.0.0", true);
    wp_register_script('HLR-script', HLR_THEME_ASSETS . 'js/script.js', [], "1.0.0", true);
    wp_register_script('HLR-ajax', HLR_THEME_ASSETS . 'js/ajax.js', [], "1.0.0", true);

    wp_enqueue_script('bootstrap-bundle');
    wp_enqueue_script('owl-carousel');
    wp_enqueue_script('nicescroll');
    wp_enqueue_script('sweetalert2');
    // wp_enqueue_script('HLR-googleapis');
    wp_enqueue_script('HLR-script');
    wp_enqueue_script('HLR-ajax');





    wp_register_style('pgwslideshow', HLR_THEME_ASSETS . 'css/pgwslideshow.min.css');
    wp_register_style('leaflet', 'https://unpkg.com/leaflet@1.9.3/dist/leaflet.css');
    wp_register_style('rvslider', HLR_THEME_ASSETS . 'css/rvslider.min.css');
    wp_register_style('lightbox2',  'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css');

    wp_register_script('pgwslideshow', HLR_THEME_ASSETS . 'js/pgwslideshow.min.js', [], "1.0.0", true);
    wp_register_script('rvslider', HLR_THEME_ASSETS . 'js/rvslider.min.js', [], "1.0.0", false);
    wp_register_script('leaflet',   'https://unpkg.com/leaflet@1.9.3/dist/leaflet.js', [], "1.0.0", false);
    wp_register_script('lightbox2',   'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', [], "1.0.0", false);

    if (is_singular('properties')) {

        wp_enqueue_style('pgwslideshow');
        wp_enqueue_style('leaflet');
        wp_enqueue_style('rvslider');
        wp_enqueue_style('lightbox2');

        wp_enqueue_script('pgwslideshow');
        wp_enqueue_script('rvslider');
        wp_enqueue_script('leaflet');
        wp_enqueue_script('lightbox2');
    }
}

add_action('wp_head', 'theme_head');
function theme_head()
{
?>

    <?php if (is_singular('properties')) :

        // $post_id = get_the_ID();
        $total_rates = get_post_meta($post_id, 'properties_total_rates', true);
        $user_rates = get_post_meta($post_id, 'properties_user_rates', true);
        $rates = round($total_rates / $user_rates);

        // $terms = get_the_terms($post_id, array('stage', 'type', 'city', 'neighborhood', 'group'));
        // if ($terms) {
        //     $term_ids = array();

        //     foreach ($terms as $item) {
        //         $term_ids[] = $item->term_id;
        //     }

        //     $args = array(
        //         'post_type' => ['properties'],
        //         'post_status' => ['publish'],
        //         'posts_per_page' => 6,
        //         'post__not_in' => [$post_id],
        //         'tax_query' => array(
        //             'relation' => 'OR',
        //             array(
        //                 'taxonomy' => 'stage',
        //                 'field' => 'term_id',
        //                 'terms' => $term_ids
        //             ),
        //             array(
        //                 'taxonomy' => 'type',
        //                 'field' => 'term_id',
        //                 'terms' => $term_ids
        //             ),
        //             array(
        //                 'taxonomy' => 'city',
        //                 'field' => 'term_id',
        //                 'terms' => $term_ids
        //             ),
        //             array(
        //                 'taxonomy' => 'neighborhood',
        //                 'field' => 'term_id',
        //                 'terms' => $term_ids
        //             ),
        //             array(
        //                 'taxonomy' => 'group',
        //                 'field' => 'term_id',
        //                 'terms' => $term_ids
        //             )
        //         ),
        //     );
        //     $peroperties = new WP_Query($args);
        // }
        // if ($peroperties->have_posts()) :
    ?>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "<?= get_the_title() ?>",
                "name": "Imperia Condominiums",
                "description": "<?= get_the_excerpt() ?>",
                "priceRange": "Starting at $365,100",
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "bestRating": "5",
                    "worstRating": "1",
                    "ratingCount": "<?= !empty($user_rates) ? $user_rates : 0  ?>",
                    "ratingValue": "<?= !is_nan($rates) ? $rates : 0  ?>"
                },
                "image": "<?= get_the_post_thumbnail_url() ?>",
                "url": "<?= get_the_permalink() ?>"
            }
        </script>
        <?php
        // endif; 
        ?>
    <?php endif; ?>


    <script>
        var AjaxHLR = {
            "url": "<?= admin_url('admin-ajax.php') ?>"
        };

        var darkStyle = '<?= HLR_THEME_ASSETS . 'css/style-dark.css' ?>';
        var lightStyle = '<?= HLR_THEME_ASSETS . 'css/style.css' ?>';
    </script>
<?php
}


add_action('wp_footer', 'theme_footer');
function theme_footer()
{

?>
    <?php $theme_options = get_option('hlr_framework'); ?>
    <?php if ($theme_options['opt-fixed-menu']) : ?>
        <script>
            jQuery(document).ready(function($) {
                $(window).scroll(function() {
                    var scrollDistance = $(window).scrollTop();
                    var sticker = $('#sticker');
                    if (scrollDistance > 0) {
                        sticker.addClass('fixed-menu top-0');
                    } else {
                        sticker.removeClass('fixed-menu top-0');
                    }
                });
            });
        </script>
    <?php endif; ?>

    <?php if (is_home()) : ?>
        <?php if (!empty($theme_options['opt_homeleaderrealtycounter_items'])) : ?>
            <script>
                function countup(elm, param) {
                    var start = 0;
                    var intval = setInterval(() => {
                        if (param != 0) {
                            if (param > 20000) {
                                start += 1000;
                                param -= 1000;
                            } else if (param > 1000) {
                                start += 500;
                                param -= 500;
                            } else if (param > 500) {
                                start += 100;
                                param -= 100;
                            } else {
                                start++;
                                param--;
                            }
                            jQuery('#' + elm).text(start);
                        } else {
                            clearInterval(intval);
                        }
                    }, 1);
                }

                window.addEventListener('scroll', function() {
                    if (jQuery('body').hasClass('set-counter')) {
                        return;
                    }
                    var element = document.querySelector('#wrap-counter');
                    var position = element.getBoundingClientRect();

                    if (position.top >= 0 && position.bottom <= window.innerHeight) {
                        jQuery('body').addClass('set-counter');
                        <?php foreach ($theme_options['opt_homeleaderrealtycounter_items'] as $item) : ?>
                            countup('<?= $item['opt-homeleaderrealtycounter-id'] ?>', <?= $item['opt-homeleaderrealtycounter-number'] ?>);
                        <?php endforeach; ?>
                    }
                });
            </script>
        <?php endif; ?>
        <script>
            // var placeSearch, autocomplete;
            // var componentForm = {
            //     street_number: 'short_name',
            //     route: 'long_name',
            //     locality: 'long_name',
            //     administrative_area_level_1: 'short_name',
            //     country: 'long_name',
            //     postal_code: 'short_name'
            // };

            // function initAutocomplete() {
            //     autocomplete = new google.maps.places.Autocomplete(
            //         document.getElementById('autocomplete'), {
            //             types: ['geocode']
            //         });
            //     autocomplete.setFields(['address_component']);
            //     autocomplete.addListener('place_changed', fillInAddress);
            // }

            // function fillInAddress() {
            // var place = autocomplete.getPlace();
            // var lat = place.geometry.location.lat();
            // var lng = place.geometry.location.lng();
            // for (var component in componentForm) {
            //     document.getElementById(component).value = '';
            //     document.getElementById(component).disabled = false;
            // }
            // for (var i = 0; i < place.address_components.length; i++) {
            //     var addressType = place.address_components[i].types[0];
            //     if (componentForm[addressType]) {
            //         var val = place.address_components[i][componentForm[addressType]];
            //         document.getElementById(addressType).value = val;
            //     }
            // }
            // }

            // function geolocate() {
            //     if (navigator.geolocation) {
            //         navigator.geolocation.getCurrentPosition(function(position) {
            //             var geolocation = {
            //                 lat: position.coords.latitude,
            //                 lng: position.coords.longitude
            //             };
            //         });
            //     }
            // }
        </script>
    <?php endif; ?>



    <?php if (is_singular('properties')) :
        $locations = get_post_meta(get_the_ID(), 'hlr_framework_properties-location', true)['opt-map-properties'];
    ?>
        <script>
            jQuery(document).ready(function() {
                jQuery('.pgwSlideshow').pgwSlideshow({
                    autoSlide: true,
                    displayControls: false,
                    maxHeight: 600,
                    intervalDuration: 6000,
                    transitionDuration: 2000
                });
            });

            try {
                var map = L.map('map', {
                    zoomControl: false
                }).setView(['<?= $locations['latitude'] ?>', '<?= $locations['longitude'] ?>'], 15);
                L.tileLayer('https://mt0.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    attribution: ''
                }).addTo(map);
                var customIcon = L.icon({
                    iconUrl: '<?= HLR_THEME_ASSETS . 'images/pin.png' ?>',
                    iconSize: [50, 50],
                    iconAnchor: [25, 50]
                });
                L.marker(['<?= $locations['latitude'] ?>', '<?= $locations['longitude'] ?>'], {
                    icon: customIcon
                }).addTo(map);
                map.dragging.disable();
                map.touchZoom.disable();
                map.doubleClickZoom.disable();
                map.scrollWheelZoom.disable();
                map.boxZoom.disable();
                map.keyboard.disable();
                jQuery('.leaflet-control-attribution').remove();
            } catch (error) {}

            jQuery('.rvs-container').rvslider();

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'maxHeight': 500
            })

            jQuery(document).ready(function($) {

                var navigationsticker = $("#navigation-sticker");
                var targetOffset = navigationsticker.offset().top;

                $(window).scroll(function() {
                    var scrollDistance = $(window).scrollTop();
                    var stickermobile = $('#sticker-mobile');
                    if (scrollDistance > 0) {
                        stickermobile.addClass('fixed-menu top-0');
                    } else {
                        stickermobile.removeClass('fixed-menu top-0');
                    }
                    if (scrollDistance >= targetOffset - 48) {
                        navigationsticker.addClass('fixed-menu top-48');
                    } else {
                        navigationsticker.removeClass('fixed-menu top-48');
                    }
                });

                $('#stars .star').on('mouseover', function() {
                    var onStar = parseInt($(this).data('value'), 10);
                    $(this).parent().children('li.star').each(function(e) {
                        if (e < onStar) {
                            $(this).addClass('hover');
                        } else {
                            $(this).removeClass('hover');
                        }
                    });
                }).on('mouseout', function() {
                    $(this).parent().children('li.star').each(function(e) {
                        $(this).removeClass('hover');
                    });
                });

                $('#stars .star').on('click', function() {
                    var onStar = parseInt($(this).data('value'), 10);
                    var stars = $(this).parent().children('li.star');
                    for (i = 0; i < stars.length; i++) {
                        $(stars[i]).removeClass('selected');
                    }
                    for (i = 0; i < onStar; i++) {
                        $(stars[i]).addClass('selected');
                    }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-start',
                        showConfirmButton: false,
                        timer: 1500,
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
                            'action': 'propertiesRating',
                            'post_id': <?= get_the_ID() ?>,
                            'rate': onStar
                        },
                        success: function(data) {
                            if (data.status == 'notLogin') {

                                $('#login-modal').modal('show');

                                Toast.fire({
                                    icon: 'error',
                                    title: 'To submit your rating, you need to login first'
                                })

                            } else if (data.status == 'added') {
                                $('.votes').html(data.votes + ' votes');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Your rating has been saved'
                                })
                            } else if (data.status == 'exists') {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'You have already voted for this item'
                                })
                            }
                        }
                    });

                });

            });
        </script>
    <?php endif; ?>

<?php
}


function admin_enqueue($hook)
{
    wp_register_style('style-admin', HLR_THEME_ASSETS . 'css/style-admin.css');
    if ($hook == 'post-new.php') {
        if ($_GET['post_type'] == 'properties') {
            wp_enqueue_style('style-admin');
        }
    } elseif ($hook == 'post.php') {
        $post_type = get_post_type($_GET['post']);
        if ($post_type == 'properties') {
            wp_enqueue_style('style-admin');
        }
    }
}
add_action('admin_enqueue_scripts', 'admin_enqueue');
