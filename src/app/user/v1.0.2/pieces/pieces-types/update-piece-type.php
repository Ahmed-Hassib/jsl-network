
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
<!-- start pieces type page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header mb-3">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES AND CLIENTS', $_SESSION['systemLang']) ?></h1>
        <!-- <h5 class="h5 text-capitalize text-secondary "><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES TYPES', $_SESSION['systemLang']) ?></h5>         -->
        <h5 class="h5 text-capitalize text-secondary "><?php echo language('EDIT PIECE TYPES', $_SESSION['systemLang']) ?></h6>        
        
        <?php
            // get type id
            $typeid         = isset($_POST['type-id']) && !empty($_POST['type-id']) ? $_POST['type-id'] : '';
            // get type name
            $newTypeName    = isset($_POST['new-type-name']) && !empty($_POST['new-type-name']) ? $_POST['new-type-name'] : '';
            // get type notes
            $newTypeNote    = isset($_POST['new-type-note']) && !empty($_POST['new-type-note']) ? $_POST['new-type-note'] : '';

            // check if type is exist or not
            if (checkItem("`type_id`", "`types`", $typeid) > 0) {
                // type name validation
                if (!empty($newTypeName)) {
                    // check if type is exist or not
                    if (countRecords("type_id", "types", "WHERE `type_id` <> $typeid AND `type_name` = '$newTypeName'") > 0) {
                        // echo danger message
                        $msg = '<div class="alert alert-danger text-capitalize" dir=""><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;' . language('THIS NAME IS ALREADY EXIST', $_SESSION['systemLang']) . '</div>';
                    } else {
                        // update query
                        $q = "UPDATE `types` SET `type_name` = ?, `type_note` = ? WHERE `type_id` = $typeid";
                        $stmt = $con->prepare($q);
                        $stmt->execute(array($newTypeName, $newTypeNote));
                    
                        // echo success message
                        $msg = '<div class="alert alert-success text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('PIECE TYPE UPDATED SUCCESSFULLY', $_SESSION['systemLang']) . '</div>';
                    }
                } else {
                    // data missed
                    $msg = '<div class="alert alert-warning text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('PIECE TYPE CANNOT BE EMPTY', $_SESSION['systemLang']) . '</div>';
                }
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