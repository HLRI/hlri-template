 <div class="col-12 col-sm-12 col-md-6 col-lg-4 px-2" >
    <div class="card-teams"  data-href="<?= get_the_permalink(); ?>">
        <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
        <div class="card-teams-content">
            <a class="card-teams-title  text-capitalize" href="<?= get_the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
            <div class=" card-teams-staff  text-capitalize"><?php the_terms(get_the_ID(), 'staff', '', ',', ' ') ?></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.card-teams').on('click', function() {
            var url = $(this).data('href');
            if (url) {
                window.location.href = url;
            }
        });
    });
</script>
