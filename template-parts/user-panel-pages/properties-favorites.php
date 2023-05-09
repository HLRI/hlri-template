<?php

if (empty(get_user_meta(get_current_user_id(), 'propertoes_favorites', true))) {
    $post_ids = -1;
} else {
    $post_ids = get_user_meta(get_current_user_id(), 'propertoes_favorites', true);
}
// dd(get_user_meta(get_current_user_id(), 'propertoes_favorites', true));
$arg = [
    'post_type' => 'properties',
    'author' => get_current_user_id(),
    'post_status' => 'publish',
    'post__in' => $post_ids,
    'posts_per_page' => 12
];

$peroperties = new WP_Query($arg);

?>
<div class="row">

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-warning text-white me-2">
                <i class="mdi mdi-bookmark"></i>
            </span> Favorite Properties
        </h3>
    </div>
    <?php if ($peroperties->have_posts()) : ?>

        <?php while ($peroperties->have_posts()) : $peroperties->the_post(); ?>
            <div class="col-lg-4 mb-3">
                <div class="card-listing">
                    <div class="card-listing-image">
                        <?php the_post_thumbnail() ?>
                    </div>
                    <div class="card-listing-content">
                        <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                        <div class="card-listing-description">
                            <?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
                        </div>
                        <div class="card-listing-options">
                            <i class="mdi mdi-heart"></i>
                            <i class="mdi mdi-share"></i>
                            <i <?= in_array(get_the_ID(), get_user_meta(get_current_user_id(), 'propertoes_favorites', true)) ? ' style="color:#9de450" ' : '' ?> role="button" onclick="bookmark(this,<?= get_the_ID() ?>)" class="mdi mdi-bookmark"></i>
                        </div>
                    </div>
                    <a target="_blank" href="<?= get_the_permalink() ?>" title="<?php the_title() ?>" class="more">more</a>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</div>