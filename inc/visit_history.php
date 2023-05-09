<?php

add_action('template_redirect', 'run_visit_history');
function run_visit_history()
{
    $data = json_decode(stripslashes($_COOKIE['visit_history']), true);
    if (is_singular('properties')) {
        $data[] = [
            'type' => 'properties',
            'title' => get_the_title(),
            'url' => get_the_permalink(),
            'date' => date("Y M d")
        ];
        setcookie('visit_history', json_encode($data), time() + 2592000, '/');
    } elseif (is_singular('post')) {
        $data[] = [
            'type' => 'post',
            'title' => get_the_title(),
            'url' => get_the_permalink(),
            'date' => date("Y M d")
        ];
        setcookie('visit_history', json_encode($data), time() + 2592000, '/');
    } elseif (is_singular('agents')) {
        $data[] = [
            'type' => 'agents',
            'title' => get_the_title(),
            'url' => get_the_permalink(),
            'date' => date("Y M d")
        ];
        setcookie('visit_history', json_encode($data), time() + 2592000, '/');
    }
}
