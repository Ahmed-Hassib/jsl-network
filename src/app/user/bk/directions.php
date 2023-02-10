<?php

/**
 * PIECES PAGE
 */
// start output buffering
ob_start();
// start session
session_start();
// regenerate session id
session_regenerate_id();
// page title
$pageTitle = "the directions";
// level
$level = 5;
// nav level
$nav_level = 1;
// initial configration of system
include_once str_repeat("../", $level) . "etc/init.php";
// check username in SESSION variable
if (isset($_SESSION['UserName']) && $_SESSION['isLicenseExpired'] == 0) {
    // check if Get request do is set or not
    $query = isset($_GET['do']) ? $_GET['do'] : 'manage';
    // start manage page
    if ($query == "manage") { // manage page
        // include direction`s dashboard
        include_once $curr_version . '/directions/dashboard.php';        
    
    } elseif ($query == 'insertDir' && $_SESSION['dir_add'] == 1) {
        // include insert direction page
        include_once $curr_version . '/directions/insert-direction.php';

    } elseif ($query == 'showDir' && $_SESSION['dir_show'] == 1) {    
        // include show direction page
        include_once $curr_version . '/directions/show-direction.php';
        
    } elseif ($query == "updateDir" && $_SESSION['dir_update'] == 1) {
        // include update direction page
        include_once $curr_version . '/directions/update-direction.php';
        
    } elseif ($query == "deleteDir" && $_SESSION['dir_delete'] == 1) {
        // include delete direction page
        include_once $curr_version . '/directions/delete-direction.php';
        
    } else {
        // include page error page
        include_once $app . 'global-modules/page-error.php';
    }
} else {
    // include permission error page
    include_once $app . 'global-modules/permission-error.php';
}

if (!isset($noFooter)) {
    // include footer
    include_once $tpl . "footer.php"; 
}
include_once $tpl . "js-includes.php";
// 
ob_end_flush();
?>