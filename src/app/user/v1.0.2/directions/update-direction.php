
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
<!-- start pieces type page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header mb-3">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('THE DIRECTIONS', $_SESSION['systemLang']) ?></h1>
        <h5 class="h5 text-capitalize text-secondary "><?php echo language('EDIT DIRECTION', $_SESSION['systemLang']) ?></h6>        

        <?php
            // get direction id
            $directionid = isset($_POST['updated-dir-id']) && !empty($_POST['updated-dir-id']) ? $_POST['updated-dir-id'] : '';
            // get direction new name
            $newDirectionName = isset($_POST['new-direction-name']) && !empty($_POST['new-direction-name']) ? $_POST['new-direction-name'] : '';
            // get direction new ip
            $newDirectionIP = isset($_POST['new-direction-ip']) && !empty($_POST['new-direction-ip']) ? $_POST['new-direction-ip'] : '';

            // direction name validation
            if (!empty($newDirectionName) && checkItem("`direction_id`", "`direction`", $directionid) > 0) {
                // check if direction name is exist or not
                if (countRecords("`direction_name`", "`direction`", "WHERE `direction_id` <> $directionid AND `direction_name` = '$newDirectionName'") > 0) {
                    // echo danger message
                    $msg = '<div class="alert alert-danger text-capitalize" dir=""><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;' . language('THIS NAME IS ALREADY EXIST', $_SESSION['systemLang']) . '</div>';
                } else {
                    // insert query
                    $q = "UPDATE `direction` SET `direction_name` = ?, `direction_ip` = ? WHERE `direction_id` = ?";
                    $stmt = $con->prepare($q);
                    $stmt->execute(array($newDirectionName, $newDirectionIP, $directionid));
                    
                    // echo success message
                    $msg = '<div class="alert alert-success text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('DIRECTION UPDATED SUCCESSFULLY', $_SESSION['systemLang']) . '</div>';
                }
            } else {
                // data missed
                $msg = '<div class="alert alert-warning text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('DIRECTION NAME CANNOT BE EMPTY', $_SESSION['systemLang']) . '</div>';
            }
            // redirect to home page
            redirectHome($msg, "back");
        ?>
    </header>
</div>
<?php } else {

    // include permission error module
    include_once 'global-modules/permission-error.php';

} ?>