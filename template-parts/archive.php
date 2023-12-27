<?php get_header() ?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type'        => 'post',
    'posts_per_page'   => get_option('posts_per_page'),
    'paged' => $paged,
);
$query = new WP_Query($args);


?>
<div class="container-fluid px-5 my-5">
    <div class="row">
        <?php if (have_posts()) :  ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-3 px-2">
                    <div class="card-blog">
                        <div class="card-blog-header">
                            <div class="blog-category">
                                <i class="fa fa-folder-open-o"></i>
                                <?php
                                $i = 1;
                                foreach (get_the_category() as $cat) :

                                    if ($i == count(get_the_category())) : ?>
                                        <a href="<?= home_url('category/') . $cat->slug ?>"><span> <?= $cat->name ?></span></a>
                                    <?php else : ?>
                                        <a href="<?= home_url('category/') . $cat->slug ?>"><span> <?= $cat->name ?></span></a> ,
                                <?php endif;
                                    $i++;
                                endforeach; ?>
                            </div>
                            <div class="date-blog"><i class="fa fa-calendar"></i> <span><?= get_the_date() ?></span></div>
                        </div>
                        <div class="card-blog-image">
                            <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                        </div>
                        <div class="card-blog-content">
                            <h3 class="text-black"><?= strlen(get_the_title())  > 55 ? substr(get_the_title(), 0, 55) . '...' : get_the_title() ?></h3>
                            <div class="card-blog-description">
                                <?= strlen(strip_tags(get_the_content()))  > 80 ? substr(strip_tags(get_the_content()), 0, 80) . '...' : strip_tags(get_the_content()) ?>
                            </div>
                        </div>
                        <div class="card-blog-option">
                            <div class="card-blog-social">
                                <span><?= getView(get_the_ID()) ?></span>
                                <i class="fa fa-eye"></i>
                                <!-- <i class="fa fa-heart"></i> -->
                            </div>
                            <a class="btn-hlr" href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>" class="">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>



            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>

    <div class="mt-5 row d-flex align-items-center justify-content-center">
        <?php
        echo paginate_links(array(
            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'total'        => $query->max_num_pages,
            'current'      => max(1, get_query_var('paged')),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
            'next_text'    => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
            'add_args'     => false,
            'add_fragment' => '',
        ));
        ?>
    </div>
</div>
<?php get_footer() ?>