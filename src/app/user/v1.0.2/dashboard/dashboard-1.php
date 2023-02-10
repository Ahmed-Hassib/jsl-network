<?php

// start output buffering
ob_start();
// start session
session_start();
// regenerate session id
session_regenerate_id();
// title page
$pageTitle = "Dashboard";
// level
$level = 5;
// nav level
$nav_level = 1;
// initial configration of system
include_once str_repeat("../", $level) . "etc/init.php";
// check username in SESSION variable
if (isset($_SESSION['UserName'])) {
    // check the request
    $query = isset($_GET['do']) ? $_GET['do'] : 'manage';
    // check
    if ($query == 'manage') {
        // check the version
        include_once $curr_version . '/dashboard/dashboard.php';
    } elseif ($query == 'version-info') {
        // check the version
        include_once $curr_version . '/dashboard/version-info.php';
    }

    // footer
    include_once $tpl . "footer.php"; 
    include_once $tpl . "js-includes.php";
} else {
    header("Location: ../login.php");
    exit();
}

ob_end_flush();
?>