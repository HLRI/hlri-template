<?php get_header(); ?>
<?php
$psd = properties_single_cached();
$associated_floorplansDetails = associated_floorplans_cached();
$associated_floorplans = associated_floorplans_cached();
$data = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
function addOrdinalSuffix($number)
{
    return $number . ($number % 100 == 11 || $number % 100 == 12 || $number % 100 == 13 ? 'th' : ['th', 'st', 'nd', 'rd'][$number % 10] ?? 'th');
}
?>

<?php //include HLR_THEME_COMPONENT . 'navigation-single-property.php' ?>

    <div id="navigation-fixed-location"></div>
    <div class="container-lg px-lg-5">



    <!-- Content Section  -->


    <br><br>


<?php get_footer(); ?>