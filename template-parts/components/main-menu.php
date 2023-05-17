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
                
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" viewBox="0 0 24 24" class="vt-switch-appearance-sun"><path d="M12,18c-3.3,0-6-2.7-6-6s2.7-6,6-6s6,2.7,6,6S15.3,18,12,18zM12,8c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4c2.2,0,4-1.8,4-4C16,9.8,14.2,8,12,8z"></path><path d="M12,4c-0.6,0-1-0.4-1-1V1c0-0.6,0.4-1,1-1s1,0.4,1,1v2C13,3.6,12.6,4,12,4z"></path><path d="M12,24c-0.6,0-1-0.4-1-1v-2c0-0.6,0.4-1,1-1s1,0.4,1,1v2C13,23.6,12.6,24,12,24z"></path><path d="M5.6,6.6c-0.3,0-0.5-0.1-0.7-0.3L3.5,4.9c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l1.4,1.4c0.4,0.4,0.4,1,0,1.4C6.2,6.5,5.9,6.6,5.6,6.6z"></path><path d="M19.8,20.8c-0.3,0-0.5-0.1-0.7-0.3l-1.4-1.4c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l1.4,1.4c0.4,0.4,0.4,1,0,1.4C20.3,20.7,20,20.8,19.8,20.8z"></path><path d="M3,13H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h2c0.6,0,1,0.4,1,1S3.6,13,3,13z"></path><path d="M23,13h-2c-0.6,0-1-0.4-1-1s0.4-1,1-1h2c0.6,0,1,0.4,1,1S23.6,13,23,13z"></path><path d="M4.2,20.8c-0.3,0-0.5-0.1-0.7-0.3c-0.4-0.4-0.4-1,0-1.4l1.4-1.4c0.4-0.4,1-0.4,1.4,0s0.4,1,0,1.4l-1.4,1.4C4.7,20.7,4.5,20.8,4.2,20.8z"></path><path d="M18.4,6.6c-0.3,0-0.5-0.1-0.7-0.3c-0.4-0.4-0.4-1,0-1.4l1.4-1.4c0.4-0.4,1-0.4,1.4,0s0.4,1,0,1.4l-1.4,1.4C18.9,6.5,18.6,6.6,18.4,6.6z"></path></svg>



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