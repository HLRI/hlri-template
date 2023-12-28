<div style="width:310px;" >
    <div class="card-blog">
        <div class="card-blog-image">
            <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
        </div>
        <div class="card-blog-content">
            <div class="date-blog mb-2"><span><?= get_the_date() ?></span></div>
            <h3 class="text-black"><a href="<?= get_the_permalink() ?>" ><?= strlen(get_the_title())  > 40 ? substr(get_the_title(), 0, 40) . '...' : get_the_title() ?></a></h3>
            <div class="card-blog-description">
                <?= strlen(strip_tags(get_the_content()))  > 240 ? substr(strip_tags(get_the_content()), 0, 240) . '...' : strip_tags(get_the_content()) ?>
            </div>
        </div>
    </div>
</div>
