<?php /* Template Name: Project-progress-list Template */ ?>

<?php get_header(); ?>
<?php $theme_options = get_option('hlr_framework'); ?>
    <div>
              <?php
                if (!empty($theme_options['opt-about-title'])) {
                    $page_title = "Project Progress List";
                }
                else {
                    $page_title = 'Home Leader Realty Inc.'; // Default value
                }
                // Override the global define for a specific page
                define('CUSTOM_PAGE_HEADER', [
                    'title' => $page_title,
                    'subtitle' => 'HLRI Hub',
                ]);

                // Include the custom-page-header.php file
                include(HLR_THEME_COMPONENT . 'custom-page-header.php');
              ?>

            <div class="container position-relative pb-4" style="z-index:10;" >
                <div class="w-75 mx-auto my-4 d-flex justify-content-center align-items-center">
                    <input type="text" class="form-control" id="search-input" placeholder="Search for projects...">
                </div>  
                <div class="row progress-list" id="progress-list" >
                </div>    
            </div>
    </div>


    <script> 
            jQuery(document).ready(function() {
                let fetchItems = [];
                let postList = jQuery('#progress-list');
                let searchInput = jQuery('#search-input');


                 // Function to render list               
                function renderList(items) {
                    postList.empty(); 
                    items.forEach(function(project) {

                        let postItem = jQuery('<div class="col-12 col-sm-12 col-md-6 col-lg-3 p-2" >')
                        let postBox = jQuery('<a class="progress-list-item">').attr({ href: project.forumLink, target:"_blank" });
                        let logoPath = project.logo.replace('storage/', 'https://hlrihub.com/storage/'); 
                        let postImage = jQuery(' <img class="w-100" >').attr({ src: logoPath, alt: project.name });
                        let postLink = jQuery('<a>').attr({ href: project.forumLink, target:"_blank" }).text(project.name);
                        let postTitle = jQuery('<h3 class="text-muted">').text(project.name);

                        postItem.append(postBox);
                        postBox.append(postImage);
                        postBox.append(postLink);
                        postBox.append(postTitle);
                        postList.append(postItem);
                    });
                }

                function renderError(error){
                     postList.empty();
                    let errorMsg = jQuery('<div class=" w-100 alert alert-danger" role="alert">').text(`${error} please refresh the page `)
                    postList.append(errorMsg)
                    
                }

                // Function to filter items based on the search input
                function filterItems(term) {
                    let filteredItems = fetchItems.filter(function(item) {
                        return item.name.toLowerCase().includes(term.toLowerCase());
                    });
                    renderList(filteredItems);
                }

                // Initial loading of posts
                 loadPosts();
                



                // Search input event handler
                searchInput.on('input', function() {
                    let searchTerm = jQuery(this).val();
                    filterItems(searchTerm);
                });

                // 
                function loadPosts() {
                    // Show loading indicator
                    postList.html('<div class="w-100 d-flex justify-content-center align-items-center"> <div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div> </div>');
    
                    // handle request to server
                    jQuery.ajax({
                        method:"GET",
                        url: "/wp-admin/admin-ajax.php",
                        data: {
                            action: "get_PreConstruction",
                        },
                        success: function(res) {
                            // show items
                            setTimeout(function() {
                                postList.empty();
                                renderList(res.data);
                                fetchItems = res.data;
                            }, 1000); 
                        },
                        error: function(jqXHR, textStatus, errorThrown) { 
                            renderError(`${textStatus} (${errorThrown}) `)
                            console.log('Error fetching pre construction:', textStatus, errorThrown);
                        }
                    });
                }
            });
    </script>
<?php get_footer(); ?>