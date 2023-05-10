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
                <div class="wrap-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-search" placeholder="Search by location..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-search keyword" autocomplete="off" name="address" type="search" onkeyup="hlr_search()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="search-result"></div>
                </div>


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