<?php

add_shortcode('hlr-contact-form', 'hlr_contact_form');
function hlr_contact_form()
{
?>
    <div class="container">
        <div class="row py-5">
            <div class="col-12">
                <div class="my-4">
                    <label for="name">name</label>
                    <input class="form-control" type="text" name="name" placeholder="name">
                </div>
                <div class="my-4">
                    <button class="btn btn-primary">send</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
