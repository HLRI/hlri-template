<?php

add_action('wp_enqueue_scripts', 'theme_scripts');
function theme_scripts()
{

    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css');
    wp_register_style('datatables', 'https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
    wp_register_style('owl-carousel', HLR_THEME_ASSETS . 'css/owl.carousel.css');
    wp_register_style('owl-theme-default', HLR_THEME_ASSETS . 'css/owl.theme.default.css');
    wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_register_style('font-awesome2', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css');
    wp_register_style('imagehover', HLR_THEME_ASSETS . 'css/imagehover.css');
    wp_register_style('style', HLR_THEME_ASSETS . 'css/style.css');
    wp_register_style('responsive', HLR_THEME_ASSETS . 'css/responsive.css');
    wp_register_style('extra', HLR_THEME_ASSETS . 'css/extra-css.css');

    wp_enqueue_style('bootstrap');
    wp_enqueue_style('owl-carousel');
    wp_enqueue_style('owl-theme-default');
    wp_enqueue_style('font-awesome2');
    wp_enqueue_style('font-awesome');

    // wp_enqueue_style('imagehover');
    wp_enqueue_style('style');
    wp_enqueue_style('responsive');
    // wp_enqueue_style('extra');


    wp_register_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('owl-carousel', HLR_THEME_ASSETS . 'js/owl.carousel.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('nicescroll', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('sweetalert2', HLR_THEME_ASSETS . 'js/sweetalert2@11.js', [], "1.0.0", true);
    wp_register_script('HLR-googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDRDql7G99eM5ij1iv2XjBX3GBw1TollJc&libraries=places&callback=initAutocomplete', [], "1.0.0", true);
    wp_register_script('datatables', 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('HLR-script', HLR_THEME_ASSETS . 'js/script.js', [], "1.0.0", true);
    wp_register_script('HLR-home-script', HLR_THEME_ASSETS . 'js/home-script.js', [], "1.0.0", true);
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
    wp_register_style('leafletFullscreen', HLR_THEME_ASSETS . 'css/Control.FullScreen.css');
    wp_register_style('lightbox2',  'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css');
    wp_register_style('lightslider',  'https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css');
    wp_register_style('fancybox',  'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.5/dist/fancybox.css');

    wp_register_script('pgwslideshow', HLR_THEME_ASSETS . 'js/pgwslideshow.min.js', [], "1.0.0", true);
    wp_register_script('rvslider', HLR_THEME_ASSETS . 'js/rvslider.min.js', [], "1.0.0", false);
    wp_register_script('leaflet',   'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js', [], "1.0.0", false);
//    wp_register_script('leafletFullscreen', HLR_THEME_ASSETS . 'js/Control.FullScreen.js', [], "1.0.0", false);
    wp_register_script('lightbox2',   'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', [], "1.0.0", false);
    wp_register_script('lightslider',   'https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js', ['jquery'], "1.0.0", false);
    wp_register_script('fancybox',   'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.5/dist/fancybox.umd.js', ['jquery'], "1.0.0", false);

    if (is_singular('properties')) {

        wp_enqueue_style('pgwslideshow');
        wp_enqueue_style('leaflet');
        wp_enqueue_style('leafletFullscreen');
        wp_enqueue_style('rvslider');
        wp_enqueue_style('lightslider');
        wp_enqueue_style('fancybox');

        wp_enqueue_script('pgwslideshow');
        wp_enqueue_script('leafletFullscreen');
        wp_enqueue_script('rvslider');
        wp_enqueue_script('leaflet');
        wp_enqueue_script('lightslider');
        wp_enqueue_script('fancybox');
    }

    if (is_singular('floorplans') || is_singular('properties')) {
        wp_enqueue_style('pgwslideshow');
        wp_enqueue_style('rvslider');
        wp_enqueue_style('lightslider');
        wp_enqueue_style('fancybox');
        wp_enqueue_style('lightbox2');

        wp_enqueue_script('pgwslideshow');
        wp_enqueue_script('rvslider');
        wp_enqueue_script('leaflet');
        wp_enqueue_script('lightslider');
        wp_enqueue_script('fancybox');
        wp_enqueue_script('lightbox2');
    }

    if (is_singular('floorplans') || is_singular('properties')) {
        wp_enqueue_style('datatables');
        wp_enqueue_script('datatables');
    }

    if (is_home()) {
        wp_enqueue_script('HLR-home-script');
    }
    if (is_single()) {
        wp_enqueue_script('HLR-home-script');
    }
}

add_action('wp_head', 'theme_head');
function theme_head()
{

    $theme_option = get_option('hlr_framework');
?>

    <?php if (is_home()) : ?>

    <?php endif; ?>


    <?php if (is_singular('properties')) :
        $post_id = get_the_ID();
        $total_rates = get_post_meta($post_id, 'properties_total_rates', true);
        $user_rates = get_post_meta($post_id, 'properties_user_rates', true);
        if (!empty($total_rates)) {
            $rates = round($total_rates / $user_rates);
        } else {
            $rates = 0;
        }
        $mdata_single = get_post_meta($post_id, 'hlr_framework_mapdata', true);
        $city = wp_get_post_terms($post_id, 'city',  array("fields" => "names"));
        if (empty($city)) {
            $city[0] = '';
        }
    ?>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "LocalBusiness",
                "name": "<?= get_the_title() ?>",
                "description": "<?= get_the_excerpt() ?>",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "<?= $city[0] ?>",
                    "addressRegion": "ON",
                    "streetAddress": "<?= $mdata_single['opt-address'] ?>",
                    "addressCountry": "CA"
                },
                "telephone": "<?= $theme_option['opt-schema-phone'] ?>",
                <?php if (!empty($mdata_single['opt-price-min'])) : ?> "priceRange": "Starting at $<?= number_format($mdata_single['opt-price-min']) ?>",
                <?php endif; ?> "aggregateRating": {
                    "@type": "AggregateRating",
                    "bestRating": "5",
                    "worstRating": "1",
                    "ratingCount": "<?= !empty($user_rates) ? $user_rates : 1  ?>",
                    "ratingValue": "<?= ($rates === 0 || is_nan($rates)) ? 1 : $rates ?>"
                },
                "image": "<?= get_the_post_thumbnail_url() ?>",
                "url": "<?= get_the_permalink() ?>"
            }
        </script>
    <?php endif; ?>


    <script>
        var AjaxHLR = {
            "url": "<?= admin_url('admin-ajax.php') ?>"
        };

        var home_url = '<?= home_url('/') ?>';

        var darkStyle = '<?= HLR_THEME_ASSETS . 'css/style-dark.css' ?>';
        var darkLogo = '<?= $theme_option['opt-menu-logo-dark']['url'] ?>';
        var lightLogo = '<?= $theme_option['opt-menu-logo']['url'] ?>';
        var hlriDarkLogo = '<?= $theme_option['opt-menu-hlri-logo-dark']['url'] ?>';
        var hlriLightLogo = '<?= $theme_option['opt-menu-hlri-logo']['url'] ?>';
        var lightStyle = '<?= HLR_THEME_ASSETS . 'css/style.css' ?>';
    </script>
<?php
}


add_action('wp_footer', 'theme_footer', 10);
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
                    var sticker = $('#sticker-mobile');
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
                            jQuery('#' + elm).text(start.toLocaleString());
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

<!-- Properties map -->

    <?php if (is_singular('properties')) :
    if (!empty(get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true))) {
        $locations = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-coords'];
    } else {
        $locations = '';
    }
    ?>
    <script>
        jQuery(document).ready(function($) {

            $('.pgwSlideshow').pgwSlideshow({
                lazyLoad: true,
                autoSlide: true,
                displayControls: false,
                maxHeight: 600,
                intervalDuration: 6000,
                transitionDuration: 2000,
            });

            $(".ecommerce-gallery").lightSlider({
                lazyLoad: true,
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 10,
                thumbMargin: 10,
            });
            $(".floors-gallery").lightSlider({
                lazyLoad: true,
                clone: false,
                gallery: false,
                item: 1,
            });
            $(".flr-gallery").lightSlider({
                lazyLoad: true,
                clone: false,
                gallery: false,
                item: 1,
            });


        });

        try {
            var map = L.map('map', {
                zoomControl: true,
                fullscreenControl: true,
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
            // map.boxZoom.disable();
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

            // var navigationsticker = $("#navigation-sticker");
            // var targetOffset = navigationsticker.offset().top;
            //
            // $(window).scroll(function() {
            //     var scrollDistance = $(window).scrollTop();
            //     var stickermobile = $('#sticker-mobile');
            //     if (scrollDistance > 0) {
            //         stickermobile.addClass('fixed-menu top-0');
            //     } else {
            //         stickermobile.removeClass('fixed-menu top-0');
            //     }
            //     if (scrollDistance >= targetOffset - 48) {
            //         navigationsticker.addClass('fixed-menu top-48');
            //     } else {
            //         navigationsticker.removeClass('fixed-menu top-48');
            //     }
            // });

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
?>
    <script type="text/javascript">
        (function(c, l, a, r, i, t, y) {
            c[a] = c[a] || function() {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "i94l62vy4h");
    </script>
    <?php
}
add_action('admin_enqueue_scripts', 'admin_enqueue');


function add_search_input_to_meta_box($meta_box_id)
{
    global $pagenow;

    if (($pagenow === 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) === 'properties') || ($pagenow === 'post-new.php' && get_post_type($_GET['post']) === 'properties')) {
        ?>
        <style>.categorydiv div.tabs-panel{height:250px;}</style><script>

            document.getElementById('in-group-10-2').addEventListener('change', function(event) {
                event.preventDefault(); // Prevent the default behavior of the checkbox toggle
                event.stopPropagation(); // Prevent the event from bubbling up

                // Manually restore the checkbox state to its original value
                const commercialCheckbox = document.getElementById('in-group-1064-2');
                const originalState = commercialCheckbox.checked; // Store the original state
                console.log('Commercial checkbox state before change:', originalState);

                // If necessary, re-check the checkbox if it's being toggled
                commercialCheckbox.checked = originalState;

                console.log('Commercial checkbox state after preventing toggle:', commercialCheckbox.checked);
            });



            jQuery(document).ready(function($) {
                $('#<?php echo esc_attr($meta_box_id); ?>').before('<div style="height: 45px;"><input type="text" class="live-search" placeholder="Search..." style="margin-top: 20px;width: 100%;"></div>');
                $('.live-search').on('keyup', function() {
                    var searchValue = $(this).val().toLowerCase();
                    $('#' + <?php echo json_encode($meta_box_id); ?> + ' li').each(function() {
                        var listItemText = $(this).text().toLowerCase();
                        if (listItemText.indexOf(searchValue) !== -1) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });


            // hide assignments staffs
            function findDivToToggle(text) {
                var h4Elements = document.querySelectorAll('.csf-field-number h4');

                var divToToggle;
                h4Elements.forEach(function(h4Element) {
                    if (h4Element.textContent.trim() === text) {
                        divToToggle = h4Element.closest('.csf-field-number');
                    }
                });

                return divToToggle;
            }

            function toggleDivVisibility() {
                var selectValue = document.querySelector('[data-depend-id="opt-sales-type"]').value;
                var divToToggle = findDivToToggle("Original Price");
                var divToToggle2 = findDivToToggle("Paid Deposit");
                var divToToggle3 = findDivToToggle("Total Cash Required");
                var divToToggle4 = findDivToToggle("Remaining Deposit");
                var divToToggle5 = findDivToToggle("CP Price");

                if (divToToggle) {
                    if ((selectValue === 'Assignment') || selectValue === 'Resale') {
                        divToToggle.style.display = 'block';
                        divToToggle2.style.display = 'block';
                        divToToggle3.style.display = 'block';
                        divToToggle4.style.display = 'block';
                    } else {
                        divToToggle.style.display = 'none';
                        divToToggle2.style.display = 'none';
                        divToToggle3.style.display = 'none';
                        divToToggle4.style.display = 'none';
                    }
                    if ((selectValue === 'Coming soon')) {
                        divToToggle5.style.display = 'block';
                    } else{
                        divToToggle5.style.display = 'none';
                    }
                }
            }

            // Add onchange event listener to the select element
            document.querySelector('select[data-depend-id="opt-sales-type"]').addEventListener("change", function() {
                toggleDivVisibility();
            });
            toggleDivVisibility();
        </script>
<?php
    }
}
add_action('admin_footer', 'add_search_input_to_meta_boxes');
function add_search_input_to_meta_boxes()
{
    add_search_input_to_meta_box('sales-teamchecklist');
    add_search_input_to_meta_box('developerchecklist');
    add_search_input_to_meta_box('groupchecklist');
    add_search_input_to_meta_box('citychecklist');
//    add_search_input_to_meta_box('stagechecklist');
//    add_search_input_to_meta_box('typechecklist');
    add_search_input_to_meta_box('neighborhoodchecklist');
}



add_filter('post_thumbnail_html', 'default_post_image', 10, 5);

function default_post_image($html, $post_id, $post_thumbnail_id, $size, $attr){
    
    if ($post_thumbnail_id) {
        return $html;
    }

    // Set the default image URL
    $default_image_url = HLR_THEME_ASSETS . 'images/posts-default-img.png';

    // Create an HTML img tag with the default image URL
    $html = '<img src="' . esc_url($default_image_url) . '" alt="Default Image" />';
    
    return $html;
}
