<?php get_header(); ?>

<div class="agents" >
     <?php
        // Override the global define for a specific page
        define('CUSTOM_PAGE_HEADER', [
            'title' => 'We have world expert team',
            'subtitle' => 'Our expert team',
        ]);

        include(HLR_THEME_COMPONENT . 'custom-page-header.php');
        ?>
    <p>Home Leader Realty is one of the top leading brokerages in the sales of pre-construction and resale condos in the GTA. Our team specializes in pre-construction sales. Through our cultivated developer relationships, we have access to PLATINUM SALES and TRUE UNIT ALLOCATION in advance of the general REALTOR® and the general public. With cutting edge technology and a skilled team of experts, Home Leader Realty will lead you to the best return on your investments. Buying a condo in Toronto is one of the best investments you will ever make and putting your trust in this brokerage will outperform, whether it is your first home or added investment. Our combined 100 years plus of experience serves only the best locations meeting your needs.</p>
    <div class="agents-content container" >
      <?php include(HLR_THEME_COMPONENT . 'agents/list.php'); ?>
    </div>
</div>

<?php get_footer(); ?>