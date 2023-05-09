<?php get_header(); ?>

<?php

$info = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);


?>
<div class="container-fluid my-5">
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="card-profile-image">
                <?php the_post_thumbnail() ?>
            </div>
        </div>
        <div class="col-md-8 col-lg-8">
            <div class="card-profile-details">
                <h1 class="mb-2"><?php the_title() ?></h1>
                <span><b>Job Position : </b><span class="job"><?php the_terms(get_the_ID(), 'staff', '', ' / ', ' ') ?></span></span>
                <div class="content-profile"><?php the_excerpt() ?></div>

                <?php if (!empty($info)) : ?>
                    <?php if ($info['opt-show-information']) : ?>
                        <hr class="hr-profile">
                        <?php if (!empty($info['opt-agents-phone'])) : ?>
                            <a href="tel:<?= $info['opt-agents-phone'] ?>" class="content-info"><i class="fa fa-phone-alt icon-profile"></i><?= $info['opt-agents-phone'] ?></a>
                        <?php endif; ?>
                        <?php if (!empty($info['opt-agents-fax'])) : ?>
                            <div class="content-info"><i class="fa fa-fax icon-profile"></i><?= $info['opt-agents-fax'] ?></div>
                        <?php endif; ?>
                        <?php if (!empty($info['opt-agents-email'])) : ?>
                            <a href="mailto:<?= $info['opt-agents-email'] ?>" class="content-info"><i class="fa fa-envelope icon-profile"></i><?= $info['opt-agents-email'] ?></a>
                        <?php endif; ?>
                        <?php if (!empty($info['opt-agents-address'])) : ?>
                            <div class="content-info"><i class="fa fa-map-marker icon-profile"></i><?= $info['opt-agents-address'] ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="inc-profile">HOME LEADER REALTY INC</div>

            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>