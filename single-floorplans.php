<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
$floorplans = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
?>
<div class="container-fluid px-0 mt-lg-5 mt-2">
    <div class="content">
        <div class="row mb-lg-4 mb-2">
            <div class="col-12 mb-4">
                <h4 class="font-weight-bold h3">Browse more Imperia Condos by Truman Floor Plans</h4>
            </div>
            <div class="col-12">
                <div class="btn-group submitter-group float-left">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Status</div>
                    </div>
                    <select class="form-control status-dropdown">
                        <option value="">All</option>
                        <option value="Sold Out">Sold Out</option>
                        <option value="Available">Available</option>
                    </select>
                </div>
            </div>
            <!-- <div class="col-8">
                    <div class="filter-wrapper">
                        <input type="checkbox" class="filter-checkbox" value="Software Engineer" /> Software Engineer
                        <input type="checkbox" class="filter-checkbox" value="Accountant" /> Accountant
                        <input type="checkbox" class="filter-checkbox" value="Sales Assistant" /> Sales Assistant
                        <input type="checkbox" class="filter-checkbox" value="Developer" /> Developer
                    </div>
                </div>
                <div class="col-4">
                    <div class="btn-group submitter-group float-right">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Status</div>
                        </div>
                        <select class="form-control status-dropdown">
                            <option value="">All</option>
                            <option value="Sold Out">Sold Out</option>
                            <option value="Available">Available</option>
                        </select>
                    </div>
                </div> -->
        </div>
    </div>
    
</div>
<?php get_footer(); ?>