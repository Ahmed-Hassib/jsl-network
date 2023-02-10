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
$pageTitle = isset($_GET['name']) ? $_GET['name'] : 'NOT ASSIGNED';
// level
$level = 5;
// nav level
$nav_level = 1;
// initial configration of system
include_once str_repeat("../", $level) . "etc/init.php";
// refere to that this page have tables
$is_contain_table = true;
// check username in SESSION variable
if (isset($_SESSION['UserName']) && $_SESSION['isLicenseExpired'] == 0) {
    
    // check if Get request do is set or not
    $query = isset($_GET['do']) ? $_GET['do'] : 'manage';
    // start manage page
    if ($query == 'manage') {
    
        // include pieces` dashboard
        include_once $curr_version . '/pieces/dashboard.php';
        
    } elseif ($query == 'showAllPieces' && $_SESSION['pcs_show'] == 1) {
        
        // include show all pieces page
        include_once $curr_version . '/pieces/show-all-pieces.php';
        
    } elseif ($query == 'showAllClients' && $_SESSION['pcs_show'] == 1) {
        
        // include show all clients page
        include_once $curr_version . '/pieces/show-all-clients.php';
        
    } elseif ($query == 'addPiece' && $_SESSION['pcs_add'] == 1) {

        // include show all pieces page
        include_once $curr_version . '/pieces/add-new-piece.php';
        
    } elseif ($query == 'insertPiece' && $_SESSION['pcs_add'] == 1) { 
        
        // include show all pieces page
        include_once $curr_version . '/pieces/insert-piece.php';
        
    } elseif ($query == 'editPiece' && $_SESSION['pcs_update'] == 1) {
        
        // include show all pieces page
        include_once $curr_version . '/pieces/edit-piece.php';
        
    } elseif ($query == 'updatePieceInfo' && $_SESSION['pcs_update'] == 1) {
        
        // include update piece info page
        include_once $curr_version . '/pieces/update-piece-info.php';
        
    } elseif ($query == 'deletePiece' && $_SESSION['pcs_delete'] == 1) {
        
        // include delete piece page
        include_once $curr_version . '/pieces/delete-piece.php';
        
    } elseif ($query == 'showPiece' && $_SESSION['pcs_show'] == 1) {
        
        // include show piece page
        include_once $curr_version . '/pieces/show-piece.php';

    } elseif ($query == 'piecesTypes' && $_SESSION['pcs_show'] == 1) {
        
        // include pieces types page
        include_once $curr_version . '/pieces/pieces-types.php';

    } elseif ($query == 'insertPieceType' && $_SESSION['pcs_show'] == 1) {
        
        // include pieces types page
        include_once $curr_version . '/pieces/pieces-types/insert-piece-type.php';
    
    } elseif ($query == 'updatePieceType' && $_SESSION['pcs_show'] == 1) {
        
        // include pieces types page
        include_once $curr_version . '/pieces/pieces-types/update-piece-type.php';

    } elseif ($query == 'showConnectionTypes' && $_SESSION['pcs_show'] == 1) {
        
        // include pieces connection page
        include_once $curr_version . '/pieces/pieces-connection-types.php';
        
    } elseif ($query == 'controlColumns' && $_SESSION['pcs_show'] == 1) {
        
        // include control tables column page
        include_once $curr_version . '/pieces/control-table-columns.php';

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
