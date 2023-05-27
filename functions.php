<?php

if (!defined('ABSPATH')) {
    exit;
}


include 'constant.php';
include HLR_THEME_PATH . 'inc/match_elementor.php';
include HLR_THEME_PATH . '/lib/vendor/autoload.php';
include HLR_THEME_PATH . 'lib/codestar/codestar-framework.php';
include HLR_THEME_PATH . 'lib/view-module/view.php';
include HLR_THEME_PATH . 'options.php';
include HLR_THEME_PATH . 'inc/init.php';
include HLR_THEME_PATH . 'inc/helper.php';
include HLR_THEME_PATH . 'inc/scripts.php';
include HLR_THEME_PATH . 'inc/ajax.php';
include HLR_THEME_PATH . 'inc/shortcodes.php';
include HLR_THEME_PATH . 'inc/post_types.php';
include HLR_THEME_PATH . 'inc/taxonomy.php';
include HLR_THEME_PATH . 'inc/visit_history.php';
include_once(ABSPATH . '/wp-admin/includes/image.php');

$request = wp_remote_get('http://panel.hlric.com/wp-json/mapdata/v2/getResult');
$data = wp_remote_retrieve_body($request);
$body = json_decode($data, true);
$i = 0;
foreach ($body as $item) {
    if($i > 1){
        exit();
    }
    if ($i == 0) {
        $post_id = newPost($item['thumbnail'], $item['title'], 'test', 'test');
        var_dump($post_id);
        $mapMeta['opt-available-floorplans'] = $item['available_floorplans'];
        $mapMeta['opt-address'] = $item['address'];
        $mapMeta['opt-pricepersqft'] = $item['pricepersqft'];
        $mapMeta['opt-incentives'] = $item['terms'];
        $mapMeta['opt-price'] = $item['price'];
        $mapMeta['opt-price-min'] = $item['min_price'];
        $mapMeta['opt-price-max'] = $item['max_price'];
        $mapMeta['opt-size-min'] = $item['min_size'];
        $mapMeta['opt-size-max'] = $item['max_size'];
        $mapMeta['opt-sales-type'] = $item['sales_type'];
        $mapMeta['opt-min-bed'] = $item['min_bed'];
        $mapMeta['opt-max-bed'] = $item['max_bed'];
        $mapMeta['opt-min-bath'] = $item['min_bath'];
        $mapMeta['opt-max-bath'] = $item['max_bath'];
        $mapMeta['opt-type'] = $item['type'];
        $mapMeta['opt-min-price-sqft'] = $item['min_price_sqft'];
        $mapMeta['opt-max-price-sqft'] = $item['max_price_sqft'];
        $mapMeta['opt-sqft-avg'] = $item['sqft_avg'];
        $mapMeta['opt-occupancy'] = $item['occupancy'];
        $mapMeta['opt-coming-soon'] = $item['coming_soon'];
        $mapMeta['opt-comission-by-percent'] = $item['comission_by_percent'];
        $mapMeta['opt-comission-by-flatfee'] = $item['comission_by_flatfee'];
        $mapMeta['opt-city'] = $item['city'];
        $mapMeta['opt-studio'] = $item['studio'];
        $mapMeta['opt-status'] = $item['status'];
        $mapMeta['opt-coords'] = $item['coords'];
        update_post_meta($post_id, 'hlr_framework_map', $mapMeta);
    }
    $i++;
}
wp_die();

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



function newPost($imageurl = null, $title, $excerpt, $content)
{

    if ($imageurl) {

        $imagetype = end(explode('/', getimagesize($imageurl)['mime']));
        $uniq_name = date('dmY') . '' . (int) microtime(true);
        $filename = $uniq_name . '.' . $imagetype;

        $uploaddir = wp_upload_dir();
        $uploadfile = $uploaddir['path'] . '/' . $filename;
        $contents = file_get_contents($imageurl);
        $savefile = fopen($uploadfile, 'w');
        fwrite($savefile, $contents);
        fclose($savefile);

        $wp_filetype = wp_check_filetype(basename($filename), null);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => $filename,
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $uploadfile);
        $imagenew = get_post($attach_id);
        $fullsizepath = get_attached_file($imagenew->ID);
        $attach_data = wp_generate_attachment_metadata($attach_id, $fullsizepath);
        wp_update_attachment_metadata($attach_id, $attach_data);
    }

    $new_post = array(
        'post_title' => $title,
        'post_excerpt' => $excerpt,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_date' => date('Y-m-d H:i:s'),
        'post_author' => 1,
        'post_type' => 'properties'
    );

    $post_id = wp_insert_post($new_post);

    if ($imageurl) {
        set_post_thumbnail($post_id, $attach_id);
    }

    return $post_id;
}
