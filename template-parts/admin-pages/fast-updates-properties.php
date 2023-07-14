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
    #table_length,
    #table_filter {
        margin-bottom: 20px;
    }

    #table_length{
        display: none;
    }

    .wrap-button {
        margin-bottom: 20px;
    }
</style>
<form action="" method="post">
    <div class="wrap">
        <h1><?= $title ?></h1><br>
        <div class="wrap-button">
            <button name="btn-set" type="submit" class="button button-primary">Update</button>
        </div>
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
                            <input type="hidden" name="ids[]" value="<?= get_the_ID() ?>">
                            <td><?php the_title() ?></td>
                            <td><input <?= $meta['opt-project-status'] ? 'checked' : '' ?> type="checkbox" name="opt-project-status[]"></td>
                            <td><input type="text" value="<?= $meta['opt-price'] ?>" name="opt-price[]"></td>
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
            <button name="btn-set" type="submit" class="button button-primary">Update</button>
        </div>
    </div>
</form>

<?php

if(isset($_POST['btn-set'])){
    wp_die(var_dump($_POST));
}

?>


<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    dataTable = jQuery("#table").DataTable({
        pageLength: 10,
    });
</script>