<?php
$args = array(
    'post_type' => 'properties',
    'post_status' => 'publish',
    'posts_per_page' => -1,

);
$peroperties = new WP_Query($args);
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<style>
    #table_length , #table_filter{
        margin-bottom: 20px;
    }
</style>
<div class="wrap">
    <h1><?= $title ?></h1><br>
    <?php if ($peroperties->have_posts()) : ?>
        <table style="margin-bottom: 20px;" class="wp-list-table widefat fixed striped table-view-list" id="table">
            <thead>
                <tr>
                    <th>Property Name</th>
                    <th>Close</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($peroperties->have_posts()) : $peroperties->the_post(); ?>
                    <?php $meta = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true); ?>
                    <tr>
                        <td><?php the_title() ?></td>
                        <td><input <?= $meta['opt-project-status'] ? 'checked' : '' ?> type="checkbox" name="" id=""></td>
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
    <div class="wrap-button">
        <button type="submit" class="button button-primary">Update</button>
    </div>
</div>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    dataTable = jQuery("#table").DataTable({
        "pageLength": 50
    });
</script>