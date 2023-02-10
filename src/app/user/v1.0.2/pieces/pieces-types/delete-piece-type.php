
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
<!-- start pieces type page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header mb-3">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES AND CLIENTS', $_SESSION['systemLang']) ?></h1>
        <h5 class="h5 text-capitalize text-secondary "><?php echo language('DELETE PIECE TYPE', $_SESSION['systemLang']) ?></h6>        
        
        <?php
            // get type id
            $typeid = isset($_POST['deleted-type-id']) && !empty($_POST['deleted-type-id']) ? $_POST['deleted-type-id'] : '';

            // check if type is exist or not
            if (!empty($typeid) && checkItem("`type_id`", "`types`", $typeid) > 0) {
                // update all pieces with this deleted type to 0
                $updateQ = "UPDATE `pieces` SET `type_id` = 0 WHERE `type_id` = $typeid";
                $stmt = $con->prepare($updateQ);
                $stmt->execute();

                // delete query
                $q = "DELETE FROM `types` WHERE `type_id` = $typeid";
                $stmt = $con->prepare($q);
                $stmt->execute();
            
                // echo success message
                $msg = '<div class="alert alert-success text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('PIECE TYPE DELETED SUCCESSFULLY', $_SESSION['systemLang']) . '</div>';
            } else { ?>
                <!-- start page not found 404 -->
                <div class="page-error">
                    <img src="<?php echo $assets ?>images/no-data-founded.svg" class="img-fluid" alt="<?php echo language("NO DATA FOUNDED", $_SESSION['systemLang']) ?>">
                </div>
                <!-- end page not found 404 -->
            <?php
                // error message
                $msg = '<div class="alert alert-danger text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'. language('NO DATA FOUNDED', $_SESSION['systemLang']) .'</div>';
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