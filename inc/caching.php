<?php

function properties_related_cached()
{
    $post_id = get_the_ID();
    $cache_key = 'properties_related_cached_' . $post_id;
    $results = get_transient($cache_key);

    if (false) {
        $terms = get_the_terms($post_id, array('stage', 'type', 'city', 'neighborhood', 'group'));
        if (!empty($terms)) {
            $term_ids = array();

            foreach ($terms as $item) {
                $term_ids[] = $item->term_id;
            }

            $args = array(
                'post_type' => ['properties'],
                'post_status' => ['publish'],
                'posts_per_page' => 6,
                'post__not_in' => [$post_id],
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'stage',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    ),
                    array(
                        'taxonomy' => 'type',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    ),
                    array(
                        'taxonomy' => 'city',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    ),
                    array(
                        'taxonomy' => 'neighborhood',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    ),
                    array(
                        'taxonomy' => 'group',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    )
                ),
            );

            $results = new WP_Query($args);

            set_transient($cache_key, $results, 1 * MINUTE_IN_SECONDS);
        } else {
            return false;
        }
    }

    return $results;
}

function properties_single_cached()
{
    wp_die('results');

    $post_id = get_the_ID();
    $cache_key = 'properties_single_cached_' . $post_id;

    $results = get_transient($cache_key);


    if (false) {
        $theme_options = get_option('hlr_framework');
        $galleries = get_post_meta($post_id, 'hlr_framework_properties', true);
        $floorplans = get_post_meta($post_id, 'hlr_framework_properties-floorplan', true);
        if (!empty($galleries['opt-gallery-properties'])) {
            $gallery_ids = explode(',', $galleries['opt-gallery-properties']);
        } else {
            $gallery_ids = [];
        }
        
        // $floorplans_ids = explode(',', $floorplans['opt-gallery-properties-floorplan']);
        if (!empty(get_post_meta($post_id, 'hlr_framework_properties-incentives', true))) {
            $incentives = @get_post_meta($post_id, 'hlr_framework_properties-incentives', true)['opt_properties_incentives_items'];
        } else {
            $incentives = [];
        }
        if (!empty(get_post_meta($post_id, 'hlr_framework_properties-video', true))) {
            $videos = @get_post_meta($post_id, 'hlr_framework_properties-video', true)['opt_properties_video_items'];
        } else {
            $videos = [];
        }
        if (!empty(get_post_meta($post_id, 'hlr_framework_properties_development_details', true))) {
            $developments = @get_post_meta($post_id, 'hlr_framework_properties_development_details', true)['opt_properties_development_details_items'];
        } else {
            $developments = [];
        }
        if (!empty(get_post_meta($post_id, 'hlr_framework_properties_price_list', true))) {
            $price_images = @get_post_meta($post_id, 'hlr_framework_properties_price_list', true)['opt_properties_price_list_items'];
        } else {
            $price_images = [];
        }
        $total_rates = get_post_meta($post_id, 'properties_total_rates', true);
        $user_rates = get_post_meta($post_id, 'properties_user_rates', true);
        if (!empty($user_rates)) {
            $rates = round($total_rates / $user_rates);
        } else {
            $rates = '';
        }
        $properties_rated_id = get_user_meta(get_current_user_id(), 'properties_rated', true);
        $mdata_single = get_post_meta($post_id, 'hlr_framework_mapdata', true);

        $galleries_data = [];
        $incentives_data = [];

        foreach ($gallery_ids as $gallery_item_id) {
            $galleries_data[] = [
                'gallery_url' => wp_get_attachment_url($gallery_item_id),
                'caption' => wp_get_attachment_caption($gallery_item_id)
            ];
        }

        if (!empty($incentives)) {
            foreach ($incentives as $item) {
                $incentives_data[] = [
                    'opt_icon_incentives' => $item['opt-icon-incentives'],
                    'opt_link_incentives' => $item['opt-link-incentives'],
                ];
            }
        }

        if(isset($mdata_single['opt-project-status'])){
            $project_status = $mdata_single['opt-project-status'];
        }else{
            $project_status = false;
        }

        $results = [
            'title' => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'content' => get_the_content(),
            'shortlink' => wp_get_shortlink($post_id, 'post', true),
            'thumbnail_url' => get_the_post_thumbnail_url(),
            'thumbnail_caption' => get_the_post_thumbnail_caption(),
            'modified_date' => get_the_modified_date('j F Y'),
            'properties_rated_id' => $properties_rated_id,
            'rates' => $rates,
            'user_rates' => $user_rates,
            'opt_price_min' => $mdata_single['opt-price-min'],
            'opt_project_status' => $project_status,
            'price_images' => $price_images,
            'galleries' => $galleries_data,
            'incentives_data' => $incentives_data,
            'videos' => $videos,
            'developments' => $developments,
            'theme_options' => $theme_options,
        ];

        wp_die($results);

        set_transient($cache_key, $results, 1 * MINUTE_IN_SECONDS);
    }

    return $results;
}

function associated_floorplans_cached()
{
    $post_id = get_the_ID();
    $cache_key = 'associated_floorplans_cached_' . $post_id;

    $results = get_transient($cache_key);

    if (false) {
        $args = array(
            'post_type' => 'floorplans',
            'numberposts' => -1,
            'orderby'   => 'meta_value',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'associated_property',
                    'value' => get_the_ID(),
                    'compare' => '='
                )
            )
        );

        $results = new WP_Query($args);
        $results = set_transient($cache_key, $results, 1 * MINUTE_IN_SECONDS);

    }

    return $results;
}
