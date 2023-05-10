<?php if (!is_home()) : ?>
    <div class="wrap-search position-relative">
        <div class="input-group">
            <input autocomplete="off" name="address" type="search" onkeyup="hlr_search()" class="form-control input-search keyword" placeholder="Search by location..." aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-search"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="search-result"></div>
    </div>
<?php endif; ?>