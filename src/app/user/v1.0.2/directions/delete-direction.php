
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
<!-- start pieces type page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header mb-3">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('THE DIRECTIONS', $_SESSION['systemLang']) ?></h1>
        <h5 class="h5 text-capitalize text-secondary "><?php echo language('DELETE DIRECTION', $_SESSION['systemLang']) ?></h6>        

        <?php
            // get direction id
            $directionid = isset($_POST['deleted-dir-id']) && !empty($_POST['deleted-dir-id']) ? $_POST['deleted-dir-id'] : '';
           
            // direction name validation
            if (!empty($directionid) && checkItem("`direction_id`", "`direction`", $directionid) > 0) {
                // check if direction name is exist or not
                if (countRecords("`piece_id`", "`pieces`", "WHERE `direction_id` = $directionid") > 0) {
                    // echo danger message
                    $msg = '<div class="alert alert-danger text-capitalize" dir=""><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;' . language('CANNOT DELETE THIS DIRECTION BECAUSE THIS DIR CONTAINS ONE PIECE OR MORE', $_SESSION['systemLang']) . '</div>';
                    
                    // waiting time
                    $seconds = 5;
                } else {
                    // insert query
                    $q = "DELETE FROM `direction` WHERE `direction_id` = ?";
                    $stmt = $con->prepare($q);
                    $stmt->execute(array($directionid));
                    
                    // echo success message
                    $msg = '<div class="alert alert-success text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('DIRECTION DELETED SUCCESSFULLY', $_SESSION['systemLang']) . '</div>';
                    
                    // waiting time
                    $seconds = 3;
                }
            } else {
                // data missed
                $msg = '<div class="alert alert-warning text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('DIRECTION NAME CANNOT BE EMPTY', $_SESSION['systemLang']) . '</div>';
            }
            // redirect to home page
            redirectHome($msg, "back", $seconds);
        ?>
    </header>
</div>
<?php } else {

    // include permission error module
    include_once 'global-modules/permission-error.php';

} ?>