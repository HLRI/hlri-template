<?php /* Template Name: JoinUs Template */ ?>

<?php get_header(); ?>

<?php $theme_options = get_option('hlr_framework'); ?>
    <div class="w-100">
              <?php
                // Override the global define for a specific page
                define('CUSTOM_PAGE_HEADER', [
                    'title' => 'Join Our Team',
                    'subtitle' => '',
                ]);

                // Include the custom-page-header.php file
                include(HLR_THEME_COMPONENT . 'custom-page-header.php');
              ?>
            <div class="container d-flex flex-column mt-n-5 mb-3" >
                <div class="card join-us" id="join-form">
                    <div class="card-body p-1" >
                       <div class="d-flex  h-100 ">
                            <div class="d-flex flex-column mt-2 justify-content-start justify-content-md-center join-us__left" >   
                                <div class="px-4">
                                    <h4>
                                       <?php
                                            if (!empty($theme_options['opt-join-us-title'])) {
                                                echo $theme_options['opt-join-us-title'];
                                            }
                                        ?>
                                    </h4>
                                    <p>
                                          <?php
                                                if (!empty($theme_options['opt-join-us-description'])) {
                                                    echo $theme_options['opt-join-us-description'];
                                                }
                                            ?>
                                    </p>
                                </div>
                                <?php echo do_shortcode('[hrl_join_our_team_form]'); ?>
                                <div class="join-us__right_image_detail d-md-none bg-foreground" >
                                        <img loading="lazy" class="mb-2" style="width: 80%;z-index:2;" src="<?= HLR_THEME_ASSETS . 'images/join-us-logo.png' ?>" alt="join-us-logo">
                                        <p class="text-center">
                                            <?php
                                                if (!empty($theme_options['opt-join-us-description'])) {
                                                    echo $theme_options['opt-join-us-description'];
                                                }
                                            ?>
                                        </p>
                                        <div class="join-us__right_image_buttons">
                                            <button onclick="location.href='https://condoy.com/privacy-policy/'">Privacy Policy</button>
                                            <a href="/about-us/" >learn more about us ↗</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="d-none d-md-block p-2 w-75 h-100 join-us__right" >
                                <div class="bg-foreground join-us__right_image p-4 " 
                                style="background-image: url('<?= !empty($theme_options['opt-join-us-image']) ? $theme_options['opt-join-us-image'] : ""  ?>');" 
                                >
                                    <div class="join-us__right_image_detail" >
                                        <img loading="lazy" class="mb-2" style="width: 50%;z-index:2;" src="<?= HLR_THEME_ASSETS . 'images/join-us-logo.png' ?>" alt="join-us-logo">
                                        <p>
                                              <?php
                                                if (!empty($theme_options['opt-join-us-image-description'])) {
                                                    echo $theme_options['opt-join-us-image-description'];
                                                }
                                            ?>
                                        </p>
                                        <div class="join-us__right_image_buttons">
                                            <button onclick="location.href='https://condoy.com/privacy-policy/'">Privacy Policy</button>
                                            <a href="/about-us/" >learn more about us ↗</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="card mt-3 pt-3" >
                    <h4 class="w-100 text-center font-weight-bold ">
                         <?php
                            if (!empty($theme_options['opt-join-us-youtube-title'])) {
                                echo $theme_options['opt-join-us-youtube-title'];
                            }
                        ?>
                    </h4>
                     <div class="row p-3">
                         <?php 
                            if($theme_options['opt-join-us-youtube']){                                    
                            $Items = $theme_options['opt-join-us-youtube'];
                            foreach ($Items as $item) :
                        ?>
                            <div class="col-md-6 col-sm-12 mb-4"> <!-- mb-4 adds margin-bottom; you can use px-*, py-*, etc. for other spacing adjustments -->
                                <div class="embed-responsive embed-responsive-16by9" style="border-radius:10px;" >
                                    <iframe loading="lazy" class="embed-responsive-item" src="<?= $item['opt-join-us-youtube-link'] ?>" frameborder="0" allowfullscreen></iframe>                    
                                </div>
                            </div>
                        <?php 
                            endforeach; 
                            }
                        ?>
                    </div>
                </div>

                 <div class="card mt-3 pt-3" >
                    <h4 class="w-100 text-center font-weight-bold ">
                         <?php
                            if (!empty($theme_options['opt-join-us-detail-title'])) {
                                echo $theme_options['opt-join-us-detail-title'];
                            }
                        ?>
                    </h4>
                      <div class="row p-3">
                        <div class="col-md-6 col-sm-12 ">
                            <img 
                             src="<?= !empty($theme_options['opt-join-us-detail-image-1']) ? $theme_options['opt-join-us-detail-image-1'] : ""  ?>"
                             class="img-fluid rounded "
                             alt="home-leader-reality-join-us"
                             >
                        </div>
                                         
                        <div class="col-md-6 col-sm-12">
                            <p>
                                <?php
                                    if (!empty($theme_options['opt-join-us-detail-description-1'])) {
                                       echo '<div style="font-size: 14px;">' . apply_filters('the_content', $theme_options['opt-join-us-detail-description-1']) . '</div>';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="row p-3">
                         <div class="col-md-6 col-sm-12">
                                <?php
                                    if (!empty($theme_options['opt-join-us-detail-description-2'])) {
                                        echo '<div style="font-size: 14px;">' . apply_filters('the_content', $theme_options['opt-join-us-detail-description-2']) . '</div>';
                                    }
                                ?>
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                            <img 
                             src="<?= !empty($theme_options['opt-join-us-detail-image-2']) ? $theme_options['opt-join-us-detail-image-2'] : ""  ?>"
                             class="img-fluid rounded "
                             alt="home-leader-reality-join-us"
                             >
                        </div>
                    </div>
                </div>
            </div>
   </div>

<?php get_footer(); ?>