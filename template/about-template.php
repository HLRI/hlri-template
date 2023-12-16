<?php /* Template Name: About Template */ ?>

<?php get_header(); ?>
<?php $theme_options = get_option('hlr_framework'); ?>
    <div class="about">
              <?php
               if (!empty($theme_options['opt-about-title'])) {
                    $page_title = $theme_options['opt-about-title'];
                } else {
                    $page_title = 'Home Leader Realty Inc.'; // Default value
                }
                // Override the global define for a specific page
                define('CUSTOM_PAGE_HEADER', [
                    'title' => $page_title,
                    'subtitle' => 'About US',
                ]);

                // Include the custom-page-header.php file
                include(HLR_THEME_COMPONENT . 'custom-page-header.php');
              ?>

            <div class="container pb-4">
                 <div class="about-content d-flex flex-column gap-2">
                        <div class="about-section about-section-overview d-flex flex-column flex-md-row align-items-stretch">
                            <div class="about-section-overview-left w-100" >
                                 <div class="about-section-overview-image">
                                      <img src="<?= !empty($theme_options['opt-about-section-one-image']) ? $theme_options['opt-about-section-one-image'] : ""  ?>" alt="overview-image" />
                                 </div>
                            </div>
                            <div class="about-section-overview-right w-100 mt-3 mt-md-0 " >
                                <h3>
                                    <?php 
                                        if (!empty($theme_options['opt-about-title'])) {
                                            echo $theme_options['opt-about-title'];
                                        }
                                    ?>
                                </h3>
                                <p>
                                    <?php
                                        if (!empty($theme_options['opt-about-section-one-description'])) {
                                            echo $theme_options['opt-about-section-one-description'];
                                        }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <!-- middle section -->
                        <div class="about-section about-section--middle d-flex flex-column-reverse flex-md-row">
                            <div class="about-section__left">
                                <h3 class="about-section__title">
                                     <?php 
                                        if (!empty($theme_options['opt-about-section-two-title'])) {
                                            echo $theme_options['opt-about-section-two-title'];
                                        }
                                    ?>
                                </h3>
                                <p class="about-section__description">
                                    <?php 
                                        if (!empty($theme_options['opt-about-section-two-description'])) {
                                            echo $theme_options['opt-about-section-two-description'];
                                        }
                                    ?>
                            </p>
                            </div>
                            <div class="about-section__right "
                            style="background-image: url('<?= !empty($theme_options['opt-about-section-two-image']) ? $theme_options['opt-about-section-two-image'] : ""  ?>');"
                             ></div>
                        </div>

                   </div>
               </div>
            </div>
    </div>
<?php get_footer(); ?>