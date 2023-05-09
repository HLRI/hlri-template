<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-3">
                <?php echo $theme_options['opt-popup-content'] ?>
                <div class="popup-shortcode">
                    <?= do_shortcode($theme_options['opt-popup-shortcode']) ?>
                </div>
            </div>

        </div>
    </div>
</div>