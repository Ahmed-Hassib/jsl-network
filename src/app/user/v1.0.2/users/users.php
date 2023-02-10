<?php

/**
 * USERS PAGE
 */
// start output buffering
ob_start();
// start session
session_start();
// regenerate session id
session_regenerate_id();
// page title
$pageTitle = "The employees";
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

    // FILTER_SANITIZE_STRING
    // start manage page
    if ($query == "manage" && $_SESSION['user_show'] == 1) {       // manage page
    
        // include users` dashboard page
        include_once $curr_version . '/users/dashboard.php';
        
    } elseif ($query == "addUser" && $_SESSION['user_add'] == 1) {     // add new user page 
        
        // include add new user page
        include_once $curr_version . '/users/add-new-user.php';
        
    } elseif ($query == "insertUser" && $_SESSION['user_add'] == 1) {     // insert page
        
        // include insert user page
        include_once $curr_version . '/users/insert-user.php';
        
    } elseif ($query == "editUser") {     // edit page
        
        // include edit user page
        include_once $curr_version . '/users/edit-user.php';
        
    } elseif ($query == 'update') {    // update the profile
        
        // include update user page
        include_once $curr_version . '/users/update-user.php';
        
    } elseif ($query == 'deleteUser' && $_SESSION['user_delete'] == 1) {
        
        // include delete user page
        include_once $curr_version . '/users/delete-user.php';
        
    } elseif ($query == "addPoints" && $_SESSION['points_add'] == 1) { 
        
        // include insert points page
        include_once $curr_version . '/users/insert-points.php';

    } elseif ($query == 'addNewPoints' && $_SESSION['points_add'] == 1) {
        
        // include add new points page
        include_once $curr_version . '/users/add-new-points.php';
        
    } elseif ($query == 'motivationPoints' && $_SESSION['points_show'] == 1) {
        
        // include motivation points page
        include_once $curr_version . '/users/motivation-points.php';
    
    } elseif ($query == "deletePoints" && $_SESSION['points_delete'] == 1) {             
        
        // include delete points page
        include_once $curr_version . '/users/delete-points.php';

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
