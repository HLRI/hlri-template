<?php get_header(); ?>

<?php

$info = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);


?>
<div class="w-100">
    <?php
        if (!empty(get_the_title())) {
            $page_title = get_the_title();
        } else {
            $page_title = 'Home Leader Realty Inc.'; // Default value
        }
        // Override the global define for a specific page
        define('CUSTOM_PAGE_HEADER', [
            'title' => $page_title,
            'subtitle' => 'Agents',
        ]);

        // Include the custom-page-header.php file
        include(HLR_THEME_COMPONENT . 'custom-page-header.php');
    ?>
    <div class="container mb-3">
        <div class="card p-1 p-md-3">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                            <div class="card-profile-image ">
                                    <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                            </div>
                    </div>
                    <!-- Detail -->
                    <div class="col-md-8 col-lg-8 ">
                        <div class="card-profile-details px-3 px-md-0">
                            <h1 class="mb-1"><?php the_title() ?></h1>
                            <div class="card-profile-details-job-position"><b>Job Position : </b><span class="job"><?php the_terms(get_the_ID(), 'staff', '', ' / ', ' ') ?></span></div>
                            <div class="d-flex flex-column gap-1 mt-4">
                                <?php if (!empty($info)) : ?>
                                    <?php if ($info['opt-show-information']) : ?>
                                        <!-- <hr class="hr-profile"> -->
                                        <?php if (!empty($info['opt-agents-phone'])) : ?>
                                            <a href="tel:<?= $info['opt-agents-phone'] ?>" class="content-info"><div><i class="fa fa-phone-alt icon-profile"></i></div><?= $info['opt-agents-phone'] ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($info['opt-agents-fax'])) : ?>
                                            <div class="content-info"><div><i class="fa fa-fax icon-profile"></i></div><?= $info['opt-agents-fax'] ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($info['opt-agents-email'])) : ?>
                                            <a href="mailto:<?= $info['opt-agents-email'] ?>" class="content-info"><div><i class="fa fa-envelope icon-profile"></i></div><?= $info['opt-agents-email'] ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($info['opt-agents-address'])) : ?>
                                            <div class="content-info"><div><i class="fa fa-map-marker icon-profile"></i></div><?= $info['opt-agents-address'] ?></div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="inc-profile w-100 text-left">HOME LEADER REALTY INC</div>
                        </div>
                    </div>

                    <!-- End Detail -->
                </div>
                <!-- About me  -->
                <div class="container d-flex flex-column" >
                    <h3>About me</h3>              
                    <p>
                        <?php the_excerpt() ?>
                    </p>
                </div>
                <!-- end About me  -->
        </div>
        <div class="card mt-4 mb-4">
            <h4 class="pt-2 px-4" >Contact Me</h4>
            <?php echo do_shortcode('[hrl_contact_me_form]'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>