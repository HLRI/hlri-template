<?php

add_shortcode('hlr-contact-form', 'hlr_contact_form');
function hlr_contact_form()
{
    $form = new Formr\Formr('bootstrap');
    ?>
    <div class="container">
        <div class="row py-5">
            <div class="col-12">
                <?php $form->create_form('Name, Email, Comments|textarea'); ?>
            </div>
        </div>
    </div>
    <?php
}
