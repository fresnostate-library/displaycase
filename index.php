<?php
define("VERSION", '2.0.6');
error_reporting(0);

/**
 * This is the processing page for the DisplayCase which interacts with a Google 
 * Sheet (API) and displays filterable content "cards" using the data found there.
 *
 * IMPORTANT: This script is intended to run from a browser request, which creates/bakes 
 * new page content upon each request.
 *
 * NOTE: This is a procedural page and it outputs HTML which is immediately displayed.
 *
 * PHP version 7
 *
 * @category   LIBWebApplication
 * @package    DisplayCase
 * @author     Steven Orr <sorr@mail.fresnostate.edu>
 * @copyright  2022 Fresno State Library, Fresno State 
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 * @link       https://github.com/fresnostate-library/displaycase
*/

// ########## Simple check for configuration files
clearstatcache();
if (
    !file_exists('configuration.php') or 
    !file_exists('assets/includes/custom-css.htm') or 
    !file_exists('assets/includes/custom-js.htm') or 
    !file_exists('assets/includes/footer.php') or 
    !file_exists('assets/includes/header.php') 
) {
    header('Refresh: 1;url=test/config-files.html'); 
    exit;
}

// ########## Set up script environment
$cfg = include('configuration.php');
$scriptPathFromWebRoot = '/' . $cfg->pathFromWebRoot . '/';
$breadcrumbArray = $cfg->breadcrumb;
$apiKey = $cfg->googleApiKey;
$sheetId = $cfg->googleSheetId;

// ########## Start gathering necessary data
$tabVariable = $_GET["tab"];

// Send the visitor away if they've requested no tab
if (empty($tabVariable)) {
    header('Refresh: 1;url='.$cfg->redirectURL); 
    exit;
}
$sheetTabName = $tabVariable;
$baseUrl = 'https://sheets.googleapis.com/v4/spreadsheets/';
$requestUrl = $baseUrl . $sheetId . '/values/' . $sheetTabName . '?key=' . $apiKey;

// ########## Pull JSON data from API
$json = file_get_contents($requestUrl);
if(!$json) {
    $json = '{ "values": [ [ "Nonconfigured Display" ], [ "You have not found a valid Google Sheet tab." ], [ "Title", "Content", "Image", "Link", "Keyword" ], [ "404 Not Found", "Content needs to be created or API Key is invalid.", "", "", "404" ] ] }';
}
$sheetData = json_decode($json, true);
if(count($sheetData["values"]) <= 3) {
    $sheetData["values"][] = [ "204 No Content", "Valid Sheet with no content.", "", "", "204" ];
}

// ########## Parse JSON data into HTML content
$count = 0;
$pageTitle = '';
$pageDesc = '';
$itemsHtml = '';
$keywords = [];
foreach($sheetData['values'] as $item) {

    // Only parse if NOT the page title or description
    if($count > 2) {
        $itemKeywords = [];
        $filterClass = '';
        $keywordPieces = explode(',', $item[4]);
        foreach ($keywordPieces as $key) {
            if (empty($key)) {
                $filterClass .= 'misc' . ' ';
                $itemKeywords[] = 'Misc';
            } else {
                $filterClass .= strtolower(trim($key)) . ' ';
                $itemKeywords[] = ucfirst(trim($key));
            }
        }
        unset($key); 
    
        $itemContent = '<div class = "col-lg-4 col-md-6 ' . rtrim($filterClass) . '">
    <div class="display-item" onclick="location.href=\'' . $item[3] . '\';" style="cursor:pointer;">
        <div class="display-img">
            <img src="' . $item[2] . '" class="img-fluid d-block mx-auto" alt="" role="presentation">
        </div>
        <div class="display-content p-3">
            <span class="d-block text-uppercase fw-bold">' . $item[0] . '</span>
            <span class="d-block">' . $item[1] . '</span>
        </div>
    </div>
</div>';
        $keywords = array_merge($itemKeywords, $keywords);
        $itemsHtml .= $itemContent;
    } elseif ($count == 1) {
        $pageDesc = (!empty($item[0])) ? trim($item[0]) : '';
    } elseif ($count == 0) {
        $pageTitle = (!empty($item[0])) ? trim($item[0]) : 'Unset Title';
    }
    $count++;
} 

// Prepare the filter buttonsfor display
$filterButtons = '';
foreach(array_unique($keywords) as $filter) {
    $filterButtons .= '<button type="button" data-filter=".' . strtolower($filter) . '" class="btn btn-primary m-1 text-dark" title="Filter by ' . $filter . '">' . $filter . '</button>';
}

// Construct the breadcrumb trail
$bc = '';
$size = count($breadcrumbArray);
for($i = 0; $i < $size; $i++) {
    $bc .= ($i != 0) ? ' &nbsp; / &nbsp; ' : '';
    $bc .= '<a href="' . $breadcrumbArray[$i][1] . '">' . $breadcrumbArray[$i][0] . '</a>';
}

// ########## Display HTML and results, inline
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="DisplayCase v<?php echo VERSION; ?> (https://github.com/fresnostate-library/displaycase)" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle . ' @ ' . $cfg->orgName; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel = "stylesheet" href = "<?php echo $scriptPathFromWebRoot; ?>assets/displaycase-styles.css">

    <?php include 'assets/includes/custom-css.htm'; ?>

    <?php include 'assets/includes/custom-js.htm'; ?>

</head>
<body>

    <?php include 'assets/includes/header.php'; ?>

    <div id="top" class="container">

        <div id="breadcrumb">
            <div class="breadcrumb">
                <?php echo $bc; ?>
            </div>
        </div>

        <div class="row">
            <div class="col text-center my-4">
                <h1 class="fs-2"><?php echo $pageTitle; ?></h1>
                <div class="underline mx-auto mt-3"></div>
            </div>
        </div>

        <?php if (!empty($pageDesc)): ?>
        <div class="row">
            <div class="col text-center">
                <p><?php echo $pageDesc; ?></p>
            </div>
        </div>
        <?php endif; ?>

        <div class="row mt-3 mb-4 button-group filter-button-group">
            <div class="col d-flex flex-wrap justify-content-center">
                <button type="button" data-filter="*" class="btn btn-primary m-1 text-dark" title="Filter none, Show All">All</button>

                <?php echo $filterButtons; ?>

            </div>
        </div>

        <div class="row justify-content-center g-4" id="display-list">

            <?php echo $itemsHtml; ?>   

        </div> <!-- // #display-list -->

        <p class="return-top mb-2">
            <a href="#top" title="Return to Page Top">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="16 12 12 8 8 12"></polyline><line x1="12" y1="16" x2="12" y2="8"></line></svg> 
                Top
            </a>
        </p>

    </div> <!-- // .container -->

    <?php include 'assets/includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>

    <script src = "<?php echo $scriptPathFromWebRoot; ?>assets/displaycase-scripts.js" defer></script>
</body>
</html>
