
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
<!-- start pieces type page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header mb-3">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('THE DIRECTIONS', $_SESSION['systemLang']) ?></h1>
        <h5 class="h5 text-capitalize text-secondary "><?php echo language('ADD NEW DIRECTION', $_SESSION['systemLang']) ?></h6>        
        
        <?php
            // get direction name
            $dirName = isset($_POST['direction-name']) && !empty($_POST['direction-name']) ? $_POST['direction-name'] : '';
            // get direction ip
            $dirIP = isset($_POST['direction-ip']) && !empty($_POST['direction-ip']) ? $_POST['direction-ip'] : '';

            // direction name validation
            if (!empty($dirName)) {
                // check if direction is exist or not
                if (checkItem("`direction_name`", "`direction`", $dirName) > 0) {
                    // echo danger message
                    $msg = '<div class="alert alert-danger text-capitalize" dir=""><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;' . language('THIS NAME IS ALREADY EXIST', $_SESSION['systemLang']) . '</div>';
                } else {
                    // insert query
                    $q = "INSERT INTO `direction` (`direction_name`, `direction_ip`, `added_date`, `added_by`) VALUES (?, ?, 'CURRENT_DATE', ?);";
                    $stmt = $con->prepare($q);
                    $stmt->execute(array($dirName, $dirIP, $_SESSION['UserID']));
        
                    // echo success message
                    $msg = '<div class="alert alert-success text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('A NEW DIRECTION ADDED SUCCESSFULLY', $_SESSION['systemLang']) . '</div>';
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