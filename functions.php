<?php

if (!defined('ABSPATH')) {
    exit;
}


include 'constant.php';

include HLR_THEME_PATH . 'inc/match_elementor.php';
include HLR_THEME_PATH . '/lib/validation/vendor/autoload.php';
include HLR_THEME_PATH . '/lib/validation/canada_phone_rule.php';
include HLR_THEME_PATH . '/lib/vendor/autoload.php';
include HLR_THEME_PATH . 'lib/codestar/codestar-framework.php';
include HLR_THEME_PATH . 'inc/validate_codestar.php';
include HLR_THEME_PATH . 'lib/view-module/view.php';
include HLR_THEME_PATH . 'options.php';
include HLR_THEME_PATH . 'inc/init.php';
include HLR_THEME_PATH . 'inc/helper.php';
include HLR_THEME_PATH . 'inc/scripts.php';
include HLR_THEME_PATH . 'inc/ajax.php';
include HLR_THEME_PATH . 'inc/forms.php';
include HLR_THEME_PATH . 'inc/shortcodes.php';
include HLR_THEME_PATH . 'inc/post_types.php';
include HLR_THEME_PATH . 'inc/meta_boxes.php';
include HLR_THEME_PATH . 'inc/taxonomy.php';
include HLR_THEME_PATH . 'inc/visit_history.php';
include HLR_THEME_PATH . 'inc/admin_pages.php';
include HLR_THEME_PATH . 'inc/caching.php';

// function my_awesome_func_two()
// {
//     $args = array(
//         'post_type' => 'mapdata',
//         'post_status' => 'publish',
//         'posts_per_page' => -1,
//     );

//     $my_query = null;
//     $my_query = new WP_query($args);
//     if ($my_query->have_posts()) :
//         while ($my_query->have_posts()) : $my_query->the_post();
//             $mapMeta = get_post_meta(get_the_ID(), 'hlr_framework_map', true);
//             if (true == true) {
//                 if (!empty($mapMeta)) {
//                     $slug = get_post_field('post_name', get_post());


//                     if (!is_array($mapMeta['opt-type']) && $mapMeta['opt-type'] != null) {

//                         $mapMetaType = explode(',', $mapMeta['opt-type']);
//                     } else {
//                         $mapMetaType = $mapMeta['opt-type'];
//                     }

//                     $mapMetaType = array_map(function ($item) {
//                         return ($item == "Home") ? "Detached" : $item;
//                     }, $mapMetaType);

//                     $mapdata[] = [
//                         'post_id' => strval(get_the_ID()),
//                         'title' => get_the_title(),
//                         'available_floorplans' => $mapMeta[$mapMeta['opt-available-floorplans']],
//                         //                  'permalink' => get_the_permalink(),
//                         'permalink' => 'https://locatecondo.com/i/' . $slug,
//                         'updated' => get_the_date(),
//                         'address' => $mapMeta['opt-address'],
//                         'thumbnail' => get_the_post_thumbnail_url(),
//                         'pricepersqft' => $mapMeta['opt-pricepersqft'],
//                         'strings' => [],
//                         'terms' => $mapMeta['opt-incentives'],
//                         'price' => $mapMeta['opt-price'],
//                         'min_price' => $mapMeta['opt-price-min'],
//                         'max_price' => $mapMeta['opt-price-max'],
//                         'min_size' => $mapMeta['opt-size-min'],
//                         'max_size' => $mapMeta['opt-size-max'],
//                         'sales_type' => $mapMeta['opt-sales-type'],
//                         'min_bed' => $mapMeta['opt-min-bed'],
//                         'max_bed' => $mapMeta['opt-max-bed'],
//                         'min_bath' => $mapMeta['opt-min-bath'],
//                         'max_bath' => $mapMeta['opt-max-bath'],
//                         'type' => $mapMetaType,
//                         'min_price_sqft' => $mapMeta['opt-min-price-sqft'],
//                         'max_price_sqft' => $mapMeta['opt-max-price-sqft'],
//                         'sqft_avg' => $mapMeta['opt-sqft-avg'],
//                         'occupancy' => $mapMeta['opt-occupancy'],
//                         'coming_soon' => $mapMeta['opt-coming-soon'],
//                         'comission_by_percent' => $mapMeta['opt-comission-by-percent'],
//                         'comission_by_flatfee' => $mapMeta['opt-comission-by-flatfee'],
//                         'floorplans' => [],
//                         'city' => $mapMeta['opt-city'],
//                         'studio' => $mapMeta['opt-studio'],
//                         'status' => $mapMeta['opt-status'],
//                         'coords' => [$mapMeta['opt-coords']['longitude'], $mapMeta['opt-coords']['latitude']],
//                     ];
//                 }
//             }

//         endwhile;
//         wp_reset_postdata();
//     else :
//         _e('Sorry, no posts matched your criteria.');
//     endif;

//     return $mapdata;
// }
// add_action('rest_api_init', function () {
//     register_rest_route('mapdata/v2', '/getResult', array(
//         'methods' => 'GET',
//         'callback' => 'my_awesome_func_two',
//     ));
// });

//function add_sales_to_taxonomy() {
//    $sales_list = array(
//        'The Milborne Group','Spectrum Sky','In2ition','Brad J. Lamb Realty Inc','International Home Marketing Group','Aspen Ridge','Austin Birch Development Marketing','Baker Real Estate Incorporated','Broccolini','City Life Realty Ltd','Concert Realty Services','CONDO CULTURE, BROKERAGE','Cornerstone Marketing Realty Inc','Del Realty Inc Brokerage','Del Realty Inc','Blade Creative Branding','Eleven Eleven Real Estate Services Inc, Brokerage','Flato Developments Inc','Great Lands','Harbour Marketing Real Estate Brokerage','Harvey Kalles Real Estate Ltd, Brokerage','Hazelton Real Estate','Heaps Estrin Real Estate Team','Hersh Condos Inc Brokerage','HRG Realty Limited','Iconic Realty Brokerage','Kaitlin Corporation','Kevin Crigger Real Estate Team','Lindvest','MarketVision Real Estate Corporation','Mirabella Condos','Monaco Development Partners','mpact North Advertising','Paul Johnston Unique Urban Homes','PCA Project Marketing','Pemberton Group','Pinewood Niagara Builders','PMA Brethour Real Estate Corp. Inc, Brokerage','PMA Brethour Realty Group','PSR Brokerage Ltd','RAD Marketing and Sales','RARE Real Estate Inc','Regal Crest Homes','Rego Realty Inc','RLP CITIZEN Realty, Brokerage','Royal Lepage','Sixty-Five Broadway','Skylette Marketing Realty Incorporated','Sorbara Group of Companies','Stinson Developments','TFN Realty Inc','The Condo Store Realty Inc','Trace Property Group','Your Home Sold Guaranteed Realty of Canada','No Data','RDS','Hirsch & Associates','Spectrum Realty Services Inc','Maverick Graphics Inc','Intercity Realty','Ryan Design International','Sam McDadi Real Estate Inc','Kara Sutton','Captain Real Estate Group Ltd','Norman Hill Realty','Davie Real Estate Inc','Davies Condos','iRise Brokerage','Evertrust Development Group','Re/Max Real Estate Centre Inc','Your Advocates Realty Inc','Referral Network Realty, Brokerage','Goodale Miller Team - Century 21 Miller Real Estate Ltd','Bridlepath Progressive Real Estate Inc','ReMax Hallmark Realty Ltd','Torlon Realty Corporation Brokerage','BAZIS','Ellicott Realty Inc, Brokerage','Concord Adex','Urbane Communities','Fernbrook Homes','Matrix Development Group','LJM Developments','Originate Developments Inc','JD Development Group','Infinity Fine Homes','Rockport Group','Pinnacle International','Triumphant Group','Madison Group','CentreCourt','Brookfield Residential','The Conservatory Group','Fieldgate Homes','Truman','CentraCondos Group','Arya Corporation','Sundial Homes Limited','Graywood Developments Ltd','First Capital','Tercot Communities','Paradise Developments','Times Group Corporation','Ledgemark Homes','Royalpark Homes','Altree Developments','Stateview Homes','Activa','Laurier Homes','Fusion Homes','Ballymore Homes','Treasure Hill Homes','Granite Homes','New Horizon Development Group','Buildcrest','Coughlan Homes','Minto Communities Canada','Kylemore Communities','Concert','Branthaven','John Boddy Homes','Serena Homes','Crown Communities','Arista Homes','Fram & Slokker','Primont Homes','North Drive','Townwood Homes','Great Gulf','Mizrahi Developments','Dunpar Homes','Tribute Communities','Eastrose Homes','Lanterra Developments','Mattamy Homes','Tridel & Hines','Solmar Development Corp','Opus Signature Collection','Onni Group of Companies','Tridel','Plaza','Quadcam Development Group Incorporated','Alterra','Urban Capital','iKORE Developments Ltd','Mountainview Heights Phase 2 Sales','Milborne Group','Lancaster Homes Inc','Cortel Group','Diamond Kilmer Developments','Prompton Real Estate Services Inc Vancouver','Citizen Realty Inc, Brokerage','Forest Hill Real Estate, Yorkville','Corebridge','Bosseini Living','Aoyuan International','Prompton Real Estate Services Corp. Toronto','G. Ryan Design Inc','Freed Developments','Castle Group Developments','Bromont Homes','Edilcan Development Corporation','Skyline Marketing Realty Inc','Geranium','Ocgrow Group of Companies','Reids Heritage Homes','Streetcar Developments','Calibrex Developments','Mattamy Homes Canada','Davpart','Greenpark Group','Camrost Felcorp','Lash Group of Companies','Ideal Developments','Maskeen','Hazelton Developments','Empire Communities','Minto Communities','Davenleigh Homes','Real Estate Inverlad','Diamante Development Corporation','The Daniels Corporation','Marken Homes','Kaleido Corporation','Chestnut Hill Developments','Tiffany Park Homes','Harlo Capital','SigNature Communities','Venetian Development Group','Greybrook Realty Partners','Cityzen Development Group','Briarwood Development','Star Residence','Elite Developments','TAS','Andrin Homes','Brivia Group','Merx Realty Services Inc','CountryWide Homes','Lakeview Homes','Polocorp Inc','Essence Homes','Armour Heights Developments','Brick + Mortar','Trinity Point Developments','Condoville Realty Inc','INX Landmark Realty','CITIZEN + Ko','The Regional Group','ARA Real Estate Brokerage Ltd','Greg Syrota Team','RE/MAX Hallmark Batori Group','Boardwalk Group Realty Inc','Roxborough Realty Ltd','HomeLife/Metropark Realty Inc','The Spring Team','Sutton Group Future Realty Inc, Brokerage','Immobilier Baker','The Brokers Group - RE/MAX Noblecorp Real Estate','Coldwell Banker Ronan Realty','Cameron Stanley. Brokerage','Gilbert Realty Inc','Loyalty Real Estate','Revel Realty Inc Brokerage','Royal LePage Your Community Realty','Team 2000 Realty Inc, Brokerage','MAS CAPITAL INVESTMENT','Faris Team Real Estate Brokerage','Realty Wealth Group Inc','100 Acres Realty','Liberty Hill Realty Partners','Citi Brokers Realty Inc Brokerage','Impact North Beyond Marketing','Team RINE-Exp Realty Brokerage','Ferrow Real Estate Inc','TCS Marketing Systems Inc','James Benson Group','Pivot Real Estate Group, Brokerage','Davie Real Estate Inc','Bay Street Group Inc','Vong Realty Group','Jeff Cowan of Keller Williams Realty Centres','P2 Realty'
//    );
//
//    $taxonomy = 'sales-team';
//
//    foreach ($sales_list as $sales_name) {
//        // Check if the term already exists before adding it to avoid duplicates
//        $existing_term = term_exists($sales_name, $taxonomy);
//
//        if (!$existing_term) {
//            // If the term doesn't exist, add it
//            wp_insert_term($sales_name, $taxonomy);
//        }
//    }
//}
//add_action('init', 'add_sales_to_taxonomy');