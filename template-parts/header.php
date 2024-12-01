<?php $theme_options = get_option('hlr_framework'); ?>
<!DOCTYPE>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <noscript>
        <style>
            .content-restricted {
                display: none;
            }
        </style>
    </noscript>
    <?php
    // Ensure this only applies to the specific archive
    if (is_post_type_archive('cities') || is_tax('cities')) {
        echo '<meta name="robots" content="index, follow">';
    }
    ?>

</head>

<body <?php body_class('content-restricted'); ?>>
    <a id="back-to-top" href="#">
        <i class="fa fa-chevron-up"></i>
    </a>

    <?php include(HLR_THEME_COMPONENT . 'main-menu.php'); ?>

    <?php
    global $wp;
    $url = home_url($wp->request);
    ?>

    <?php if (!is_singular()) : ?>
        <?php include(HLR_THEME_COMPONENT . 'share-float.php'); ?>
    <?php endif; ?>