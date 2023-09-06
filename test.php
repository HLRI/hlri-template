<?php
date_default_timezone_set('America/New_York');

include('../wp-load.php');
include_once(ABSPATH . '/wp-admin/includes/image.php');
include ABSPATH . '/wp-content/themes/homeleaderrealty/lib/codestar/codestar-framework.php';


$api_url = 'https://locatecondo.com/api/';
$curl = curl_init($api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer YourAccessToken',
]);
$response = curl_exec($curl);
if ($response === false) {
    die('cURL Error: ' . curl_error($curl));
}
curl_close($curl);
$data = json_decode($response, true);
if ($data === null) {
    die('JSON Decode Error: ' . json_last_error_msg());
}

$ids = [9483, 9485, 9487, 9489, 9491, 9493, 9495, 9497, 9499, 9416, 9418, 9420, 9422, 9424, 9426, 9428, 9430, 9432, 9434, 9436, 9438, 9440, 9442, 9444, 9446, 9448, 9450, 9452, 9456, 9457, 9374, 9376,  9382, 9384, 9386, 9388, 9390, 9392, 9394, 9396, 9398, 9400, 9402];

foreach ($data as $key => $item) {

    $posts = get_posts([
        'post_type'  => 'properties',
        'title' => trim($item['title']),
    ]);

    if (!empty($posts)) {
        if (in_array($posts[0]->ID, $ids)) {
            if ($item['thumbnail']) {
                $imageurl = $item['thumbnail'];
                $imagetype = end(explode('/', getimagesize($imageurl)['mime']));
                $uniq_name = date('dmY') . '' . (int) microtime(true);
                $filename = $uniq_name . '.' . $imagetype;
                $uploaddir = wp_upload_dir();
                $uploadfile = $uploaddir['path'] . '/' . $filename;
                $contents = file_get_contents($imageurl);
                $savefile = fopen($uploadfile, 'w');
                fwrite($savefile, $contents);
                fclose($savefile);

                $wp_filetype = wp_check_filetype(basename($filename), null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => $item['title'],
                    'post_content' => $item['title'],
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $uploadfile);
                $imagenew = get_post($attach_id);
                $fullsizepath = get_attached_file($imagenew->ID);
                $attach_data = array(
                    'width' => getimagesize($fullsizepath)[0],
                    'height' => getimagesize($fullsizepath)[1],
                    'file' => wp_basename($fullsizepath),
                    'sizes' => array(),
                    'image_meta' => wp_read_image_metadata($fullsizepath)
                );
                $attach_data['image_meta']['caption'] = $item['title'];
                update_post_meta($attach_id, '_wp_attachment_image_alt', $item['title']);
                wp_update_attachment_metadata($attach_id, $attach_data);
                set_post_thumbnail($posts[0]->ID, $attach_id);

                echo $item['title'] . ' | ' . $posts[0]->ID . '<br>';
            } else {
                echo 'no image ' . $item['title'] . ' | ' . $posts[0]->ID . '<br>';
            }
        }
    }
}


wp_die('end');
