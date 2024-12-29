<div class="px-2 mb-5">

    <div class="properties-card" >
        <div class="properties-card_image" >
            <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>">
                <?php the_post_thumbnail('thumbnail', ['loading' => 'lazy']) ?>
            </a>
        </div>
        <div class="properties-card_detail" >
            <div class="properties-card_title" >
                 <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>">
                    <h6 class="text-black"><?= strlen(get_the_title())  > 18 ? substr(get_the_title(), 0, 18) . '...' : get_the_title() ?></h6>
                </a>
            </div>   
            <div class="properties-card_desc ghool" >
                 <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>">
                    <?= strlen(strip_tags(get_the_excerpt()))  > 44 ? substr(strip_tags(get_the_excerpt()), 0, 44) . '...' : strip_tags(get_the_excerpt()) ?>
                </a><br>
                <div>
                    <?php
                    $project_incentives = get_post_meta(get_the_ID(), 'hlr_framework_properties-incentives', true);
                    if (!empty($project_incentives['opt_properties_incentives_items'])) {
                        $incentives = $project_incentives['opt_properties_incentives_items'];
                    } else {
                        $incentives = [];
                    }
                    ?>
                    <ul class="text-small incentives-taxonomy mb-4">
                        <?php foreach ($incentives as $incentive): ?>
                            <li class="mb-2">
                                <i class="text-dark <?php echo htmlspecialchars($incentive['opt-icon-incentives']); ?> me-2 custom-icon"></i>
                                <span class="custom-text"><?php echo $incentive['opt-link-incentives']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>   
            <div class="properties-card_opt" >
                <?php if (!empty($mdata['opt-min-price-sqft'])) : ?>
                    <div class="properties-card_price">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>    
                        <?= "$" . $mdata['opt-min-price-sqft'] . " to " . "$" . $mdata['opt-max-price-sqft'] ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($mdata['opt-size-min'])) : ?>
                    <div class="properties-card_size">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ruler"><path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path d="m17.5 15.5 2-2"/></svg> 
                    <?= $mdata['opt-size-min'] . " - " . $mdata['opt-size-max'] . " Sq Ft"?></div>
                <?php endif; ?>
                <?php if (!empty($mdata['opt-address'])) : ?>
                    <div class="properties-card_addr"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?= strlen($mdata['opt-address'])  > 38 ? substr($mdata['opt-address'], 0, 38) . '...' : $mdata['opt-address'] ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($mdata['opt-occupancy'])) : ?>
                    <div class="properties-card_addr"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        Built in <?= $mdata['opt-occupancy']  ?>
                    </div>
                <?php endif;?>
            </div>
            <div class="properties-card_actions">
                <div  onclick="setLikeProperties(this, <?= get_the_ID() ?>)" role="button" class="properties-card_actions_btn">
                    <i class="fa fa-heart" <?= isset($_COOKIE[get_the_ID()]) ? ' style="color:red" ' : '' ?>></i>
                    <span id="like-total">
                        <?php if (!empty(get_post_meta(get_the_ID(), 'total_like', true)) && get_post_meta(get_the_ID(), 'total_like', true) ) : ?>
                            <?= get_post_meta(get_the_ID(), 'total_like', true)   ?>
                        <?php else: ?>
                            Like
                        <?php endif; ?>
                    </span>
                </div>

                <div class="properties-card_actions_btn" role="button" onclick="bookmark(this,<?= get_the_ID() ?>)">
                    <i <?= is_user_logged_in() && in_array(get_the_ID(), (array) get_user_meta(get_current_user_id(), 'properties_favorites', false)) ? 'style="color:#9de450"' : '' ?>  class="fa fa-bookmark"></i>
                </div>  
            </div>
        </div>
    </div>

</div>