<?php

$success = false;

if (isset($_POST['btn-set'])) {
    foreach ($_POST['data'] as $item) {
        $status = true;
        if (!isset($item['opt-project-status'])) {
            $status = false;
        }
        $meta = get_post_meta($item['id'], 'hlr_framework_mapdata', true);
        $meta['opt-project-status'] = $status;
        $meta['opt-price'] = strval($item['opt-price'],);
        update_post_meta($item['id'], 'hlr_framework_mapdata', $meta);
    }
    $success = true;
}



$args = array(
    'post_type' => 'properties',
    'post_status' => 'publish',
    'posts_per_page' => -1,

);
$peroperties = new WP_Query($args);
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<style>
    #table_length,
    #table_filter {
        margin-bottom: 20px;
    }

    #table_length,
    #table_info,
    #table_paginate {
        display: none;
    }

    .loading:before {
        content: 'wait! , Loading ...';
        background: #d3d3d300;
        z-index: 1;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 25px;
        color: #2271b1;
    }

    /* .wrap-button {
        margin-bottom: 20px;
    } */
</style>
<form action="" method="post">
    <div class="wrap loading">
        <h1><?= $title ?></h1><br>
        <?php if ($success) : ?>
            <div id="message" class="updated notice is-dismissible">
                <p>Data updated successfully</p>
            </div>
        <?php endif; ?>

        <div class="wrap-button">
            <button name="btn-set" type="submit" class="button button-primary">Update</button>
            <a download href="<?= HLR_THEME_URL . "template-parts/admin-pages/backup.json" ?>" class="button button-success">Download Backup</a>
        </div>
        <div style="color: red; font-weight: bold; font-size: 15px; padding: 6px 0;">Make sure to download the backup before making any changes!</div>

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
                        <?php
                        $meta = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                        $data_backup[] = $meta;
                        ?>
                        <tr>
                            <input type="hidden" name="data[<?= get_the_ID() ?>][id]" value="<?= get_the_ID() ?>">
                            <td><?php the_title() ?></td>
                            <td><input <?= $meta['opt-project-status'] ? 'checked' : '' ?> type="checkbox" name="data[<?= get_the_ID() ?>][opt-project-status]" value="true"></td>
                            <td><input type="text" value="<?= $meta['opt-price'] ?>" name="data[<?= get_the_ID() ?>][opt-price]"></td>
                        </tr>
                    <?php
                    endwhile;
                    $data = json_encode($data_backup);
                    $file = fopen(HLR_THEME_PATH . "template-parts/admin-pages/backup.json", "w") or die("Unable to open file!");
                    fwrite($file, $data);
                    fclose($file);
                    wp_reset_postdata();
                    wp_reset_query();
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
        <div class="wrap-button">
            <button name="btn-set" type="submit" class="button button-primary">Update</button>
        </div>
    </div>
</form>




<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    dataTable = jQuery("#table").DataTable({
        pageLength: 10,
    }).draw();

    jQuery(document).ready(function(){
        jQuery('.wrap').removeClass('loading');
    });
</script>