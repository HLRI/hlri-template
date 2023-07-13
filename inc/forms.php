<?php

add_shortcode('hlr-contact-form', 'hlr_contact_form');
function hlr_contact_form()
{
?>
    <div class="container">
        <div class="row py-5">
            <div class="col-6 my-4">
                <label for="fname">First Name</label>
                <input class="form-control" type="text" name="fname" id="fname">
            </div>
            <div class="col-6 my-4">
                <label for="lname">Last Name</label>
                <input class="form-control" type="text" name="lname" id="lname">
            </div>
            <div class="col-6 my-4">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="col-6 my-4">
                <label for="phone">Phone Number</label>
                <input class="form-control" type="text" name="emaiphonel" id="phone">
            </div>

            <div class="col-12 my-4">
                <label for="realtor">Are you a realtor?</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="realtor" id="realtor1" value="1">
                    <label class="form-check-label" for="realtor1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="realtor" id="realtor2" value="0">
                    <label class="form-check-label" for="realtor2">No</label>
                </div>
            </div>
            <div class="my-4">
                <button id="send" class="btn btn-primary">Send</button>
            </div>

            <div class="my-4 d-none success-message">
                <small class="text-success"></small>
            </div>
        </div>
    </div>

    <script>
        jQuery('#send').click(function() {

            jQuery('.input-error').remove();
            jQuery('.success-message').addClass('d-none');
            jQuery('.success-message small').text('');

            jQuery.ajax({
                type: "POST",
                url: 'https://hlrtest.hlric.com/api/v1/get-form',
                dataType: "json",
                data: {
                    'name': jQuery('input[name="name"]').val(),
                    'email': jQuery('input[name="email"]').val(),
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
