
 <div class="card-teams">
    <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
    <div class="card-teams-content">
        <a class="card-teams-title  text-capitalize" href="<?= get_the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
        <div class=" card-teams-staff  text-capitalize"><?php the_terms(get_the_ID(), 'staff', '', ',', ' ') ?></div>
    </div>
   </div>
