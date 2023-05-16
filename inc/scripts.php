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
    wp_register_script('jquery-sticky', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js', array("jquery"), "1.0.0", false);
    wp_register_script('owl-carousel', HLR_THEME_ASSETS . 'js/owl.carousel.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('nicescroll', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js', array("jquery"), "1.0.0", true);
    wp_register_script('sweetalert2', HLR_THEME_ASSETS . 'js/sweetalert2@11.js', [], "1.0.0", true);
    wp_register_script('HLR-googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDRDql7G99eM5ij1iv2XjBX3GBw1TollJc&libraries=places&callback=initAutocomplete', [], "1.0.0", true);
    wp_register_script('HLR-script', HLR_THEME_ASSETS . 'js/script.js', [], "1.0.0", true);
    wp_register_script('HLR-ajax', HLR_THEME_ASSETS . 'js/ajax.js', [], "1.0.0", true);

    wp_enqueue_script('bootstrap-bundle');
    wp_enqueue_script('jquery-sticky');
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
    <script>
        var AjaxHLR = {
            "url": "<?= admin_url('admin-ajax.php') ?>"
        };
    </script>
<?php
}


add_action('wp_footer', 'theme_footer');
function theme_footer()
{
?>

    <?php if (is_home()) : ?>
        <?php $theme_options = get_option('hlr_framework'); ?>
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

    <?php if ($theme_options['opt-fixed-menu']) : ?>
        <script>
            jQuery("#sticker").sticky({
                topSpacing: 0,
                zIndex: 999
            });
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

            var map = L.map('map', {
                zoomControl: false
            }).setView(['<?= $locations['latitude'] ?>', '<?= $locations['longitude'] ?>'], 15);

            L.tileLayer('https://mt0.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                attribution: ''
            }).addTo(map);

            L.marker(['<?= $locations['latitude'] ?>', '<?= $locations['longitude'] ?>']).addTo(map);
            map.dragging.disable();
            map.touchZoom.disable();
            map.doubleClickZoom.disable();
            map.scrollWheelZoom.disable();
            map.boxZoom.disable();
            map.keyboard.disable();

            jQuery('.leaflet-control-attribution').remove();

            jQuery('.rvs-container').rvslider();

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'maxHeight': 500
            })
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
