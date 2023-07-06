<?php

add_action('wp_ajax_nopriv_getlatestpost', 'getlatestpost');
add_action('wp_ajax_getlatestpost', 'getlatestpost');
function getlatestpost()
{
    $args = array(
        'post_type' => ['post'],
        'post_status' => ['publish'],
        'posts_per_page' => 10,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
?>

            <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>" target="_blank" class="card-post-sidebar mb-2">
                <div class="card-post-sidebar-image">
                    <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                </div>
                <div class="card-post-sidebar-content">
                    <div class="card-post-sidebar-title">
                        <?= strlen(get_the_title())  > 30 ? substr(get_the_title(), 0, 30) . '...' : get_the_title() ?>
                    </div>
                    <div class="wrap-card-post-sidebar-meta">
                        <div class="card-post-sidebar-meta">
                            <i class="fa fa-eye"></i>
                            <span><?= getView(get_the_ID()) ?></span>
                        </div>
                        <div class="card-post-sidebar-meta">
                            <i class="fa fa-calendar"></i>
                            <span><?= get_the_date() ?></span>
                        </div>
                    </div>
                </div>
            </a>

        <?php
        endwhile;
    endif;
    exit();
}

add_action('wp_ajax_nopriv_getpopularpost', 'getpopularpost');
add_action('wp_ajax_getpopularpost', 'getpopularpost');
function getpopularpost()
{
    $args = array(
        'post_type' => ['post'],
        'post_status' => ['publish'],
        'posts_per_page' => 10,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $posts[] = [
                'link' => get_the_permalink(),
                'image' => get_the_post_thumbnail(),
                'title' => get_the_title(),
                'date' => get_the_date(),
                'view' => getView(get_the_ID()),
            ];
        endwhile;
    endif;


    array_multisort(array_column($posts, 'view'), SORT_DESC, $posts);


    foreach ($posts as $post) :
        ?>

        <a href="<?= $post['link'] ?>" title="<?= $post['title'] ?>" target="_blank" class="card-post-sidebar mb-2">
            <div class="card-post-sidebar-image">
                <?= $post['image'] ?>
            </div>
            <div class="card-post-sidebar-content">
                <div class="card-post-sidebar-title">
                    <?= strlen($post['title'])  > 30 ? substr($post['title'], 0, 30) . '...' : $post['title'] ?>
                </div>
                <div class="wrap-card-post-sidebar-meta">
                    <div class="card-post-sidebar-meta">
                        <i class="fa fa-eye"></i>
                        <span><?= $post['view'] ?></span>
                    </div>
                    <div class="card-post-sidebar-meta">
                        <i class="fa fa-calendar"></i>
                        <span><?= $post['date'] ?></span>
                    </div>
                </div>
            </div>
        </a>

        <?php
    endforeach;
    exit();
}

add_action('wp_ajax_nopriv_propertiesFavorites', 'propertiesFavorites');
add_action('wp_ajax_propertiesFavorites', 'propertiesFavorites');
function propertiesFavorites()
{
    if (!is_user_logged_in()) {
        wp_send_json([
            'status' => 'notLogin'
        ]);
    }


    $favorites = get_user_meta(get_current_user_id(), 'properties_favorites', true);



    if (!empty($favorites)) {
        if (in_array($_POST['post_id'], $favorites)) {
            if (($key = array_search($_POST['post_id'], $favorites)) !== false) {
                unset($favorites[$key]);
            }
            update_user_meta(get_current_user_id(), 'properties_favorites', $favorites);

            wp_send_json([
                'status' => 'removed'
            ]);
        } else {
            $favorites = $_POST['post_id'];
        }
    } else {
        $favorites = [];
        $favorites[] = $_POST['post_id'];
    }

    update_user_meta(get_current_user_id(), 'properties_favorites', $favorites);

    wp_send_json([
        'status' => 'added'
    ]);
}

add_action('wp_ajax_nopriv_propertiesRating', 'propertiesRating');
add_action('wp_ajax_propertiesRating', 'propertiesRating');
function propertiesRating()
{
    if (!is_user_logged_in()) {
        wp_send_json([
            'status' => 'notLogin'
        ]);
    }

    $property_id = get_user_meta(get_current_user_id(), 'properties_rated', true);
    if ($property_id == $_POST['post_id']) {
        wp_send_json([
            'status' => 'exists',
        ]);
    }

    $total_rates = get_post_meta($_POST['post_id'], 'properties_total_rates', true);
    $user_rates = get_post_meta($_POST['post_id'], 'properties_user_rates', true);

    if (!empty($total_rates) && !empty($user_rates)) {
        $total_rates = $total_rates + $_POST['rate'];
        $user_rates = $user_rates + 1;
        update_post_meta($_POST['post_id'], 'properties_total_rates', $total_rates);
        update_post_meta($_POST['post_id'], 'properties_user_rates', $user_rates);
        update_user_meta(get_current_user_id(), 'properties_rated', $_POST['post_id']);
    } else {
        $total_rates = $_POST['rate'];
        $user_rates = 1;
        update_post_meta($_POST['post_id'], 'properties_total_rates', $total_rates);
        update_post_meta($_POST['post_id'], 'properties_user_rates', $user_rates);
        update_user_meta(get_current_user_id(), 'properties_rated', $_POST['post_id']);
    }

    wp_send_json([
        'status' => 'added',
        'votes' => $user_rates
    ]);
}

add_action('wp_ajax_set_like_properties', 'set_like_properties');
add_action('wp_ajax_nopriv_set_like_properties', 'set_like_properties');
function set_like_properties()
{


    if (!isset($_COOKIE[$_POST['properties_id']])) {
        setcookie(
            $_POST['properties_id'],
            "isset",
            time() + (10 * 365 * 24 * 60 * 60),
            '/',
            $_SERVER['HTTP_HOST']
        );
        if (!empty(get_post_meta($_POST['properties_id'], 'total_like', true))) {
            $total_like = (int)get_post_meta($_POST['properties_id'], 'total_like', true) + 1;
        } else {
            $total_like = 1;
        }
        update_post_meta($_POST['properties_id'], 'total_like', $total_like);
        wp_send_json([
            "total" => get_post_meta($_POST['properties_id'], 'total_like', true),
            "status" => "set"
        ]);
    } else {
        $total_like = (int)get_post_meta($_POST['properties_id'], 'total_like', true) - 1;
        update_post_meta($_POST['properties_id'], 'total_like', $total_like);
        unset($_COOKIE[$_POST['properties_id']]);
        setcookie(
            $_POST['properties_id'],
            null,
            -1,
            '/',
            $_SERVER['HTTP_HOST']
        );
        wp_send_json([
            "total" => get_post_meta($_POST['properties_id'], 'total_like', true),
            "status" => "unset"
        ]);
    }
}

add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');
function ajax_login()
{

    check_ajax_referer('ajax-login-nonce', 'security');

    if (empty($_POST['username']) or empty($_POST['password'])) {
        wp_send_json([
            'loggedin' => false,
            'message' => 'Please fill in all fields.'
        ]);
    }

    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon($info, false);

    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
    } else {
        $userID = $user_signon->ID;
        wp_clear_auth_cookie();
        wp_set_current_user($userID, $info['user_login']);
        wp_set_auth_cookie($userID);
        $user_meta = get_userdata($userID);
        $user_roles = $user_meta->roles;
        if (in_array('administrator', $user_roles)) {
            $url = home_url('wp-admin');
        } else {
            $url = home_url('panel');
        }
        echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...'), 'url' => $url));
    }
    exit();
}

add_action('wp_ajax_nopriv_ajax_register', 'ajax_register');
function ajax_register()
{

    check_ajax_referer('ajax-login-nonce', 'security');

    if (empty($_POST['username']) or empty($_POST['email']) or empty($_POST['password'])) {
        wp_send_json([
            'status' => false,
            'message' => 'Please fill in all fields.'
        ]);
    }

    include ABSPATH . 'wp-load.php';

    if (email_exists($_POST['email']) and username_exists($_POST['username'])) {
        wp_send_json([
            'status' => false,
            'message' => 'This email and username already exists.'
        ]);
    } elseif (email_exists($_POST['email'])) {
        wp_send_json([
            'status' => false,
            'message' => 'This email already exists.'
        ]);
    } elseif (username_exists($_POST['username'])) {
        wp_send_json([
            'status' => false,
            'message' => 'This username already exists.'
        ]);
    }


    if (!is_email($_POST['email'])) {
        wp_send_json([
            'status' => false,
            'message' => 'The email is not valid.'
        ]);
    }




    $user = [];
    $user['user_login'] = sanitize_user($_POST['username']);
    $user['user_email'] = sanitize_email($_POST['email']);
    $user['user_pass']  = sanitize_text_field($_POST['password']);
    $user['show_admin_bar_front ']  = false;
    $user_register = wp_insert_user($user);


    wp_clear_auth_cookie();
    wp_set_current_user($user_register, $info['user_login']);
    wp_set_auth_cookie($user_register);

    if ($user_register) {
        wp_send_json([
            'status' => true,
            'message' => 'Register successful, redirecting...',
            'url' => home_url('panel')
        ]);
    }
}

add_action('wp_ajax_nopriv_ajax_forgot_password', 'ajax_forgot_password');
function ajax_forgot_password()
{

    check_ajax_referer('ajax-login-nonce', 'security');

    global $wpdb;

    $account = $_POST['username'];

    if (empty($account)) {
        $error = 'Enter an username or email address.';
    } else {
        if (is_email($account)) {
            if (email_exists($account))
                $get_by = 'email';
            else
                $error = 'There is no user registered with that email address.';
        } else if (validate_username($account)) {
            if (username_exists($account))
                $get_by = 'login';
            else
                $error = 'There is no user registered with that username.';
        } else
            $error = 'Invalid username or e-mail address.';
    }

    if (empty($error)) {

        $random_password = wp_generate_password();

        $user = get_user_by($get_by, $account);

        $from = 'wordpress@hlrtest.hlric.com';

        $to = $user->user_email;
        $subject = 'Your new password';
        $sender = 'From: ' . get_option('name') . ' <' . $from . '>' . "\r\n";

        $message = 'Your new password is: ' . $random_password;

        $headers[] = 'MIME-Version: 1.0' . "\r\n";
        $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers[] = "X-Mailer: PHP \r\n";
        $headers[] = $sender;

        $mail = wp_mail($to, $subject, $message, $headers);

        if ($mail) {
            wp_update_user(array('ID' => $user->ID, 'user_pass' => $random_password));
            $success = 'Check your email address for you new password.(Check the spam folder)';
        } else {
            $error = 'System is unable to send you mail containg your new password.';
        }
    }

    if (!empty($error))
        echo json_encode(array('loggedin' => false, 'message' => __($error)));

    if (!empty($success))
        echo json_encode(array('loggedin' => true, 'message' => __($success)));

    die();
}

add_action('wp_ajax_hlr_search', 'hlr_search');
add_action('wp_ajax_nopriv_hlr_search', 'hlr_search');
function hlr_search()
{
    $the_query = new WP_Query(array('posts_per_page' => -1, 's' => esc_attr($_POST['keyword']), 'post_type' => array('post', 'properties')));
    if ($the_query->have_posts()) :
        $i = 0;
        $j = 0;
        while ($the_query->have_posts()) : $the_query->the_post(); ?>

            <?php if (get_post_type() == 'post') : ?>
                <?php if ($i == 0) : ?>
                    <h4 class="info-title">Posts</h4>
                <?php endif; ?>
                <div class="result-card mt-1 mb-2 px-3">
                    <a href="<?php echo esc_url(post_permalink()); ?>" class="card-result-label">
                        <?php the_title(); ?>
                    </a>
                </div>
                <?php $i++ ?>
            <?php endif; ?>

            <?php if (get_post_type() == 'properties') : ?>
                <?php if ($j == 0) : ?>
                    <h4 class="info-title">Properties</h4>
                <?php endif; ?>
                <div class="result-card mt-1 mb-2 px-3">
                    <a href="<?php echo esc_url(post_permalink()); ?>" class="card-result-label">
                        <?php the_title(); ?>
                    </a>
                </div>
                <?php $j++ ?>
            <?php endif; ?>

        <?php endwhile;
        wp_reset_postdata();
    else :
        ?>
        <h4 class="info-title">No results</h4>
        <div class="result-card mt-1 mb-2 py-1 px-3">
            <a class="card-result-label" style="text-align: center;">
                No results found for Properties and Posts!
            </a>
        </div>
<?php
    endif;

    die();
}



// Rest Api
add_action('rest_api_init', 'create_routes');
function create_routes()
{
    register_rest_route('v1', 'get-properties', [
        'methods' => 'GET',
        'callback' => 'getProperties'
    ]);
}
function getProperties(WP_REST_Request $request)
{

    $auth_user = checkToken();
    $is_login = false;
    if (!$auth_user->status == 401 && !$auth_user->status == 404) {
        $is_login = true;
    }


    $arg = [
        'post_type' => 'properties',
        'post_status' => 'publish',
        'posts_per_page' => 8,
        'tax_query' => [
            [
                'taxonomy' => 'group',
                'field' => 'term_id',
                'terms' => 19,
            ]
        ]
    ];

    $peroperties = new WP_Query($arg);

    while ($peroperties->have_posts()) {
        $peroperties->the_post();
        if ($is_login) {
            if (in_array(get_the_ID(), get_user_meta($auth_user->data['id'], 'properties_favorites', true))) {
                $bookColor = '#9de450';
            } else {
                $bookColor = '';
            }
        } else {
            $bookColor = '';
        }
        $items[] = [
            'post' => $peroperties->post,
            'url_image' => get_the_post_thumbnail_url(),
            'metadata' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true),
            'total_like' => get_post_meta(get_the_ID(), 'total_like', true),
            'bookColor' => $bookColor
        ];
        // $peroperties->the_post();
        // $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
    }

    return new WP_REST_Response([
        'list' => $items
    ], 200);
}
