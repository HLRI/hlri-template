<?php

$imageurl = $floorplan['fullimage'];
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
    'post_title' => $filename,
    'post_content' => '',
    'post_status' => 'inherit'
);

$attach_id = wp_insert_attachment($attachment, $uploadfile);
$imagenew = get_post($attach_id);
$fullsizepath = get_attached_file($imagenew->ID);

// Generate attachment metadata only for the full-size image
$attach_data = array(
    'width' => getimagesize($fullsizepath)[0],
    'height' => getimagesize($fullsizepath)[1],
    'file' => wp_basename($fullsizepath),
    'sizes' => array(),
    'image_meta' => wp_read_image_metadata($fullsizepath)
);

wp_update_attachment_metadata($attach_id, $attach_data);
