<?php if (!is_home()) : ?>
    <div class="wrap-search position-relative">
        <div class="input-group">
            <input autocomplete="no-autocomplete" type="search" onkeyup="hlr_search()" class="form-control input-search keyword" placeholder="Search by location..."  aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-search"><i class="fa fa-search"></i></button>
            </div>  
        </div>    
        <div class="search-result"></div>
    </div>
<?php endif;?>