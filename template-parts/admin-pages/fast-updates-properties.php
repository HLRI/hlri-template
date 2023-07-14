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
    <?php if ($peroperties_single->have_posts()) : ?>
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th>test</th>
                    <th>test</th>
                    <th>test</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>