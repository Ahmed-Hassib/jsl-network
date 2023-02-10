<!-- start home stats container -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <div class="header">
        <!-- <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES AND CLIENTS', $_SESSION['systemLang']) ?></h1> -->
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES TYPES', $_SESSION['systemLang']) ?></h1>
    </div>
    <!-- end header -->
    <!-- start stats -->
    <div class="stats">
        <!-- buttons section -->
        <div class="mb-3 hstack gap-3">
            <div class="<?php if ($_SESSION['pcs_show'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#addNewPieceTypeModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-file-plus"></i>
                        <?php echo language("ADD NEW PIECE TYPE", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>

            <div class="<?php if ($_SESSION['pcs_update'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#editPieceTypeModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-pencil-square"></i>
                        <?php echo language("EDIT PIECE TYPES", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>

            <div class="<?php if ($_SESSION['pcs_delete'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#deletePieceTypeModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-trash"></i>
                        <?php echo language("DELETE PIECE TYPE", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>
        </div>

        <!-- start new design -->
        <div class="mb-3 row row-cols-sm-1 g-3 align-items-stretch justify-content-start">
            <!-- pieces types statistics -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('PIECES TYPES STATISTICS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF PIECES TYPES', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // get all pieces types
                        $typesQuery = "SELECT *FROM `types` WHERE `type_id` <> 4";
                        $stmt = $con->prepare($typesQuery);
                        $stmt->execute();
                        $typesRows = $stmt->fetchAll();
                        $typesCount =  $stmt->rowCount();
                        // check types count
                        if ($typesCount > 0) {
                    ?>
                        <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
                            <?php
                                // counter
                                $i = 1;
                                // loop on types
                                foreach ($typesRows as $key => $type) {
                                    // get count of pieces
                                    $pcsCount = countRecords("`piece_id`", "`pieces`", "WHERE `type_id` = ".$type['type_id']);
                                    // check counter
                                    if($i > 9) {
                                        $i = 1;
                                    }
                            ?>
                            <div class="col-12">
                                <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                    <div class="card-body">
                                        <div class="h5 card-title text-uppercase"><?php echo $type['type_name'] ?></div>
                                        <span class="nums">
                                            <a href="?do=piecesTypes&action=showPiecesType&typeid=<?php echo $type['type_id'] ?>" class="num stretched-link text-black" data-goal="<?php echo $pcsCount ?>">0</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                            <?php } ?>
                            <!-- show the number of clients that not assigned the connection type -->
                            <div class="col-12">
                                <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                    <div class="card-body">
                                        <?php $notAssigned = countRecords("`piece_id`", "`pieces`", "WHERE `type_id` = 0"); ?>
                                        <div class="h5 card-title text-uppercase"><?php echo language('NOT ASSIGNED', $_SESSION['systemLang']) ?></div>
                                        <span class="nums">
                                            <a href="pieces.php?do=piecesTypes&action=showPiecesType&typeid=0" class="num stretched-link text-black" data-goal="<?php echo $notAssigned ?>">0</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
        </div>
    </div>
    
</div>

<!-- include add new type modal -->
<?php include_once 'add-type-modal.php' ?>
<!-- include edit type modal -->
<?php include_once 'edit-type-modal.php' ?>
<!-- include delete type modal -->
<?php include_once 'delete-type-modal.php' ?>