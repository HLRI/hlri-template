<?php
/* Template Name: Archive Neighborhoods */
get_header();
?>

<div class="container my-5">
    <div class="row">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'taxonomy' => 'neighborhood',
            'hide_empty' => false,
            'paged' => $paged,
        );

        $neighborhoods_query = new WP_Query($args);

        if ($neighborhoods_query->have_posts()) :
            while ($neighborhoods_query->have_posts()) :
                $neighborhoods_query->the_post();
                $neighborhood = get_queried_object();
                $meta = get_term_meta($neighborhood->term_id, 'neighborhood_options', true);

                if (isset($meta['opt-neighborhood-image']) && !empty($meta['opt-neighborhood-image']['url'])) :
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card mb-4">
                            <a href="<?= get_term_link($neighborhood); ?>">
                                <img loading="lazy" src="<?= $meta['opt-neighborhood-image']['url'] ?>" class="card-img-top" alt="<?= isset($meta['opt-neighborhood-image']['alt']) ? $meta['opt-neighborhood-image']['alt'] : $neighborhood->name ?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?= $neighborhood->name ?></h5>
                                <a href="<?= get_term_link($neighborhood); ?>" class="btn btn-primary">Explore</a>
                            </div>
                        </div>
                    </div>
                <?php
                endif;
            endwhile;

            // Pagination
            echo '<div class="col-12">';
            echo paginate_links(array(
                'total' => $neighborhoods_query->max_num_pages,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            ));
            echo '</div>';

            wp_reset_postdata();
        else :
            echo '<div class="col-12"><p>No neighborhoods found.</p></div>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
