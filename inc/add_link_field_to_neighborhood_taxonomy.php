<?php
function taxonomy_add_custom_field() {
    ?>
    <div class="form-field term-image-wrap">
        <label for="cat-image">Link</label>
        <input type="text" name="neighborhood_link" value="" size="40" />
    </div>
    <?php
}
add_action( 'neighborhood_add_form_fields', 'taxonomy_add_custom_field', 10, 2 );
 
function taxonomy_edit_custom_field($term) {
    $link = get_term_meta($term->term_id, 'neighborhood_link', true);
    ?>
    <tr class="form-field term-image-wrap">
        <th scope="row"><label for="neighborhood_link">Link</label></th>
        <td>
            <input type="text" name="neighborhood_link" value="<?php echo $link; ?>" size="40" />
        </td>
    </tr>
    <?php
}
add_action( 'neighborhood_edit_form_fields', 'taxonomy_edit_custom_field', 10, 2 );

function save_taxonomy_custom_meta_field( $term_id ) {
    if ( isset( $_POST['neighborhood_link'] ) ) {
        update_term_meta($term_id, 'neighborhood_link', $_POST['neighborhood_link']);
    }
}  
add_action( 'edited_neighborhood', 'save_taxonomy_custom_meta_field', 10, 2 );  
add_action( 'create_neighborhood', 'save_taxonomy_custom_meta_field', 10, 2 );