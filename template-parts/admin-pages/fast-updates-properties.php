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
                    <th>test</th>
                    <th>test</th>
                    <th>test</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($peroperties->have_posts()) : $peroperties->the_post(); ?>

                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
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