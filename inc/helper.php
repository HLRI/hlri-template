<?php

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}


add_action('wp_logout', 'auto_redirect_after_logout');
function auto_redirect_after_logout()
{
    wp_safe_redirect(home_url());
    exit;
}




function google_oauth_callback()
{
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $client_id = '29063085453-oqs8hiqdj5jghb7qv6kfs8igapli92vg.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = urlencode(home_url('/wp-login.php?action=google_oauth_callback', 'https'));
        $url = "https://accounts.google.com/o/oauth2/token";
        $params = "code={$code}&client_id={$client_id}&client_secret={$client_secret}&redirect_uri={$redirect_uri}&grant_type=authorization_code";
        $response = wp_remote_post($url, array(
            'method' => 'POST',
            'body' => $params,
        ));
        if (is_wp_error($response)) {
            wp_die('Google OAuth2 token retrieval failed.');
        } else {
            $token_response = json_decode(wp_remote_retrieve_body($response));
            $access_token = $token_response->access_token;
            $url = "https://www.googleapis.com/oauth2/v1/userinfo?access_token={$access_token}";
            $user_info = json_decode(wp_remote_retrieve_body(wp_remote_get($url)));
            if (isset($user_info->email)) {
                $user = get_user_by('email', $user_info->email);
                if ($user) {
                    wp_set_auth_cookie($user->ID, true);
                    wp_redirect(home_url());
                    exit;
                }
            }
        }
    }
}
add_action('login_init', 'google_oauth_callback');



add_action('login_hlri_form', 'sign_in_with_microsoft', 10, 1);

function sign_in_with_microsoft($input = '')
{
?>
    <!-- For details visit https://docs.wpo365.com/article/74-add-sign-in-with-microsoft-button-to-a-wordpress-login-form -->
    <div>
        <style>
            .wpo365-mssignin-wrapper {
                box-sizing: border-box;
                display: block;
                width: 100%;
                padding: 12px 12px 24px 12px;
                text-align: center;
            }

            .wpo365-mssignin-spacearound {
                display: inline-block;
            }

            .wpo365-mssignin-wrapper form {
                display: none;
            }

            .wpo365-mssignin-button {
                border: 1px solid #8c8c8c;
                background: #ffffff;
                display: flex;
                display: -webkit-box;
                display: -moz-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                -webkit-box-align: center;
                -moz-box-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
                -webkit-box-pack: center;
                -moz-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                cursor: pointer;
                max-height: 41px;
                min-height: 41px;
                height: 41px;
            }

            .wpo365-mssignin-logo {
                padding-left: 12px;
                padding-right: 6px;
                -webkit-flex-shrink: 1;
                -moz-flex-shrink: 1;
                flex-shrink: 1;
                width: 21px;
                height: 21px;
                box-sizing: content-box;
                display: flex;
                display: -webkit-box;
                display: -moz-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                -webkit-box-pack: center;
                -moz-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
            }

            .wpo365-mssignin-label {
                padding-left: 6px;
                padding-right: 12px;
                font-weight: 600;
                color: #5e5e5e;
                font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
                font-size: 15px;
                -webkit-flex-shrink: 1;
                -moz-flex-shrink: 1;
                flex-shrink: 1;
                height: 21px;
                line-height: 21px;
            }
        </style>
        <div id="wpo365OpenIdRedirect" class="wpo365-mssignin-wrapper">
            <div class="wpo365-mssignin-spacearound">
                <div class="wpo365-mssignin-button" onclick="window.wpo365.pintraRedirect.toMsOnline()">
                    <div class="wpo365-mssignin-logo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21">
                            <title>MS-SymbolLockup</title>
                            <rect x="1" y="1" width="9" height="9" fill="#f25022" />
                            <rect x="1" y="11" width="9" height="9" fill="#00a4ef" />
                            <rect x="11" y="1" width="9" height="9" fill="#7fba00" />
                            <rect x="11" y="11" width="9" height="9" fill="#ffb900" />
                        </svg>
                    </div>
                    <div class="wpo365-mssignin-label">Sign in with Microsoft</div>
                </div>
            </div>
        </div>
    </div>
<?php
}


function get_post_count_taxonomy($term_id, $taxonomy, $post_type)
{
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'id',
                'terms' => $term_id,
            )
        )
    );
    $posts = get_posts($args);
    return count($posts);
}

function checkToken()
{
    $header = getallheaders();

    if (array_key_exists("Authorization", $header) === false) {
        return new WP_REST_Response(['message' => 'Token Not found'], 404);
    }

    $user = get_users([
        'meta_key' => 'api_token',
        'meta_value' => $header['Authorization'],
        'number' => 1
    ]);
    if (count($user) == 1) {
        return new WP_REST_Response(['id' => $user[0]], 200);
    } else {
        return new WP_REST_Response(['message' => 'Token is wrong'], 401);
    }
}
