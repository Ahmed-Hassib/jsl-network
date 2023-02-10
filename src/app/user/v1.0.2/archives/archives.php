<?php
// start output buffering
ob_start();
// start session
session_start();
// regenerate session id
session_regenerate_id();
// check username in SESSION variable
// title page
$pageTitle = "Archive";
// level
$level = 5;
// nav level
$nav_level = 1;
// initial configration of system
include_once str_repeat("../", $level) . "etc/init.php";

if (isset($_SESSION['UserName']) && $_SESSION['isLicenseExpired'] == 0 && $_SESSION['archive_show'] == 1) {
    
    // check if Get request do is set or not
    $query = isset($_GET['do']) && !empty($_GET['do']) ? $_GET['do'] : 'manage';
    
    // start dashboard page
    // start manage page
    if ($query == "manage") {       // manage page
    
        // include archive`s dashboard page
        include_once $curr_version . '/archives/dashboard.php';
        
    } elseif ($query == "piecesArchive") {

        // include pieces archive page
        include_once $curr_version . '/archives/pieces-archive.php';
        
    } elseif ($query == "malfunctionsArchive") {
    } elseif ($query == "combinationsArchive") {
    } else {
        
        // include page error module
        include_once $app . 'global-modules/page-error.php';
        
    }
    
} else {
    
    // include permission error module
    include_once $app . 'global-modules/permission-error.php';
    
}

// include footer
include_once $tpl . "footer.php"; 
include_once $tpl . "js-includes.php";

ob_end_flush();
