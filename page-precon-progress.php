<?php
/**
 * Template Name: Precon Properties Progress
 */
get_header();

// Retrieve the saved JSON data
$properties = get_option('precon_progress', []);
?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Properties Grid</h1>

        <!-- Search bar -->
        <div class="mb-4">
            <input
                    type="text"
                    id="property-search"
                    class="form-control"
                    placeholder="Search for properties by title...">
        </div>

        <!-- Properties Grid -->
        <div id="properties-grid" class="row">
            <?php if (!empty($properties)): ?>
                <?php foreach ($properties as $property): ?>
                    <div class="col-md-4 property-item mb-4" data-title="<?php echo esc_attr($property['name']); ?>">
                        <div class="card">
                            <img
                                    src="<?php echo esc_url($property['logo']); ?>"
                                    class="card-img-top"
                                    style="height: 370px;object-fit: scale-down;"
                                    alt="<?php echo esc_attr($property['name']); ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo esc_html($property['name']); ?></h5>
                                <a href="<?php echo esc_url($property['link']); ?>" class="btn btn-primary" target="_blank">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No properties found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            // Search functionality
            $('#property-search').on('input', function() {
                var query = $(this).val().toLowerCase();

                $('.property-item').each(function() {
                    var title = $(this).data('title').toLowerCase();
                    if (title.includes(query)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

<?php
get_footer();
