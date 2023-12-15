<?php /* Template Name: Contact Template */ ?>

<?php get_header(); ?>

<?php $theme_options = get_option('hlr_framework'); ?>
    <div class="container-fluid ">
              <?php
                // Override the global define for a specific page
                define('CUSTOM_PAGE_HEADER', [
                    'title' => 'Home Leader Realty Inc.',
                    'subtitle' => 'Contact US',
                ]);

                // Include the custom-page-header.php file
                include(HLR_THEME_COMPONENT . 'custom-page-header.php');
              ?>
            <div class="container d-flex flex-column mt-5" >
                <div class="card contact-details-section">
                    <div class="card-body">
                       <div class="d-flex flex-column-reverse flex-md-row justify-content-between align-items-start">
                            <div class="contact-title w-100" >
                                <h4>
                                    <?php
                                    if (!empty($theme_options['opt-contact-title'])) {
                                        echo $theme_options['opt-contact-title'];
                                    }
                                    ?>
                                </h4>
                                <p class="card-text font-weight-lighter">
                                    <?php
                                    
                                    if (!empty($theme_options['opt-contact-subtitle'])) {
                                        echo $theme_options['opt-contact-subtitle'];
                                    }
                                    ?>
                                </p>
                                <div class="mt-3">
                                    <div class="ml-1 row">
                                        <?php
                                            if($theme_options['opt-contact-social']){                                    
                                            $contactItems = array_slice($theme_options['opt-contact-social'], 0, 3);
                                            foreach ($contactItems as $item) :?>
                                            <div class="p-2 mr-2 rounded-circle bg-background contact-social-item" >
                                                <a href="<?= $item['opt-footer-social-link']['url'] ?>"> 
                                                    <i class="<?= $item['opt-contact-social-icon'] ?>" style="font-size:18px;"></i>
                                                </a>
                                            </div>
                                        <?php endforeach; }?>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2 justify-content-start justify-content-md-end w-100 w-md-50" >
                                <?php if (!empty($theme_options['opt-menu-logo']['url'])) : ?>
                                    <div class="site-logo">
                                        <a target="_self" href="<?= home_url('/') ?>" title="<?= $theme_options['opt-menu-logo']['alt'] ?>">
                                            <img loading="lazy" src="<?= $theme_options['opt-menu-logo']['url'] ?>" alt="<?= $theme_options['opt-menu-logo']['alt'] ?>" title="<?= $theme_options['opt-menu-logo']['alt'] ?>">
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row gap-2 mx-auto mt-4 flex-column flex-md-row justify-content-between w-100 contact-info " >
                                <?php 
                                    if($theme_options['opt-contact-contacts']){                                    
                                    $contactItems = array_slice($theme_options['opt-contact-contacts'], 0, 3);
                                    foreach ($contactItems as $item) :
                                 ?>
                                    <div class="col mr-md-4 p-4 contact-info-box d-flex mb-2 gap-4 flex-column align-items-center justify-content-around" >
                                        <div class="pb-2">
                                            <i class="<?= $item['opt-contact-icon'] ?>" style="font-size:25px;"></i>
                                        </div>
                                        <div class="pb-2" >
                                            <?= $item['opt-contact-title'] ?>
                                        </div>
                                        <a href="<?= $item['opt-contact-link']['url'] ?>"> 
                                           <?= $item['opt-contact-link']['text'] ?>
                                        </a>
                                    </div>
                                <?php 
                                    endforeach; 
                                }
                            ?>
                        </div>
                        <div class="contact-about" >
                            <?php
                                if (!empty($theme_options['opt-contact-description'])) {
                                    echo $theme_options['opt-contact-description'];
                                }
                            ?>
                        </div>

                    </div>
                </div>

                <div class="card mt-4 mb-4">
                      <?php echo do_shortcode('[hrl_contact_us_form]'); ?>
                </div>

            </div>
   </div>

<?php get_footer(); ?>