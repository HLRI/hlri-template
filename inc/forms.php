<?php
// Properties Form
add_shortcode('hlr-contact-form', 'hlr_contact_form');
function hlr_contact_form()
{
?>
    <div class="container">
        <div class="row py-2">
            <div class="col-12 col-md-6 my-2">
                <label for="fname">First Name</label>
                <input class="form-control" type="text" name="fname" id="fname">
            </div>
            <div class="col-12 col-md-6 my-2">
                <label for="lname">Last Name</label>
                <input class="form-control" type="text" name="lname" id="lname">
            </div>
            <div class="col-12 col-md-6 my-2">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="useremail">
            </div>
            <div class="col-12 col-md-6 my-2">
                <label for="phone">Phone Number</label>
                <input class="form-control" type="text" name="phone" id="phone">
            </div>
            <div class="col-12 my-2">
                <p><label for="realtor">Are you a realtor?</label></p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="realtor" id="realtor2" value="0" checked>
                    <label class="form-check-label" for="realtor2">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="realtor" id="realtor1" value="1">
                    <label class="form-check-label" for="realtor1">Yes</label>
                </div>
            </div>
            <div class="col-12 my-2 d-none brokerage">
                <input class="form-control" type="text" placeholder="Your Brokerage Name" name="brokerage" id="brokerage">
            </div>
            <div class="col-12 my-2">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>

            <div class="col-12 my-2">
                <a id="send" class="btn-block top-section-button">
                    Send
                </a>
            </div>

            <div class="col-12 my-2 d-none success-message">
                <small class="text-success"></small>
            </div>
        </div>
    </div>


    <?php

    add_action('wp_footer', 'form_scripts');
    function form_scripts()
    {
    ?>
        <script>
            var brokerage = 'No Brokerage';

            jQuery('input[name="realtor"]').click(function() {
                if (jQuery(this).is(':checked')) {
                    if (jQuery(this).val() == 1) {
                        jQuery('.brokerage').removeClass('d-none');
                        brokerage = '';
                    } else {
                        jQuery('.brokerage').addClass('d-none');
                        brokerage = 'No Brokerage';
                    }
                }
            });

            jQuery('#send').click(function() {

                jQuery('#send').html('<span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span> <span class="sr-only">Processing...</span>');

                jQuery('.input-error').remove();
                jQuery('.input-error').remove();
                jQuery('.success-message').addClass('d-none');
                jQuery('.success-message small').text('');
                if (brokerage == '') {
                    brokerage = jQuery('#brokerage').val();
                }

                jQuery.ajax({
                    type: "POST",
                    url: '<?= home_url('/') ?>api/v1/get-form',
                    dataType: "json",
                    data: {
                        'fname': jQuery('input[name="fname"]').val(),
                        'lname': jQuery('input[name="lname"]').val(),
                        'email': jQuery('input[name="email"]').val(),
                        'phone': jQuery('input[name="phone"]').val(),
                        'brokerage': brokerage,
                    },
                    success: function(response) {
                        if (response.status == 'errors') {
                            jQuery('#send').html('Send');
                            jQuery.each(response.data, function(index, error) {
                                jQuery('#' + index).after('<small class="text-danger input-error">' + error + '</small>');
                            });
                        } else if (response.status == 'success') {
                            jQuery('#send').html('Send');
                            jQuery('.success-message').removeClass('d-none');
                            jQuery('.success-message small').text(response.data);
                        }
                    }
                });
            });
        </script>
<?php
    }
}

//  Contact Us From
add_shortcode('hrl_contact_us_form', 'hlr_contact_us_form');
function hlr_contact_us_form()
{
?>
    <div class="container">
        <div class="row gap-2 mx-auto mt-4 flex-column flex-md-row justify-content-between w-100">
            <div class="col-md-4 my-2">
                <label for="fname">First Name</label>
                <input class="form-control" type="text" name="fname" id="fname">
            </div>
            <div class="col-md-4 my-2">
                <label for="lname">Last Name</label>
                <input class="form-control" type="text" name="lname" id="lname">
            </div>
            <div class="col-md-4 my-2">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="col-md-12 my-2">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>

            <div class="col-md-4 my-2">
                <a id="send" class="btn-block top-section-button">
                    Send
                </a>
            </div>

            <div class="col-12 my-2 d-none success-message">
                <small class="text-success"></small>
            </div>
        </div>
    </div>


    <?php

    add_action('wp_footer', 'contact_us_form_scripts');
    function contact_us_form_scripts()
    {
    ?>
        <script>
           
            jQuery('#send').click(function() {

                jQuery('#send').html('<span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span> <span class="sr-only">Processing...</span>');
                jQuery('.input-error').remove();
                jQuery('.input-error').remove();
                jQuery('.success-message').addClass('d-none');
                jQuery('.success-message small').text('');

                jQuery.ajax({
                    type: "POST",
                    url: '<?= home_url('/') ?>api/v1/get-form',
                    dataType: "json",
                    data: {
                        'fname': jQuery('input[name="fname"]').val(),
                        'lname': jQuery('input[name="lname"]').val(),
                        'email': jQuery('input[name="email"]').val(),
                        'email': jQuery('input[name="message"]').val(),
                    },
                    success: function(response) {
                        if (response.status == 'errors') {
                            jQuery('#send').html('Send');
                            jQuery.each(response.data, function(index, error) {
                                jQuery('#' + index).after('<small class="text-danger input-error">' + error + '</small>');
                            });
                        } else if (response.status == 'success') {
                            jQuery('#send').html('Send');
                            jQuery('.success-message').removeClass('d-none');
                            jQuery('.success-message small').text(response.data);
                        }
                    }
                });
            });
        </script>
<?php
    }
}

//  Contact Me From
add_shortcode('hrl_contact_me_form', 'hlr_contact_me_form');
function hlr_contact_me_form()
{
?>
    <div class="container">
        <div class="row gap-2 mx-auto mt-4 flex-column flex-md-row justify-content-between w-100">
            <div class="col-md-4 my-2">
                <label for="fname">First Name</label>
                <input class="form-control" type="text" name="fname" id="fname">
            </div>
            <div class="col-md-4 my-2">
                <label for="lname">Last Name</label>
                <input class="form-control" type="text" name="lname" id="lname">
            </div>
            <div class="col-md-4 my-2">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="col-md-12 my-2">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>
            <input class="d-hidden" style="width:0; height:0; display:none;" value="<?php the_title() ?>"  type="text" name="agent_name">
            <div class="col-md-4 my-2">
                <a id="send" class="btn-block top-section-button">
                    Send
                </a>
            </div>

            <div class="col-12 my-2 d-none success-message">
                <small class="text-success"></small>
            </div>
        </div>
    </div>


    <?php

    add_action('wp_footer', 'contact_us_form_scripts');
    function contact_us_form_scripts()
    {
    ?>
        <script>
           
            jQuery('#send').click(function() {

                jQuery('#send').html('<span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span> <span class="sr-only">Processing...</span>');
                jQuery('.input-error').remove();
                jQuery('.input-error').remove();
                jQuery('.success-message').addClass('d-none');
                jQuery('.success-message small').text('');

                jQuery.ajax({
                    type: "POST",
                    url: '<?= home_url('/') ?>api/v1/get-form',
                    dataType: "json",
                    data: {
                        'fname': jQuery('input[name="fname"]').val(),
                        'lname': jQuery('input[name="lname"]').val(),
                        'email': jQuery('input[name="email"]').val(),
                        'email': jQuery('input[name="message"]').val(),
                    },
                    success: function(response) {
                        if (response.status == 'errors') {
                            jQuery('#send').html('Send');
                            jQuery.each(response.data, function(index, error) {
                                jQuery('#' + index).after('<small class="text-danger input-error">' + error + '</small>');
                            });
                        } else if (response.status == 'success') {
                            jQuery('#send').html('Send');
                            jQuery('.success-message').removeClass('d-none');
                            jQuery('.success-message small').text(response.data);
                        }
                    }
                });
            });
        </script>
<?php
    }
}


//  Join Our Team From
add_shortcode('hrl_join_our_team_form', 'hlr_join_our_team_form');
function hlr_join_our_team_form()
{
?>
    <div class="container">
        <div class="row gap-2 mx-auto mt-4 flex-column gap-3 justify-content-between w-100">
            <div class="col my-2">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name">
            </div>
            <div class="col my-2">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
              <div class="col my-2">
                <label for="phone">Phone Number</label>
                <input class="form-control" type="text" name="phone" id="phone">
            </div>
            <div class="col my-2">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>
            <input class="d-hidden" style="width:0; height:0; display:none;" value="<?php the_title() ?>"  type="text" name="agent_name">
            <div class="col my-2">
                <a id="send" class="btn-block top-section-button">
                    Send
                </a>
            </div>

            <div class="col-12 my-2 d-none success-message">
                <small class="text-success"></small>
            </div>
        </div>
    </div>


    <?php

    add_action('wp_footer', 'contact_us_form_scripts');
    function contact_us_form_scripts()
    {
    ?>
        <script>
           
            jQuery('#send').click(function() {

                jQuery('#send').html('<span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span> <span class="sr-only">Processing...</span>');
                jQuery('.input-error').remove();
                jQuery('.input-error').remove();
                jQuery('.success-message').addClass('d-none');
                jQuery('.success-message small').text('');

                jQuery.ajax({
                    type: "POST",
                    url: '<?= home_url('/') ?>api/v1/get-form',
                    dataType: "json",
                    data: {
                        'name': jQuery('input[name="name"]').val(),
                        'email': jQuery('input[name="email"]').val(),
                        'phone': jQuery('input[name="phone"]').val(),
                        'message': jQuery('input[name="message"]').val(),
                    },
                    success: function(response) {
                        if (response.status == 'errors') {
                            jQuery('#send').html('Send');
                            jQuery.each(response.data, function(index, error) {
                                jQuery('#' + index).after('<small class="text-danger input-error">' + error + '</small>');
                            });
                        } else if (response.status == 'success') {
                            jQuery('#send').html('Send');
                            jQuery('.success-message').removeClass('d-none');
                            jQuery('.success-message small').text(response.data);
                        }
                    }
                });
            });
        </script>
<?php
    }
}