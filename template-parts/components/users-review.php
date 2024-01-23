 <?php
        // WP_Query arguments
        $args = array(
            'post_type'         => 'reviews',
            'post_status'       => 'publish',
            'posts_per_page'    => 8, // You can change this to display more or fewer reviews
            'orderby'           => 'date',
            'order'             => 'DESC' // Change this to 'ASC' if you want older reviews first
        );

        // The Query
        $reviews_query = new WP_Query($args);


        ?>

        <div class=" container-lg my-4">
             <div class="titr-list">
                <h3 class="font-weight-bold">Latest Reviews</h3>
            </div>
            <div class="row">
                <?php
                // The Loop
                if ($reviews_query->have_posts()) {
                    while ($reviews_query->have_posts()) {
                        $reviews_query->the_post();
                        // Retrieve the rating from post meta
                        $rating = get_post_meta(get_the_ID(), 'reviews_rating', true);
                ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <article id="post-<?php the_ID(); ?>" class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="review-author-profile mb-3 mr-2">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="review-author-initial">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="review-author-initial">
                                            <?php 
                                            // Get the first character of the author's display name.
                                            $author_name = get_the_author_meta('display_name');
                                            echo esc_html(strtoupper(substr($author_name, 0, 1))); 
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h6 class="card-title mb-0 pl-1"><?php the_title(); ?></h6>
                                    <div class="review-rating rating-stars">
                                        <ul  id="stars">
                                                <?php for ($i = 0; $i < 5; $i++) : ?>
                                                    <?php if ($i < $rating) : ?>
                                                        <li class="star-rated selected">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                    <?php else : ?>
                                                        <li class="star-rated">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                          
                            <div class="review-content">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                          <?php echo get_the_date(); ?>
                        </div>
                    </article>
                </div>
                <?php
                    }
                } else {
                    echo '<p>No reviews found.</p>';
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>