<?php

add_shortcode('hlr-contact-form', 'hlr_contact_form');
function hlr_contact_form()
{
    $form = new Formr\Formr('bulma');
    $form->create_form('Name, Email, Comments|textarea');
}
