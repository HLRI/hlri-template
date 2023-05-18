<nav id="sticker" class="d-none d-md-none d-lg-m-none d-lg-block">
    <div class="container-fluid px-0">
        <div class="wrap-nav">

            <div class="menu-and-logo">

                <?php if (!empty($theme_options['opt-menu-logo']['url'])) : ?>
                    <div class="site-logo">
                        <a target="_self" href="<?= home_url('/') ?>" title="<?= $theme_options['opt-menu-logo']['alt'] ?>">
                            <img src="<?= $theme_options['opt-menu-logo']['url'] ?>" alt="<?= $theme_options['opt-menu-logo']['alt'] ?>" title="<?= $theme_options['opt-menu-logo']['alt'] ?>">
                        </a>
                    </div>
                <?php endif; ?>


                <?php if ($theme_options['opt-display-menu']) : ?>

                    <?php
                    $locations = get_nav_menu_locations();
                    $menu = wp_get_nav_menu_object($locations['main-menu']);
                    $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

                    foreach ($menuitems as $child) {
                        if ($child->menu_item_parent != 0) {
                            $children[] = $child;
                        }
                    }

                    foreach ($menuitems as $parent) {
                        if (!empty($children)) {
                            foreach ($children as $child) {
                                if ($child->menu_item_parent == $parent->ID) {
                                    $menu_children[] = $child;
                                }
                            }
                            $parent->children = $menu_children;
                            $menu_children = [];
                        }
                    }
                    if (!empty($menuitems)) : ?>
                        <ul class="list-nav">
                            <?php foreach ($menuitems as $item) : ?>
                                <?php if ($item->menu_item_parent == 0) :
                                    $meta = get_post_meta($item->ID, '_prefix_menu_options', true);
                                ?>
                                    <li class="nav-item"><a href="<?= !empty($item->children) ? 'javascript:void(0);' : $item->url ?>"><?php if (!empty($meta['icon'])) : ?><i class="<?= str_replace('fas', 'fa', $meta['icon']) ?> icon-main-menu"></i><?php endif; ?><?= $item->title ?> <?= !empty($item->children) ? '<i class="fa fa-caret-down"></i>' : '' ?></a>
                                        <?php if (!empty($item->children)) : ?>
                                            <ul class="submenu">
                                                <?php foreach ($item->children as $sub) : ?>
                                                    <li class="sub-item"><a class="nav-title" href="<?= $sub->url ?>"><span><?= $sub->title ?></span> <?= !empty($sub->children) ? '<i class="fa fa-caret-down"></i>' : '' ?></a>
                                                        <?php if (!empty($sub->children)) : ?>
                                                            <ul class="submenu2">
                                                                <?php foreach ($sub->children as $sub2) : ?>
                                                                    <li class="sub2-item"><a class="nav-title" href="<?= $sub2->url ?>"><?= $sub2->title ?></a></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>please set menu</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>


            <div class="wrap-right-menu">

                <div id="switch-mode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun d-block sw-mode" viewBox="0 0 16 16">
                        <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                    </svg>
                    <svg class="sw-mode d-none" width="16" height="16" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="IconChangeColor" transform="scale(-1, 1)">
                        <path d="M3 11.5066C3 16.7497 7.25034 21 12.4934 21C16.2209 21 19.4466 18.8518 21 15.7259C12.4934 15.7259 8.27411 11.5066 8.27411 3C5.14821 4.55344 3 7.77915 3 11.5066Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" id="mainIconPathAttribute"></path>
                    </svg>
                </div>

                <?php include(HLR_THEME_PATH . '/template-parts/components/search-main-menu.php'); ?>

                <div class="wrap-profile">
                    <?php if (is_user_logged_in()) :
                        $user_meta = get_userdata(get_current_user_id());
                        $user_roles = $user_meta->roles;
                        if (in_array('administrator', $user_roles)) {
                            $url = home_url('wp-admin');
                        } else {
                            $url = home_url('panel');
                        }
                    ?>

                        <div class="menu-account">

                            <div class="menu-account-profile">
                                <img class="image-profile" src="<?= get_avatar_url(get_current_user_id()) ?>" alt="image">
                            </div>
                            <span class="menu-account-name">
                                <?= $user_meta->user_nicename ?>
                                <i class="fa fa-chevron-down"></i>
                            </span>

                            <div class="menu-account-body">
                                <a href="<?= $url ?>" class="btn-signin"><i class="fa fa-dashboard"></i> Dashboard</a>
                                <a href="<?= wp_logout_url() ?>" class="btn-signin"><i class="fa fa-sign-out"></i> Signout</a>
                            </div>
                        </div>

                    <?php else : ?>
                        <a href="#" class="btn-signin" data-toggle="modal" data-target="#login-modal">Sign In</a>
                    <?php endif; ?>
                    <!-- <a href="#" class="icon-btn"><i class="fa fa-bell-o"></i></a>
                    <a href="#" class="icon-btn"><i class="fa fa-heart-o"></i></a> -->
                </div>


            </div>



        </div>
    </div>
</nav>


<?php include(HLR_THEME_PATH . '/template-parts/components/mobile-menu.php'); ?>