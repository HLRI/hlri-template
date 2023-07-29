<div class="wrap-hlr-navigation-fixed" id="navigation-sticker">
    <!--    <div class="close-hlr-navigation">-->
    <!--        <i class="fa fa-arrow-right"></i>-->
    <!--    </div>-->
    <div class="hlr-navigation-fixed">
        <a href="#Overview" class="hlr-navigation-item-fixed">
            Overview
        </a>
        <a href="#Gallery" class="hlr-navigation-item-fixed">
            Gallery
        </a>
        <?php if (!empty($psd['price_images'])) : ?>
            <a href="#PriceList" class="hlr-navigation-item-fixed">
                Price List
            </a>
        <?php endif; ?>
       
        <?php if ($associated_floorplans->have_posts()) : ?>
            <a href="#FloorPlans" class="hlr-navigation-item-fixed">
                Floor Plans
            </a>
           
        <?php endif; ?>
        <a href="#RegisterNow" class="hlr-navigation-item-fixed">
            Register Now
        </a>
    </div>
</div>