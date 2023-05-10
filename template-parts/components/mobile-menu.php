<?php
$locations = get_nav_menu_locations();
$mobile = wp_get_nav_menu_object($locations['mobile-menu']);
$menuitems = wp_get_nav_menu_items($mobile->term_id, array('order' => 'DESC'));

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
    <div class="container-fluid d-lg-none d-md-block d-lg-m-block">
        <div class="row">
            <div class="nav-buttons">

                <div class="wrap-logo-menu">
                    <a class="navbar-toggler" data-toggle="modal" data-target="#sidebarModal">
                        <i class="fa fa-bars"></i>
                    </a>

                    <?php if (!empty($theme_options['opt-menu-logo']['url'])) : ?>
                        <div class="site-logo d-none d-md-block">
                            <a target="_self" href="<?= home_url('/') ?>" title="<?= $theme_options['opt-menu-logo']['alt'] ?>">
                                <img src="<?= $theme_options['opt-menu-logo']['url'] ?>" alt="<?= $theme_options['opt-menu-logo']['alt'] ?>" title="<?= $theme_options['opt-menu-logo']['alt'] ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>


                <div class="wrap-right-menu">

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
                        <?php if (!is_home()) : ?>
                            <a href="#" class="icon-search" data-toggle="modal" data-target="#search-modal"><i class="fa fa-search"></i></a>
                        <?php endif; ?>
                    </div>



                </div>

            </div>
        </div>
    </div>


    <div class="modal right fade menu" id="sidebarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog position-fixed m-auto" role="document">
            <div class="modal-content h-100">
                <div class="modal-body text-left">
                    <div class="nav flex-column">
                        <div class="side-header">
                            <?php if (!empty($theme_options['opt-menu-logo']['url'])) : ?>
                                <div class="side-logo text-center">
                                    <img class="img-fluid w-img-logo-sidebar" src="<?= $theme_options['opt-menu-logo']['url'] ?>" alt="<?= $theme_options['opt-menu-logo']['alt'] ?>" title="<?= $theme_options['opt-menu-logo']['alt'] ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="side-content">
                            <?php foreach ($menuitems as $item) : ?>
                                <?php if (empty($item->children)) : ?>
                                    <?php if ($item->menu_item_parent == 0) : ?>
                                        <?php if ($item->title == 'hr') : ?>
                                            <hr class="my-3">
                                        <?php else : ?>
                                            <?php
                                            $meta = get_post_meta($item->ID, '_prefix_menu_options', true);
                                            ?>
                                            <a href="<?= $item->url ?>" class="d-flex align-items-center nav-link nav-item"><?php if (!empty($meta['icon'])) : ?><i class="<?= str_replace('fas', 'fa', $meta['icon']) ?> fontsize-icon-account icon-color-sidebar"></i><?php endif; ?><span class="ml-2 pr-2 color-text-sidebar" $attributes=""><?= $item->title ?></span></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php $i = 0 ?>
                                    <?php if ($i <= 0) : ?>
                                        <nav class='animated bounceInDown side-nav-dropdown'>
                                            <ul>
                                            <?php endif; ?>
                                            <?php if ($item->menu_item_parent == 0) : ?>
                                                <li class='sub-menu'><a href='<?= !empty($item->children) ? 'javascript:void(0);' : $item->url ?>'><?= $item->title ?><?= !empty($item->children) ? '<div class="fa fa-caret-down right"></div>' : '' ?></a>
                                                    <?php if (!empty($item->children)) : ?>
                                                        <ul>
                                                            <?php foreach ($item->children as $sub) : ?>
                                                                <li class='sub-menu'><a href='<?= $sub->url ?>'><?= $sub->title ?><?= !empty($sub->children) ? '<div class="fa fa-caret-down right"></div>' : '' ?></a>
                                                                    <?php if (!empty($sub->children)) : ?>
                                                                        <ul>
                                                                            <?php foreach ($sub->children as $sub2) : ?>
                                                                                <li><a href='<?= $sub2->url ?>'><?= $sub2->title ?></a></li>
                                                                            <?php endforeach; ?>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endif; ?>
                                            <?php if ($i <= 0) : ?>
                                            </ul>
                                        </nav>
                                    <?php endif; ?>
                                    <?php $i++; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php if ($theme_options['footer-mobile-menu']['opt-display-footer-mobile-menu']) : ?>
                    <div class="modal-footer">
                        <?php if (!empty($theme_options['footer-mobile-menu']['opt-footer-mobile-menu-one-item']['opt-title-footer-mobile-menu-one-item'])) : ?>
                            <a href="<?= $theme_options['footer-mobile-menu']['opt-footer-mobile-menu-one-item']['opt-link-footer-mobile-menu-one-item']['url'] ?>" class="d-flex align-items-center nav-link nav-item">
                                <i class="<?= str_replace('fas', 'fa', $theme_options['footer-mobile-menu']['opt-footer-mobile-menu-one-item']['opt-icon-footer-mobile-menu-one-item']) ?> fontsize-icon-account icon-color-sidebar"></i>
                                <span class="ml-2 pr-2 color-text-sidebar"><?= $theme_options['footer-mobile-menu']['opt-footer-mobile-menu-one-item']['opt-title-footer-mobile-menu-one-item'] ?></span>
                            </a>
                        <?php endif; ?>
                        <a href="<?= $theme_options['footer-mobile-menu']['opt-footer-mobile-menu-two-item']['opt-link-footer-mobile-menu-two-item']['url'] ?>" class="d-flex align-items-center nav-link nav-item">
                            <i class="<?= str_replace('fas', 'fa', $theme_options['footer-mobile-menu']['opt-footer-mobile-menu-two-item']['opt-icon-footer-mobile-menu-two-item']) ?> fontsize-icon-account icon-color-sidebar"></i>
                            <span class="ml-2 pr-2 color-text-sidebar"><?= $theme_options['footer-mobile-menu']['opt-footer-mobile-menu-two-item']['opt-title-footer-mobile-menu-two-item'] ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <p>please set menu</p>
<?php endif; ?>