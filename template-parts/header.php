<?php $theme_options = get_option('hlr_framework'); ?>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php body_class(); ?>>

    <?php include(HLR_THEME_PATH . '/template-parts/components/main-menu.php'); ?>

    <?php
    global $wp;
    $url = home_url($wp->request);
    ?>

      <?php include(HLR_THEME_PATH . '/template-parts/components/share-float.php'); ?>
