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
                <div class="card join-us">
                    <div class="card-body p-1" >
                       <div class="d-flex  h-100 ">
                            <div class="d-flex flex-column mt-2 justify-content-start justify-content-md-center join-us__left" >   
                                <div class="px-4">
                                    <h4>
                                        Join Our Team
                                    </h4>
                                    <p>Do you have what it takes to succeed in Toronto's
                                        white hot preconstruction market?</p>
                                </div>
                                <?php echo do_shortcode('[hrl_join_our_team_form]'); ?>
                                <div class="join-us__right_image_detail d-md-none bg-foreground" >
                                        <h4>
                                            Home Leader Realty
                                        </h4>
                                        <p>Request Your Free Online Tour Now to Find Out</p>
                                        <div class="join-us__right_image_buttons">
                                            <button>Privacy Policy</button>
                                            <a href="#" >learn more about us ↗</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="d-none d-md-block p-2 w-75 h-100 join-us__right" >
                                <div class="bg-foreground join-us__right_image p-4 " 
                                style="background-image: url('<?= !empty($theme_options['opt-page-header-background']) ? $theme_options['opt-page-header-background'] : ""  ?>');" 
                                >
                                    <div class="join-us__right_image_detail" >
                                        <h4>
                                            Home Leader Realty
                                        </h4>
                                        <p>Request Your Free Online Tour Now to Find Out</p>
                                        <div class="join-us__right_image_buttons">
                                            <button>Privacy Policy</button>
                                            <a href="#" >learn more about us ↗</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>

            </div>
   </div>

<?php get_footer(); ?>