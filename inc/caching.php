<?php

function properties_related_cached()
{
    $post_id = get_the_ID();
    $cache_key = 'related_cached_' . $post_id;
    $results = get_transient($cache_key);

    if ($results === false) {
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

            set_transient($cache_key, $results, 10 * MINUTE_IN_SECONDS);
        } else {
            return false;
        }
    }

    return $results;
}
