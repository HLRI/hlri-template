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

//function add_developers_to_taxonomy() {
//    $developers_list = array(
//        '10Block Studio Inc','3Arc Development','95 Developments Inc','A1 Developments','Ace Development Ltd','Acorn Developments','Activa','Addington Developments','Adi Development Group','Algar Developments Inc','ALIT Developments','Alliance United Corporation','Allied Properties','Almadev','Alterra','Altree Developments','Amacon','Ambria Homes','Amelin Properties','Amexon Development','Amico Properties','Andiel Homes','Andrin Homes','Angil Development','Aoyuan International','Apex Development Group','Aracon Homes','Arista Homes','Armour Heights Developments','Arya Corporation','Aspen Ridge Homes','Atria Development Corporation','Auriga Homes','Avalee Homes','Averton','AvranceCorp Development','Baif Developments','Balder Corporation','Ballantry Homes','Ballymore Homes','Batavia Homes','Battistella Developments','BAZIS','Beaverhall Homes','Berkley Homes','Berkshire Axis Development','Biddington Homes','Blackdoor Development Company','Block Developments','Bloomfield Urban Homes','Bosseini Living','Brandy Lane Homes','Branthaven','Briarwood Development Group','Brivia Group','Brixen Developments Inc','Broccolini','Bromont Homes','Brookfield Residential','BSäR Group of Companies','BSÃ¤R Group of Companies','Buildcrest','Building Capital','Burnac','Cachet Homes','Cadillac Fairview Corporation','Caivan Communities','Caliber Homes','Calibrex Developments','Camrost Felcorp','Canderel Residential','Canlight Realty Corp','Canvas Developments','Capital Developments','Capital North Communities','Capitol Buildings','Capstone Developments','Carlyle Communites','Carriage Gate Homes','Carttera Private Equities','Castle Group Developments','Castlemount Homes','Castleridge Homes','Cathedraltown Courtyard 1 Limited Partnership','Centra Homes','CentraCondos Group','CentreCourt','Centrestone Urban Developments Inc','Centreville Homes','Centurion Homes','Chestnut Hill Developments','City Park Homes','Cityzen Development Group','Cliffside Homes','Clifton Blake','Club Leisure Corporation','Coletara Development','Collecdev','Concert','Concord Adex','Concord Pacific','Condoman Developments Inc','Constantine Enterprises Inc','Construct & Conserve','Consulate Development Group','Context','Core Development Group','Corebridge','Cortel Group','Cosmopolitan Homes','Coughlan Homes','CountryWide Homes','Cresford Development Corporation','Crimson Cove Homes','Crown Communities','Crystal Homes','CTN Developments Inc','Curated Properties','Daffodil Developments','Damac Properties','Dash Developments Inc','Davenleigh Homes','Davpart','Dazz Group','DBS Developments','DECO Homes','Delpark Homes','Democrat Homes','DeSantis Homes','Devonleigh Homes','Devron','Diamante Development Corporation','Diamond Kilmer Developments','Diamondcorp','Dicenzo Homes','Digreen Homes','Distrikt Developments','Domus Developments','Dormer Homes','Downing Street Group','Dream','Dundee Kilmer Developments Limited','Dunpar Homes','Dunsire Developments','DVLP Property Group Inc','E Squared Developments','Eagle Crest Construction','Eastrose Homes','Eden Oak','Edenshaw Developments','Edgemont Homes','Edilcan Development Corporation','Effort Trust','Elad Canada','Elite Developments','EllisDon Capital','Elm Developments','Emblem Developments','Empire Communities','Emshih Developments','eQ Homes','Eringate Homes','Eringate homes','Esquire Homes','Essence Homes','Evendale Developments','Evertrust Development Group','Falconcrest Homes','Fengate Asset Management','Fernbrook Homes','Fieldgate Construction Management Ltd','Fieldgate Homes','Fieldgate Urban','Fifth Avenue Homes','Firmland Developments Corporation','First Avenue Properties','First Capital','Flato Developments Inc','Forest Green Homes','Forest Hill Homes','Format Group','Fortress Real Developments','Fourteen Estates','Fram & Slokker','FRAM Building Group','Freed Developments','Freure Homes','Frontdoor Developments','Fulton Group','Fusion Homes','G Group Development Corp','Gable View Homes','Gairloch','GALA Developments','Garden Homes','Gary Silverberg','GCL Builds','Gemini Homebuilders','Georgian International','Geranium','Gillam Group','Globizen Developments','Gold Park Homes','Golden Falcon Homes','Go-To Developments','Grand Brook Homes','Grand Grace Development','Granite Homes','Graywood Developments Ltd','Great Gulf','Great Lands Corporation','Greatwise Developments','Green City Development','Greenland Group (Canada)','Greenpark Group','Greentown Developments','Greybrook Realty Partners','Grid Developments','Grove Inc','GSH Developments','Guglietti Brothers Investments','H & W Developments','H&R REIT','Hallett Homes','Hans Group','Harhay Developments','Harlo Capital','Harry Stinson','Haven Developments','Hawk Development','Hazelton Developments','HBNG Holborn Group','Heathwood','Heller Highwater Developments Inc','Highcastle Homes','Highmark Homes','Hines','HIP Developments','Hi-Rise (West) Inc','Hi-Rise Group','Hirsch & Associates','Hollyburn Properties','Homes By Avi','Homes by John Bruce Robinson','Honeyfield Communities','Hopewell Residential','Hub Harcroft Developments Ltd','Hullmark','Huron Creek Developments','Hyde Park Homes','i2 Developments','Icon Homes','Ideal Developments','Identity Developments Inc','iKORE Developments Ltd','Immobilier Baker','Impressions Group','IN8 Developments','inCAN Developments','Infinity Fine Homes','Inmino Developments Inc','Insoho Developments','Intentional Capital','Intracorp','Ironwood Bay','Isroc Building International','Janik Group','JD Development Group','Jeffery Homes','John Boddy Homes','Kaitlin Corporation','Kaleido Corporation','Kalexia Developments','Kaneff Corporation','Katz Group','Kayra Holdings','Kayra Holdings','Kettlebeck','Kilmer Group','Kingdom Developments','Kingsett Capital','Kingsmen Group Inc','Kingwood Homes','Knightstone Capital Management Inc','Krugarand Corporation','KUBO Developments','Kultura','Kylemore Communities','La Pue International','Laguna Mar Holdings Inc','Lakeside Developments Inc','Lakeview Development Holdings Inc','Lakeview Homes','Lamb Development Corp','Lancaster Homes Inc','Landing Development Group','Landmart Homes','Lanterra Developments','Lash Group of Companies','Latch Developments','Laurier Homes','LCH Developments','LeBANC','Ledgemark Homes','Liberty Development Corporation','Liberty Hamlets','Lifetime Developments','Lindvest','LIV Communities','LiVante Developments','LJM Developments','Lorenzo Developments INC','Lormel Homes','Losani Homes','Luxuria Homes','MacPherson Master Builders','Madison Group','Main + Main','Malen Capital','Malibu Investments Inc','Mansouri Living','Maple Valley Development Corporation','Maplebrook Homes','Marino Developments','Marken Homes','MarketVision Real Estate Corporation','Marlin Spring','Marshall Homes','MaryDel Homes','Marz Homes','Maskeen','Matrix Development Group','Mattamy (Monarch) Limited','Mattamy Homes','Mattamy Homes Canada','Mayfair Communities Inc','MDM Developments','Medallion Capital Group','Menkes Developments Ltd','Metropia','Metroview Developments','MGM Development','Midhaven Homes','Milani Group','Millborne Group','Minto Communities','Mizrahi Developments','MOD Developments Inc','Modeno Homes','Modern Skyline','Molinaro Group','Molinaro Group','Momentum Developments','Monaco Development GP Partners Ltd','Monde Development Group','Monza Condos','Mosaik Homes','Mountainview Building Group','Mutual Developments','Nahid Corp','Nascent Developments Inc','National Homes','New Era Developments','New Horizon Development Group','Nexus Developments','NIACON','Niche Development','Nikori','NOC Development','Norstar Group of Companies','North American Development Group','North Drive','North Town Homes','Northrop Development Incorporated','Nova Ridge Development Partners Inc','NVSBLE Development','Ocgrow Group of Companies','Old Orchard Development','Old Orchard Homes','Oldstonehenge','ONE Properties','One Urban','Onni Group of Companies','Options for Homes','Opus Homes','Originate Developments Inc','Oxford Properties','Pace Developments Inc','Pamata Hospitality Inc','Paradise Developments','Parallax Development Corporation','Parallex Development','Parkbridge','Patry Group','Pemberton Group','Phantom Developments','Pickering towns Seaton Taunton Mattamy','"Pinedale Properties, Ltd"','Pinewood Niagara Builders','Pinnacle International','Platinum Vista','Plaza','Plaza Partners','Podium Developments','Poetry Living','Polocorp Inc','Pratt Homes','Premcor Homes','Presidential Group','Prica Global Enterprises','Primont Homes','Pristine Homes','Priva Homes','Profile Developments Inc','Projectcore Inc','Quadcam Development Group Incorporated','QuadReal','Queenscorp Group','Queensgate Homes','Queensville Developments','R.A.M Contracting Limited','Real Estate Inverlad','ReBuilt Construction','Red Rock','RedBerry Homes','Regal Crest Homes','Reids Heritage Homes','Remington Homes','Republic Developments','Reserve Properties','Revation Group','Ridgeview Homes','RioCan Living','Rise Developments','Ritz Homes','Rivermill Homes','Rockport Group','Rogers Real Estate Development Limited','Rohit Communities','Ros-Bay Developments Inc','Rosehaven Homes','Rosewater Capital Group','Rowntree Enterprises','Royal Pine Homes','Royalcliff Homes','Royalpark Homes','Royalton Homes Inc','Saberwood Homes','Sanderling Developments','Scholar Properties Ltd','Sean Homes','Sean Homes','Senator Homes','Sequoia Grove Homes','Serena Homes','Seven Developments','Shane Baghai','Sherwood Homes Ltd','Sierra Building Group','Sierra Communities','Signature Carleton Inc','SigNature Communities','SilverCreek Group','Silvergate Homes','Skale Developments','SkyHomes Corporation','Skyline Resort Communities','Slate Asset Management','Slokker Real Estate Group','SmartCentres','Society Developments Inc','Solmar Development Corp','Solotex Group','Sophies Landing Development Corp','Sorbara Group of Companies','Sphere Developments','Spotlight Development','Springfield Construction','St Davids Development','St. Thomas Developments Inc','Stafford Homes','Star Residence','Starbank Group of Companies','Starfish Properties','Starlane Homes','State Building Group','Stateview Homes','Sterling Group','Stonepay','Streetcar Developments','Sundance Homes','Sundial Homes Limited','Sunfield Homes Ltd','Sunny Communities','Sunray Group Developments','Sunrise Gate Homes','Sunrise Homes','Sutherland Development Group','TACC Developments','TAS','Tenblock','Tercot Communities','Terracap','TFS Capital','TG Beco Ltd','The Benvenuto Group','The Conservatory Group','The Daniels Corporation','The Goldman Group','The Goldman Group','The Gupta Group','The Rockport Group','The Rose Corporation','The Sher Corporation','The Sud Group','TianQing Group','Tiffany Park Homes','Time Development Group Inc','Times Group Corporation','Tonlu Properties','Torbel Group','Tower Hill Development Corporation','Townwood Homes','Treasure Hill Homes','TriAxis','Tribute Communities','Tricon Residential','Tridel','Trimax Developments','Trinity Development Group','Trinity Point','Triumph Developments','Triumphant Group','Trolleybus Urban Development Inc','Trulife Developments','Truman','UNIQ Communities','United Lands','Urban Capital','Urban Legend Developments','Urbane Communities','Valour Group','VANDYK Properties','VanMar Developments','Venetian Development Group','Vermilion Developments','Westbank Corp','Westdale Properties','Will-O Homes','Windmill Developments Group Ltd','Wintrup Developments','Woodcliffe Landmark Properties','Worsley Urban','WP Development Inc','Wycliffe Homes','Wyview Group','York Trafalgar Homes','Your Home Developments','Your Pratt Homes Alliston','YYZed Project Management','Zancor Homes','Zinc Developments','Zonix Group','Allegra Homes','Blue Goose Developments Inc','Lifestyle Custom Homes'
//    );
//
//    $taxonomy = 'developer';
//
//    foreach ($developers_list as $developer_name) {
//        // Check if the term already exists before adding it to avoid duplicates
//        $existing_term = term_exists($developer_name, $taxonomy);
//
//        if (!$existing_term) {
//            // If the term doesn't exist, add it
//            wp_insert_term($developer_name, $taxonomy);
//        }
//    }
//}
//add_action('init', 'add_developers_to_taxonomy');