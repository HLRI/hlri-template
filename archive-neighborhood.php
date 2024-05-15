<?php
/* Template Name: Archive Neighborhoods */
get_header();
echo '<div class="container">';
// Query all terms from the 'neighborhood' taxonomy
$neighborhoods = get_terms( array(
    'taxonomy' => 'neighborhood',
    'hide_empty' => false, // Set to true if you want to hide empty neighborhoods
) );

// Loop through each neighborhood
foreach ( $neighborhoods as $neighborhood ) {
    echo '<a href="https://condoy.com/neighborhood/' . $neighborhood->slug . '">' . $neighborhood->name . '</a>';
}
echo '</div>';

get_footer();
?>