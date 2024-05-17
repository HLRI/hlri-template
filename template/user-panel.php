<?php /* Template Name: User Panel */ ?>
<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('login'));
}

// global $current_user;
// $user_roles = $current_user->roles;
// $user_role = array_shift($user_roles);
// if ($user_role != 'advertiser' and $user_role != 'administrator') {
//     include_once PLSWB_THEME_PATH . '/views/front/errors/403.php';
//     exit;
// }

$user_info = wp_get_current_user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= HLR_THEME_ASSETS ?>assets-panel/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= HLR_THEME_ASSETS ?>assets-panel/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= HLR_THEME_ASSETS ?>assets-panel/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= get_site_icon_url() ?>" />
</head>
<style>
    .nav-item .nav-link.active {
        color: #ffd502 !important;
    }
</style>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="<?= home_url('/') ?>"><img loading="lazy" src="<?php $logo = get_theme_mod('custom_logo');
                                                                                                            $image = wp_get_attachment_image_src($logo, 'full');
                                                                                                            $image_url = $image[0];
                                                                                                            echo $image_url;
                                                                                                            ?>" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="<?= home_url('/') ?>"><img loading="lazy" src="<?= get_site_icon_url() ?>" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>
                            <div class="dropdown-divider"></div>
<!--                            <a class="dropdown-item preview-item">-->
<!--                                <div class="preview-thumbnail">-->
<!--                                    <img loading="lazy" src="--><?php //= get_avatar_url(get_current_user_id()) ?><!--" alt="image" class="profile-pic">-->
<!--                                </div>-->
<!--                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
<!--                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>-->
<!--                                    <p class="text-gray mb-0"> 1 Minutes ago </p>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                            <div class="dropdown-divider"></div>-->
<!--                            <a class="dropdown-item preview-item">-->
<!--                                <div class="preview-thumbnail">-->
<!--                                    <img loading="lazy" src="--><?php //= get_avatar_url(get_current_user_id()) ?><!--" alt="image" class="profile-pic">-->
<!--                                </div>-->
<!--                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
<!--                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>-->
<!--                                    <p class="text-gray mb-0"> 15 Minutes ago </p>-->
<!--                                </div>-->
<!--                            </a>-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img loading="lazy" src="<?= get_avatar_url(get_current_user_id()) ?>" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                                    <p class="text-gray mb-0"> long ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">0 new messages</h6>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notifications</h6>
                            <div class="dropdown-divider"></div>
<!--                            <a class="dropdown-item preview-item">-->
<!--                                <div class="preview-thumbnail">-->
<!--                                    <div class="preview-icon bg-success">-->
<!--                                        <i class="mdi mdi-calendar"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
<!--                                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>-->
<!--                                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                            <div class="dropdown-divider"></div>-->
<!--                            <a class="dropdown-item preview-item">-->
<!--                                <div class="preview-thumbnail">-->
<!--                                    <div class="preview-icon bg-warning">-->
<!--                                        <i class="mdi mdi-settings"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
<!--                                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>-->
<!--                                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                            <div class="dropdown-divider"></div>-->
<!--                            <a class="dropdown-item preview-item">-->
<!--                                <div class="preview-thumbnail">-->
<!--                                    <div class="preview-icon bg-info">-->
<!--                                        <i class="mdi mdi-link-variant"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
<!--                                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>-->
<!--                                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                            <div class="dropdown-divider"></div>-->
                            <a class="dropdown-item preview-item">
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">No Notification</h6>
                                    <p class="text-gray ellipsis mb-0"> stay tuned! </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                        </div>
                    </li>
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="<?= wp_logout_url() ?>">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img loading="lazy" src="<?= get_avatar_url(get_current_user_id()) ?>" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black"><?= $user_info->user_nicename ?></p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= wp_logout_url() ?>">
                                <i class="mdi mdi-logout me-2 text-warning"></i> Signout </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <style>
                .disablednav{
                    background-color: #e7e7e7;
                }
            </style>
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img loading="lazy" src="<?= get_avatar_url(get_current_user_id()) ?>" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2"><?= $user_info->user_nicename ?></span>
                                <span class="text-secondary text-small"><?= $user_info->user_email ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= empty($_GET['page-url'])  ? 'active' : '' ?>" href="<?= home_url('panel') ?>">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page-url=properties-favorites">
                            <span class="menu-title">Favorite Properties</span>
                            <i class="mdi mdi-bookmark menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page-url=visit-history">
                            <span class="menu-title">Visit History</span>
                            <i class="mdi mdi-eye menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item disablednav">
                        <a class="nav-link" href="">
                            <span class="menu-title">Your Listings</span>
                            <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item disablednav">
                        <a class="nav-link" href="">
                            <span class="menu-title">Saved Searches</span>
                            <i class="mdi mdi-account-search menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item disablednav">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" <?= (isset($_GET['page-url'])) && (isset($_GET['menu']) == 'ads') ? 'aria-expanded="true"' : 'aria-expanded="false"' ?> aria-controls="ui-basic">
                            <span class="menu-title">Support</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-lifebuoy menu-icon"></i>
                        </a>
                        <div class="collapse <?= (isset($_GET['page-url'])) && (isset($_GET['menu']) == 'ads') ? 'show' : '' ?>" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link <?= $_GET['page-url'] == 'ui-basic' ? 'active' : '' ?>" href="?page-url=ui-basic&menu=ads">All Tickets</a></li>
                                <li class="nav-item"> <a class="nav-link" href="?page-url=ui-basic&menu=ads">Open Tickets</a></li>
                                <li class="nav-item"> <a class="nav-link" href="?page-url=ui-basic&menu=ads">Closed Tickets</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">


                    <?php

                    if (isset($_GET['page-url'])) {
                        if (file_exists(HLR_THEME_PATH . '/template-parts/user-panel-pages/' . $_GET['page-url'] . '.php')) {
                            include_once HLR_THEME_PATH . '/template-parts/user-panel-pages/' . $_GET['page-url'] . '.php';
                        } else {
                            echo 'There is no page , please create one.';
                        }
                    } else {
                        if (file_exists(HLR_THEME_PATH . '/template-parts/user-panel-pages/dashboard.php')) {
                            include_once HLR_THEME_PATH . '/template-parts/user-panel-pages/dashboard.php';
                        } else {
                            echo 'There is no page , please create one.';
                        }
                    }

                    ?>


                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright 2018 - <?= date("Y") ?> | Home Leader Realty Inc. All Rights Reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= HLR_THEME_ASSETS ?>assets-panel/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= HLR_THEME_ASSETS ?>assets-panel/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= HLR_THEME_ASSETS ?>assets-panel/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= HLR_THEME_ASSETS ?>assets-panel/js/off-canvas.js"></script>
    <script src="<?= HLR_THEME_ASSETS ?>assets-panel/js/hoverable-collapse.js"></script>
    <script src="<?= HLR_THEME_ASSETS ?>assets-panel/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?= HLR_THEME_ASSETS ?>assets-panel/js/dashboard.js"></script>

    <script src="<?= HLR_THEME_ASSETS ?>js/sweetalert2@11.js"></script>
    <script src="<?= HLR_THEME_ASSETS ?>js/ajax.js"></script>

    <!-- End custom js for this page -->
</body>

</html>