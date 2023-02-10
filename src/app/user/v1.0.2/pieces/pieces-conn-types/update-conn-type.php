
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
<!-- start pieces type page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header mb-3">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES AND CLIENTS', $_SESSION['systemLang']) ?></h1>
        <!-- <h5 class="h5 text-capitalize text-secondary "><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES TYPES', $_SESSION['systemLang']) ?></h5>         -->
        <h5 class="h5 text-capitalize text-secondary "><?php echo language('EDIT CONNECTION TYPES', $_SESSION['systemLang']) ?></h6>
        <?php
            // get connection type id
            $connTypeID = isset($_POST['conn-type-id']) && !empty($_POST['conn-type-id']) ? $_POST['conn-type-id'] : '';
            // get connection type name
            $newConnTypeName = isset($_POST['new-conn-type-name']) && !empty($_POST['new-conn-type-name']) ? $_POST['new-conn-type-name'] : '';
            // get connection type notes
            $newConnTypeNote = isset($_POST['new-conn-type-note']) && !empty($_POST['new-conn-type-note']) ? $_POST['new-conn-type-note'] : '';

            // type name validation
            if (!empty($newConnTypeName) && checkItem("`id`", "`conn_types`", $connTypeID) > 0) {
                // check if type is exist or not
                if (countRecords("`conn_name`", "`conn_types`", "WHERE `id` <> $connTypeID AND `conn_name` = '$newConnTypeName'") > 0) {
                    // echo danger message
                    $msg = '<div class="alert alert-danger text-capitalize" dir=""><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;' . language('THIS NAME IS ALREADY EXIST', $_SESSION['systemLang']) . '</div>';
                } else {
                    // insert query
                    $q = "UPDATE `conn_types` SET `conn_name` = ?, `notes` = ? WHERE `id` = ?";
                    $stmt = $con->prepare($q);
                    $stmt->execute(array($newConnTypeName, $newConnTypeNote, $connTypeID));
                    
                    // echo success message
                    $msg = '<div class="alert alert-success text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('CONNECTION TYPE UPDATED SUCCESSFULLY', $_SESSION['systemLang']) . '</div>';
                }
            } else {
                // data missed
                $msg = '<div class="alert alert-warning text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('CONNECTION TYPE CANNOT BE EMPTY', $_SESSION['systemLang']) . '</div>';
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