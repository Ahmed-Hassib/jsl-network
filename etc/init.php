<?php

// connect to database from configration file
// include_once 'server-conf.php';
include_once 'local-conf.php';
// developer name
$developerName = "ahmed hassib";
// company name
$appName = "sys tree";
// is app suspended
$isDeveloping = false;
// get user version of system
$curr_version = isset($_SESSION['curr_version_name']) ? $_SESSION['curr_version_name'] : "v1.0.3";

// Routes
$src        = $up_level  . "src/";                      // root directory

// SYS TREE DIRECTORY
$app        = $src      . "app/";
$descpg     = $app      . "desc/";                      // Description Directory for pages
$globmod    = $app      . "global-modules/";            // Global modules Directory for pages
$requests   = $app      . "requests/";                  // Requests Directory

// INCLUDES DIRECTORY
$includes   = $up_level  . "includes/";                 // Template Directory
$tpl        = $includes  . "templates/";                // Template Directory
$lan        = $includes  . "languages/";                // Languages Directory
$func       = $includes  . "functions/";                // Functions Directory
$lib        = $includes  . "libraries/";                // Libraries Directory

// LANDING PAGE DIRECTORY
$landpg         = $src      . "landing-page/";
$landpg_css     = $landpg   . "css/";
$landpg_js      = $landpg   . "js/";
$landpg_src     = $landpg   . "src/";
$landpg_images  = $landpg   . "images/";

// LAYOUT DIRECTORY
$layout     = $up_level  . "layout/";                   // layout directory
$css        = $layout    . "css/";                      // CSS Directory
$js         = $layout    . "js/";                       // JS Directory
$node       = $layout    . "node_modules/";             // node module Directory
$fonts      = $layout    . "fonts/";                    // fonts Directory

// ASSETS DIRECTORY
$assets     = $up_level  . "assets/";                   // Assets Directory

// DATA DIRECTORY
$data       = $up_level  . "data/";                     // Data Directory
$uploads    = $data      . "uploads/";                  // Uploads Directory
$backups    = $data      . "backups/";                  // Backups Directory
$descdata   = $data      . "description/";              // Description Directory for videos
$json       = $data      . "json/";                     // Json Directory
$dirs       = $json      . "dirs/";                     // Dirs Directory


// include_once the important files
include_once $func   . "functions.php";
include_once $lan    . "language.php";


// include_once header in all pages expect pages include_once noHeader
if (!isset($noHeader)) {
    include_once $tpl . "header.php";
}


// include_once navbar in all pages expect pages include_once noNavBar
if (!isset($noNavBar)) {
    // include_once check version script
    include_once 'check-version.php';
    // check if root
    if (isset($_SESSION['isRoot'])) {
        if ($_SESSION['isRoot'] == 1) {  
            include_once $tpl . "navbar/" . $curr_version ."/admin-navbar.php";
        } else {
            include_once $tpl . "navbar/" . $curr_version ."/main-navbar.php";
        }
    }
} elseif (isset($noNavBar) && $noNavBar === "primary") {
    include_once $tpl . "navbar/" . $curr_version ."/primary-navbar.php";
}

// // next step::
// // include preloader
// // before all pages` content
// include_once $landpg . "preloader.php";