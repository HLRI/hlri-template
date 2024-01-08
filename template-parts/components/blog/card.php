
<div class="col-12 col-sm-12 col-md-6 col-xl-3 col-lg-4 px-2 mb-4">
    <div class="card-blog d-flex flex-column justify-content-between ">
        <div class="card-blog-image">
            <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
        </div>
        <div class="card-blog-content">
            <div class="date-blog mb-2"><span><?= get_the_date() ?></span></div>
            <h3 class="text-black"><a href="<?= get_the_permalink() ?>" ><?= strlen(get_the_title())  > 155 ? substr(get_the_title(), 0, 155) . '...' : get_the_title() ?></a></h3>
            <div class="card-blog-description">
                <?= strlen(strip_tags(get_the_content()))  > 150 ? substr(strip_tags(get_the_content()), 0, 150) . '...' : strip_tags(get_the_content()) ?>
            </div>
        </div>
        <a class="w-100 p-2 px-4 text-right btn-hlr" href="<?= get_the_permalink() ?>" > Read more <i class="fa fa-arrow-right"></i> </a>
    </div>
</div>
