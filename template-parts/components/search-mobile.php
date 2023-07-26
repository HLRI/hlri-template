<?php if (!is_home()) : ?>
    <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog m-0" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body px-2 py-3">
                    <div class="position-relative">
                        <div class="input-group">
                            <input autocomplete="off" name="address" type="text" onkeyup="hlr_search_mobile()" class="form-control input-search keyword-mobile" placeholder="Search by location...">
                        </div>
                        <div class="search-result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>