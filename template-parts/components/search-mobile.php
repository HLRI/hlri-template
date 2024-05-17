<?php if (!is_home()) : ?>
    <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog m-0" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body px-2 py-3">
                    <div class="position-relative">
                        <div class="input-group">
                            <input autocomplete="off" name="address" id="mobile-search-field" type="search" onkeyup="hlr_search_mobile()" class="form-control input-search keyword-mobile" placeholder="Search by project name, city, neighborhood...">
                        </div>
                        <div class="search-result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get references to the search box and search button
        const searchBox = document.getElementById('mobile-search-field');

        // Add event listener for 'keypress' event on search box
        searchBox.addEventListener('keypress', function(event) {
            // Check if Enter key is pressed
            if (event.key === 'Enter') {
                hlr_search_mobile();
            }
        });
    </script>
<?php endif; ?>