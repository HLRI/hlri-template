<?php get_header(); ?>

<div class="container my-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="image-floorplan">
               <?php the_post_thumbnail_url('normal', ['class' => 'img-fluid']) ?>
            </div>
        </div>
        <div class="col-lg-4">2</div>
    </div>
</div>


<?php get_footer(); ?>