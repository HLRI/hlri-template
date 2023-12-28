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

    <div class="agents-content container" >
      <?php include(HLR_THEME_COMPONENT . 'agents/list.php'); ?>
    </div>
</div>

<?php get_footer(); ?>