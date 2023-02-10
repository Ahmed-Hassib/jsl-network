<?php
// start output buffering
ob_start();
// start session
session_start();
// regenerate session id
session_regenerate_id();
// get language from get method
$lang = isset($_GET['lang']) ? $_GET['lang'] : "ar";
// check language
$_SESSION['systemLang'] = $lang;
// no navbar
$noNavBar = true;
// boolean variable to check if this page is home
$isHomePage = true;
// page title
$pageTitle = "Leader Group Egypt";
// level
$level = 0;
// nav level
$nav_level = 0;
// initial configration of system
include_once str_repeat("../", $level) . "etc/init.php";
// check username in SESSION variable
if (isset($_SESSION['UserName'])) {
    if ($_SESSION['isRoot'] == 1) {
        // redirect to admin page
        header('Location: src/app/root/dashboard.php');  
        exit();
    } else {
        // redirect to user page
        header("Location: src/app/user/$curr_version/dashboard/index.php");  
        exit();
    }
}

// include landing page
include_once $landpg_src . "header.php";
include_once $landpg_src . "landing.php";
include_once $landpg_src . "articles.php";
include_once $landpg_src . "gallery.php";
include_once $landpg_src . "features.php";
include_once $landpg_src . "testimonials.php";
include_once $landpg_src . "team-members.php";
include_once $landpg_src . "services.php";
include_once $landpg_src . "footer.php";

// include js files
include_once $tpl . "js-includes.php";
ob_end_flush();
?>