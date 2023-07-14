<?php
$args = array(
    'post_type' => 'properties',
    'post_status' => 'publish',
    'posts_per_page' => -1,

);
$peroperties = new WP_Query($args);
?>

<div class="wrap">
    <h1><?= $title ?></h1>
    <?php if ($peroperties->have_posts()) : ?>
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th>Property Name</th>
                    <th>Close</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($peroperties->have_posts()) : $peroperties->the_post(); ?>
                <?php $meta = get_post_meta(get_the_ID(), 'hlr_framework_mapdata' ,true); ?>
                    <tr>
                        <td><?php the_title() ?></td>
                        <td><input type="checkbox" name="" id=""></td>
                        <td><input type="text" value="<?= $meta['opt-price'] ?>"></td>
                    </tr>
                <?php
                endwhile;
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>