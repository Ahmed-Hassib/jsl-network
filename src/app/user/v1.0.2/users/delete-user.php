<?php    
// check if Get request userid is numeric and get the integer value
$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
// get user info from database
$check = checkItem("UserID", "users", $userid);
// get user name
$username = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$userid)[0]['UserName'];
?>
<!-- start edit profile page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header">
        <h1 class="text-capitalize"><?php echo language('DELETE', $_SESSION['systemLang'])." ".language('THE EMPLOYEE', $_SESSION['systemLang']) ?></h1>
        <?php
        if ($check > 0) {
            $q  = "DELETE FROM `users`                  WHERE `UserID` = ?;";
            $q .= "DELETE FROM `users_points`           WHERE `UserID` = ?;";
            $q .= "DELETE FROM `users_permissions`      WHERE `UserID` = ?;";
            $q .= "DELETE FROM `users_pieces_columns`   WHERE `UserID` = ?;";
            $stmt = $con->prepare($q);
            $stmt->execute(array($userid, $userid, $userid, $userid));
            // log message
            $logMsg = "Users dept:: user deleted successfully.";
            createLogs($_SESSION['UserName'], $logMsg);
            
            $msg  = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;an user was deleted succefully!</div>';

            redirectHome($msg);
        } else {
            // include no data founded module
            include_once 'global-modules/no-data-founded.php';
        }
        ?>
    </header>
</div>