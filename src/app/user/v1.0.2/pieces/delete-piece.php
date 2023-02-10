<?php
// check if Get request pieceid is numeric and get the integer value
$pieceid = isset($_GET['pieceid']) && is_numeric($_GET['pieceid']) ? intval($_GET['pieceid']) : 0;
// get piece name
$pieceName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = ".$pieceid)[0]['piece_name'];
// get user info from database
$check = checkItem('piece_id', 'pieces', $pieceid);
// check if exist
if ($check > 0) {
    // select type of the given id
    $srcPiece = selectSpecificColumn("`type_id`", "`pieces`", "WHERE `piece_id` = " . $pieceid );

    // check the piece type
    if ($srcPiece[0]['type_id'] != 4) {
        // check if the piece have a children or not
        $countChild = countRecords("`piece_id`", "`pieces`", "WHERE `source_id` = " . $pieceid );
    } else {
        $countChild = 0;
    }
?>
    <!-- start edit profile page -->
    <div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <!-- start header -->
        <header class="header mb-5">
            <h1 class="text-capitalize"><?php echo language('DELETE', $_SESSION['systemLang'])." ".language('PIECE/CLIENT', $_SESSION['systemLang']) ?></h1>
            <?php if ($check > 0 && $countChild == 0) {
                // delete query
                $q  = "DELETE FROM `pieces` WHERE `pieces`.`piece_id` = $pieceid ; ";
                $q .= "DELETE FROM `pieces_phone` WHERE `pieces_phone`.`piece_id` = $pieceid; ";
                $q .= "DELETE FROM `pieces_addr` WHERE `pieces_addr`.`piece_id` = $pieceid; ";
                $q .= "DELETE FROM `pieces_additional` WHERE `pieces_additional`.`piece_id` = $pieceid; ";
                // prepare query
                $stmt = $con->prepare($q);
                $stmt->execute();
                // log message
                $logMsg = "Delete piece or client with name `" . $pieceName . "`";
                createLogs($_SESSION['UserName'], $logMsg, 3);
                // page message
                $msg = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;' . language("PIECE/CLIENT DELETED SUCCESSFULLY", $_SESSION['systemLang']) .'</div>';
                redirectHome($msg);
            } elseif ($check == 0) { 
                
                // include no data founded module
                include_once 'global-modules/no-data-founded.php';
            
            } else {
                // log message
                $logMsg = "You cannot delete the piece because it hase more than 1 child..";
                // createLogs($_SESSION['UserName'], $logMsg, 2);

                $msg = '<div class="alert alert-danger text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'. language('YOU CANNOT DELETE THIS PIECE BECAUSE IT HAVE MORE THAN 1 CHILD', $_SESSION['systemLang']) .'</div>';
                redirectHome($msg, 'back');
            } ?>
        </header>
        <!-- end header  -->
    </div>
<?php } else {

    // include page error (page not found) module
    include_once 'global-modules/page-error.php';

} ?>