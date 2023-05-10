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


function aw_include_script() {
  
    if ( ! did_action( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
  
    wp_enqueue_script( 'awscript', HLR_THEME_ASSETS. 'js/taxonomy-thumbnail.js', array('jquery'), null, false );
}
add_action( 'admin_enqueue_scripts', 'aw_include_script' );


function save_taxonomy_custom_meta_field( $term_id ) {
    if ( isset( $_POST['neighborhood_image'] ) ) {
        update_term_meta($term_id, 'neighborhood_image', $_POST['neighborhood_image']);
    }
}  
add_action( 'edited_neighborhood', 'save_taxonomy_custom_meta_field', 10, 2 );  
add_action( 'create_neighborhood', 'save_taxonomy_custom_meta_field', 10, 2 );