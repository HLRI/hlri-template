<?php if (!is_home()) : ?>
    <div class="wrap-search position-relative">
        <div class="input-group">
            <input name="type" type="text" class="form-control">
            <div class="input-group-append">
                <button class="btn btn-search"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="search-result"></div>
    </div>
<?php endif; ?>