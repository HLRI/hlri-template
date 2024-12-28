<?php if (isset($_GET['success']) && $_GET['success'] === 'floorplans_updated') : ?>
    <div id="message" class="updated notice is-dismissible">
        <p>All floorplans for this property have been marked as Sold Out.</p>
    </div>
<?php endif; ?>

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

    .loading {
        display: none !important;
    }

    /* .wrap-button {
        margin-bottom: 20px;
    } */
</style>




<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    dataTable = jQuery("#table").DataTable({
        pageLength: 10,
    }).draw();

    jQuery(document).ready(function(){
        setTimeout(() => {
            jQuery('.loading').removeClass('loading');
        }, 1000);
    });
</script>