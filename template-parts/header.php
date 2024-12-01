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
if (is_front_page()) {
    echo '<div itemscope itemtype="http://schema.org/LocalBusiness">
        <meta itemprop="name" content="CondoY.com" />
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <meta itemprop="streetAddress" content="300 Richmond St W #300" />
    <meta itemprop="addressLocality" content="Toronto" />
    <meta itemprop="addressRegion" content="ON" />
    <meta itemprop="postalCode" content="M5V 1X2" />
    <meta itemprop="addressCountry" content="CA" />
</div>
        <meta itemprop="telephone" content="416-599-9599" />
        <meta itemprop="description" content="Condoy.com: Toronto & GTA\'s top pre-construction condos and townhomes. Exclusive access to insider pricing, platinum sales, and expert investment insights." />
        <div itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification">
            <meta itemprop="dayOfWeek" content="Monday, Tuesday, Wednesday, Thursday, Friday" />
            <meta itemprop="opens" content="09:00" />
            <meta itemprop="closes" content="18:00" />
        </div>
    </div>';

    echo '<div itemscope itemtype="http://schema.org/LocalBusiness">
        <meta itemprop="name" content="Home Leader Realty Inc" />
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <meta itemprop="streetAddress" content="300 Richmond St W #300" />
    <meta itemprop="addressLocality" content="Toronto" />
    <meta itemprop="addressRegion" content="ON" />
    <meta itemprop="postalCode" content="M5V 1X2" />
    <meta itemprop="addressCountry" content="CA" />
</div>
        <meta itemprop="telephone" content="416-599-9599" />
        <meta itemprop="description" content="Condoy.com: Toronto & GTA\'s top pre-construction condos and townhomes. Exclusive access to insider pricing, platinum sales, and expert investment insights." />
        <div itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification">
            <meta itemprop="dayOfWeek" content="Monday, Tuesday, Wednesday, Thursday, Friday" />
            <meta itemprop="opens" content="09:00" />
            <meta itemprop="closes" content="18:00" />
        </div>
    </div>';
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