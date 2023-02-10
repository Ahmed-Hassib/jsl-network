
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
<!-- start pieces type page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header mb-3">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES AND CLIENTS', $_SESSION['systemLang']) ?></h1>
        <!-- <h5 class="h5 text-capitalize text-secondary "><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES TYPES', $_SESSION['systemLang']) ?></h5>         -->
        <h5 class="h5 text-capitalize text-secondary "><?php echo language('ADD NEW PIECE TYPE', $_SESSION['systemLang']) ?></h6>        
        
        <?php
            // get type name
            $typeName = isset($_POST['type-name']) && !empty($_POST['type-name']) ? $_POST['type-name'] : '';
            // get type notes
            $typeNote = isset($_POST['type-note']) && !empty($_POST['type-note']) ? $_POST['type-note'] : '';

            // type name validation
            if (!empty($typeName)) {
                // check if type is exist or not
                if (checkItem("`type_name`", "`types`", $typeName) > 0) {
                    
                    // echo danger message
                    $msg = '<div class="alert alert-danger text-capitalize" dir=""><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;' . language('THIS NAME IS ALREADY EXIST', $_SESSION['systemLang']) . '</div>';
                } else {
                    // insert query
                    $q = "INSERT INTO `types` (`type_name`, `type_note`) VALUES (?, ?);";
                    $stmt = $con->prepare($q);
                    $stmt->execute(array($typeName, $typeNote));
        
                    // echo success message
                    $msg = '<div class="alert alert-success text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('A NEW PIECE TYPE ADDED SUCCESSFULLY', $_SESSION['systemLang']) . '</div>';
                }
            } else {
                // data missed
                $msg = '<div class="alert alert-warning text-capitalize" dir=""><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('PIECE TYPE CANNOT BE EMPTY', $_SESSION['systemLang']) . '</div>';
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