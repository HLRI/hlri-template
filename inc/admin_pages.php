<?php

add_action('admin_menu', 'add_admin_menu');
function add_admin_menu()
{
    add_submenu_page('edit.php?post_type=properties', 'Fast Update', 'Fast Update', 'manage_options', 'fast-update-properties', 'page_view_fast_update');
}

function page_view_fast_update()
{
    global $title;
?>
    <div class="wrap">
        <h1><?= $title ?></h1>
    </div>
<?php
}
