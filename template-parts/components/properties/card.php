<div class="px-2 mb-5">

    <div class="properties-card" >
        <div class="properties-card_image" >
            <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>">
                <?php the_post_thumbnail('thumbnail', ['loading' => 'lazy']) ?>
            </a>
            <div class="properties-card_actions">
                <div class="properties-card_actions_btn">
                    <i onclick="setLikeProperties(this, <?= get_the_ID() ?>)" role="button" class="fa fa-heart" <?= isset($_COOKIE[get_the_ID()]) ? ' style="color:red" ' : '' ?>></i>
                    <span class="text-muted" id="like-total">
                        <?php if (!empty(get_post_meta(get_the_ID(), 'total_like', true))) : ?>
                            <?= get_post_meta(get_the_ID(), 'total_like', true)   ?>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="properties-card_actions_btn">
                    <i <?= is_user_logged_in() && in_array(get_the_ID(), (array) get_user_meta(get_current_user_id(), 'properties_favorites', false)) ? 'style="color:#9de450"' : '' ?> role="button" onclick="bookmark(this,<?= get_the_ID() ?>)" class="fa fa-bookmark"></i>
                </div>
            </div>
        </div>
        <div class="properties-card_detail" >
            <div class="properties-card_title" >
                 <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>">
                    <h6 class="text-black"><?= strlen(get_the_title())  > 18 ? substr(get_the_title(), 0, 18) . '...' : get_the_title() ?></h6>
                </a>
            </div>
            <div class="properties-card_desc" >
                 <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>">
                    <?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_excerpt()) ?>
                </a>
            </div>
            <div class="properties-card_opt" >
                <?php if (!empty($mdata['opt-min-price-sqft'])) : ?>
                    <div class="properties-card_price">price: <?= "$" . $mdata['opt-min-price-sqft'] . " to " . "$" . $mdata['opt-max-price-sqft'] ?></div>
                <?php endif; ?>
                <?php if (!empty($mdata['opt-size-min'])) : ?>
                    <div class="properties-card_size">size: <?= $mdata['opt-size-min'] . " - " . $mdata['opt-size-max'] . " Sq Ft | " . $mdata['opt-occupancy'] ?></div>
                <?php endif; ?>
                <?php if (!empty($mdata['opt-address'])) : ?>
                    <div class="properties-card_addr">address: <?= $mdata['opt-address'] ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>