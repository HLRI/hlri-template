<?php
    $title = CUSTOM_PAGE_HEADER['title'] ;
    $subtitle = CUSTOM_PAGE_HEADER['subtitle'] ;
    $paragraph = CUSTOM_PAGE_HEADER['paragraph'] ;
    $theme_options = get_option('hlr_framework');
?>
    <div class="page-header" 
    style="background-image: url('<?= !empty($theme_options['opt-page-header-background']) ? $theme_options['opt-page-header-background'] : ""  ?>');" 
    >
        <div class="page-header-title text-center">
            <h3><?php echo esc_html($subtitle); ?></h3>
            <h2 class="font-weight-bold"><?php echo esc_html($title); ?></h2>
        </div>
    </div>
<p class="container"><?php echo esc_html($paragraph); ?></p>

