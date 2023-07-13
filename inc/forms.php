<?php

add_shortcode('hlr-contact-form', 'hlr_contact_form');
function hlr_contact_form()
{
?>
    <div class="container">
        <div class="row py-5">
            <div class="col-6 my-3">
                <label for="fname">First Name</label>
                <input class="form-control" type="text" name="fname" id="fname">
            </div>
            <div class="col-6 my-3">
                <label for="lname">Last Name</label>
                <input class="form-control" type="text" name="lname" id="lname">
            </div>
            <div class="col-6 my-3">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="col-6 my-3">
                <label for="phone">Phone Number</label>
                <input class="form-control" type="text" name="phone" id="phone">
            </div>
            <div class="col-12 my-3">
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
            <div class="col-6 my-2 d-none brokerage">
                <input class="form-control" type="text" placeholder="Your Brokerage Name" name="brokerage" id="brokerage">
            </div>
            <div class="col-12 my-3">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>

            <div class="col-12 my-3">
                <button id="send" class="btn btn-block btn-primary">Send</button>
            </div>

            <div class="col-12 my-3 d-none success-message">
                <small class="text-success"></small>
            </div>
        </div>
    </div>

    <script>
        var brokerage = 'No Brokerage';

        jQuery('input[name="realtor"]').click(function() {
            if (jQuery(this).is(':checked')) {
                if (jQuery(this).val() == 1) {
                    jQuery('.brokerage').removeClass('d-none');
                    brokerage = '';
                } else {
                    jQuery('.brokerage').addClass('d-none');
                }
            }
        });

        jQuery('#send').click(function() {

            jQuery('.input-error').remove();
            jQuery('.input-error').remove();
            jQuery('.success-message').addClass('d-none');
            jQuery('.success-message small').text('');
            if (brokerage == '') {
                brokerage = jQuery('.brokerage').val();
            }
            console.log(brokerage);
            jQuery.ajax({
                type: "POST",
                url: 'https://hlrtest.hlric.com/api/v1/get-form',
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
                        jQuery.each(response.data, function(index, error) {
                            jQuery('#' + index).after('<small class="text-danger input-error">' + error + '</small>');
                        });
                    } else if (response.status == 'success') {
                        jQuery('.success-message').removeClass('d-none');
                        jQuery('.success-message small').text(response.data);
                    }
                }
            });
        });
    </script>
<?php
}
