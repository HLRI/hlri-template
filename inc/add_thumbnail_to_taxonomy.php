<?php
function taxonomy_add_custom_field() {
    ?>
    <div class="form-field term-image-wrap">
        <label for="cat-image"><?php _e( 'Image' ); ?></label>
        <p><a href="#" class="aw_upload_image_button button button-secondary"><?php _e('Upload Image'); ?></a></p>
        <input type="text" name="neighborhood_image" id="cat-image" value="" size="40" />
    </div>
    <?php
}
add_action( 'neighborhood_add_form_fields', 'taxonomy_add_custom_field', 10, 2 );
 
function taxonomy_edit_custom_field($term) {
    $image = get_term_meta($term->term_id, 'neighborhood_image', true);
    ?>
    <tr class="form-field term-image-wrap">
        <th scope="row"><label for="neighborhood_image"><?php _e( 'Image' ); ?></label></th>
        <td>
            <p><a href="#" class="aw_upload_image_button button button-secondary"><?php _e('Upload Image'); ?></a></p><br/>
            <input type="text" name="neighborhood_image" id="cat-image" value="<?php echo $image; ?>" size="40" />
        </td>
    </tr>
    <?php
}
add_action( 'neighborhood_edit_form_fields', 'taxonomy_edit_custom_field', 10, 2 );