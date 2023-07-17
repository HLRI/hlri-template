<?php

if (!defined('ABSPATH')) {
    exit;
}


include 'constant.php';

include HLR_THEME_PATH . 'inc/match_elementor.php';
include HLR_THEME_PATH . '/lib/validation/vendor/autoload.php';
include HLR_THEME_PATH . '/lib/validation/canada_phone_rule.php';
include HLR_THEME_PATH . '/lib/vendor/autoload.php';
include HLR_THEME_PATH . 'lib/codestar/codestar-framework.php';
include HLR_THEME_PATH . 'inc/validate_codestar.php';
include HLR_THEME_PATH . 'lib/view-module/view.php';
include HLR_THEME_PATH . 'options.php';
include HLR_THEME_PATH . 'inc/init.php';
include HLR_THEME_PATH . 'inc/helper.php';
include HLR_THEME_PATH . 'inc/scripts.php';
include HLR_THEME_PATH . 'inc/ajax.php';
include HLR_THEME_PATH . 'inc/forms.php';
include HLR_THEME_PATH . 'inc/shortcodes.php';
include HLR_THEME_PATH . 'inc/post_types.php';
include HLR_THEME_PATH . 'inc/meta_boxes.php';
include HLR_THEME_PATH . 'inc/taxonomy.php';
include HLR_THEME_PATH . 'inc/visit_history.php';
include HLR_THEME_PATH . 'inc/admin_pages.php';

// function my_awesome_func_two()
// {
//     $args = array(
//         'post_type' => 'mapdata',
//         'post_status' => 'publish',
//         'posts_per_page' => -1,
//     );

//     $my_query = null;
//     $my_query = new WP_query($args);
//     if ($my_query->have_posts()) :
//         while ($my_query->have_posts()) : $my_query->the_post();
//             $mapMeta = get_post_meta(get_the_ID(), 'hlr_framework_map', true);
//             if (true == true) {
//                 if (!empty($mapMeta)) {
//                     $slug = get_post_field('post_name', get_post());


//                     if (!is_array($mapMeta['opt-type']) && $mapMeta['opt-type'] != null) {

//                         $mapMetaType = explode(',', $mapMeta['opt-type']);
//                     } else {
//                         $mapMetaType = $mapMeta['opt-type'];
//                     }

//                     $mapMetaType = array_map(function ($item) {
//                         return ($item == "Home") ? "Detached" : $item;
//                     }, $mapMetaType);

//                     $mapdata[] = [
//                         'post_id' => strval(get_the_ID()),
//                         'title' => get_the_title(),
//                         'available_floorplans' => $mapMeta[$mapMeta['opt-available-floorplans']],
//                         //                  'permalink' => get_the_permalink(),
//                         'permalink' => 'https://locatecondo.com/i/' . $slug,
//                         'updated' => get_the_date(),
//                         'address' => $mapMeta['opt-address'],
//                         'thumbnail' => get_the_post_thumbnail_url(),
//                         'pricepersqft' => $mapMeta['opt-pricepersqft'],
//                         'strings' => [],
//                         'terms' => $mapMeta['opt-incentives'],
//                         'price' => $mapMeta['opt-price'],
//                         'min_price' => $mapMeta['opt-price-min'],
//                         'max_price' => $mapMeta['opt-price-max'],
//                         'min_size' => $mapMeta['opt-size-min'],
//                         'max_size' => $mapMeta['opt-size-max'],
//                         'sales_type' => $mapMeta['opt-sales-type'],
//                         'min_bed' => $mapMeta['opt-min-bed'],
//                         'max_bed' => $mapMeta['opt-max-bed'],
//                         'min_bath' => $mapMeta['opt-min-bath'],
//                         'max_bath' => $mapMeta['opt-max-bath'],
//                         'type' => $mapMetaType,
//                         'min_price_sqft' => $mapMeta['opt-min-price-sqft'],
//                         'max_price_sqft' => $mapMeta['opt-max-price-sqft'],
//                         'sqft_avg' => $mapMeta['opt-sqft-avg'],
//                         'occupancy' => $mapMeta['opt-occupancy'],
//                         'coming_soon' => $mapMeta['opt-coming-soon'],
//                         'comission_by_percent' => $mapMeta['opt-comission-by-percent'],
//                         'comission_by_flatfee' => $mapMeta['opt-comission-by-flatfee'],
//                         'floorplans' => [],
//                         'city' => $mapMeta['opt-city'],
//                         'studio' => $mapMeta['opt-studio'],
//                         'status' => $mapMeta['opt-status'],
//                         'coords' => [$mapMeta['opt-coords']['longitude'], $mapMeta['opt-coords']['latitude']],
//                     ];
//                 }
//             }

//         endwhile;
//         wp_reset_postdata();
//     else :
//         _e('Sorry, no posts matched your criteria.');
//     endif;

//     return $mapdata;
// }
// add_action('rest_api_init', function () {
//     register_rest_route('mapdata/v2', '/getResult', array(
//         'methods' => 'GET',
//         'callback' => 'my_awesome_func_two',
//     ));
// });


// کشینگ کوئری‌های دیتابیس
function simple_cache_db_query($query) {
    global $wpdb;
    $cache_key = 'db_query_' . md5($query);
    $result = wp_cache_get($cache_key);
    if ($result === false) {
        $result = $wpdb->get_results($query);
        wp_cache_set($cache_key, $result);
    }
    return $result;
}

// حذف کش دیتابیس بعد از آپدیت، ایجاد یا حذف پست
function simple_cache_flush_db() {
    global $wpdb;
    wp_cache_flush();
}

// ثبت اعمال کشینگ
add_filter('query', 'simple_cache_db_query');
// add_action('save_post', 'simple_cache_flush_db');
// add_action('delete_post', 'simple_cache_flush_db');
