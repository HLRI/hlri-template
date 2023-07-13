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
                    <input class="form-control" type="text" name="name" placeholder="name" id="name">
                </div>
                <div class="my-4">
                    <button id="send" class="btn btn-primary">send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery('#send').click(function() {
            jQuery.ajax({
                type: "POST",
                url: 'https://hlrtest.hlric.com/api/v1/get-form',
                dataType: "json",
                data: {
                    'name': jQuery('input[name="name"]').val(),
                },
                success: function(response) {
                    if (response.status == 'errors') {
                        jQuery.each(response.data, function(index, error) {
                            jQuery('#' + index).after('<small class="text-danger">' + error + '</small>');
                        });
                    }
                }
            });
        });
    </script>
<?php
}
