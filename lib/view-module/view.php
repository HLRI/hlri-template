<?php

function runViewer()
{

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }

    $db_viewer = get_post_meta(get_the_ID(), 'viewer',  true);
    if (empty($db_viewer)) {
        $viewer[] = [
            'user_ip' => $ip_address,
            'viewer' => 1,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        ];
        update_post_meta(get_the_ID(), 'viewer',  $viewer);
    } else {
        collect($db_viewer)->each(function ($item) use ($ip_address) {
            if ($item['user_ip'] != $ip_address) {
                array_push($db_viewer, [
                    'user_ip' => $ip_address,
                    'viewer' => 1,
                    'date' => date('Y-m-d'),
                    'time' => date('H:i:s'),
                ]);
                update_post_meta(get_the_ID(), 'viewer',  $db_viewer);
            }
        });
    }

    $db_view = get_post_meta(get_the_ID(), 'view',  true);
    if (empty($db_view)) {
        $view[] = [
            'view' => 1,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        ];
        update_post_meta(get_the_ID(), 'view',  $view);
    } else {
        array_push($db_view, [
            'view' => 1,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        ]);
        update_post_meta(get_the_ID(), 'view',  $db_view);
    }
}


function getView($post_id)
{
    $views = get_post_meta($post_id, 'view',  true);
    $view = collect($views)->sum('view');
    return $view;
}
