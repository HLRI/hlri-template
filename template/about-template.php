<?php /* Template Name: About Template */ ?>

<?php get_header(); ?>

    <div class="about container-fluid ">
              <?php
                // Override the global define for a specific page
                define('CUSTOM_PAGE_HEADER', [
                    'title' => 'Society where there is understanding',
                    'subtitle' => 'About US',
                ]);

                // Include the custom-page-header.php file
                include(HLR_THEME_COMPONENT . 'custom-page-header.php');
              ?>

            <div class="container pb-4">
                 <div class="about-content d-flex flex-column gap-2">
                        <div class=" about-section about-section-overview">
                            <div class="about-section-overview-left" >
                                 <div class="about-section-overview-image">
                                      <img src="/" alt="overview-image" />
                                 </div>
                            </div>
                            <div class="about-section-overview-right " >
                                <h3>Society where there is understanding</h3>
                                <p>
                                    Home Leader Realty is one of the top leading brokerages in the sales of pre-construction and resale condos in the GTA.
                                    Our team specializes in pre-construction sales. Through our cultivated developer relationships, we have access to PLATINUM SALES and TRUE UNIT ALLOCATION in advance of the general REALTOR® and the general public. With cutting edge technology and a skilled team of experts,
                                    Home Leader Realty will lead you to the best return on your investments.
                                    Buying a condo in Toronto is one of the best investments you will ever make and putting your trust in this brokerage will outperform,
                                    whether it is your first home or added investment. Our combined 100 years plus of
                                    experience serves only the best locations meeting your needs.
                                </p>
                            </div>
                        </div>

                        <!-- middle section -->
                        <div class="about-section about-section--middle">
                            <div class="about-section__left">
                                <h3 class="about-section__title">Society where there is understanding</h3>
                                <p class="about-section__description">
                                    Founded in 1988, Putnam Associates has been serving global biopharmaceutical, diagnostics, and medical device clients, along with private equity and venture capital clients, providing world-class strategic advice based on sophisticated, robust analytics. Our focus enables us to provide
                                </p>
                            </div>
                            <div class="about-section__right"></div>
                        </div>

                   </div>
               </div>
            </div>
    </div>
<?php get_footer(); ?>