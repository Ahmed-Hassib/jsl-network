<!-- start home stats container -->
<div class="container"  dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <div class="header">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('CONNECTION TYPES', $_SESSION['systemLang']) ?></h1>
    </div>
    <!-- end header -->
    <!-- start stats -->
    <div class="stats">
        <!-- buttons section -->
        <div class="mb-3 hstack gap-3">
            <!-- add new connection type -->
            <div class="<?php if ($_SESSION['pcs_add'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#addNewPieceConnTypeModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-file-plus"></i>
                        <?php echo language("ADD NEW CONNECTION TYPE", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>
            <!-- edit connection type -->
            <div class="<?php if ($_SESSION['pcs_update'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#editPieceConnTypeModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-pencil-square"></i>
                        <?php echo language("EDIT CONNECTION TYPES", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>
            <!-- delete connection type -->
            <div class="<?php if ($_SESSION['pcs_delete'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#deletePieceConnTypeModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-pencil-square"></i>
                        <?php echo language("DELETE CONNECTION TYPE", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>
        </div>

        <!-- start new design -->
        <div class="mb-3 row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-3 align-items-stretch justify-content-start">
            <!-- total connection types statistics -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('CONNECTION TYPES STATISTICS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF PIECES TYPES', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // get all pieces types
                        $typesQuery = "SELECT *FROM `conn_types`";
                        $stmt = $con->prepare($typesQuery);
                        $stmt->execute();
                        $typesRows = $stmt->fetchAll();
                        $typesCount =  $stmt->rowCount();
                        // check types count
                        if ($typesCount > 0) {
                    ?>
                        <div class="row row-cols-sm-2 row-cols-lg-3 g-3">
                            <?php
                            // counter
                            $i = 1;
                            // loop on types
                            foreach ($typesRows as $key => $type) {
                                // get count of pieces
                                $pcsCount = countRecords("`piece_id`", "`pieces`", "WHERE `conn_type` = ".$type['id']);
                                // check counter
                                if($i > 9) { $i = 1; }
                            ?>
                                <div class="col-12">
                                    <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                        <div class="card-body">
                                            <div class="h5 card-title text-uppercase"><?php echo $type['conn_name'] ?></div>
                                            <span class="nums">
                                                <a href="?do=showConnectionTypes&action=showPiecesConn&connid=<?php echo $type['id'] ?>" class="num stretched-link text-black" data-goal="<?php echo $pcsCount ?>">0</a>
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
                                        <?php $notAssigned = countRecords("`piece_id`", "`pieces`", "WHERE `conn_type` = 0"); ?>
                                        <div class="h5 card-title text-uppercase"><?php echo language('NOT ASSIGNED', $_SESSION['systemLang']) ?></div>
                                        <span class="nums">
                                            <a href="?do=showConnectionTypes&action=showPiecesConn&connid=0" class="num stretched-link text-black" data-goal="<?php echo $notAssigned ?>">0</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- connection types statistics of pieces -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('CONNECTION TYPES STATISTICS', $_SESSION['systemLang'])." - ".language('PIECES', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF CONNECTION TYPES', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // get all pieces types
                        $connTypesQuery = "SELECT *FROM `conn_types`";
                        $stmt = $con->prepare($connTypesQuery);
                        $stmt->execute();
                        $connTypesRows = $stmt->fetchAll();
                        $connTypesCount =  $stmt->rowCount();
                        // check types count
                        if ($connTypesCount > 0) {
                    ?>
                        <div class="row row-cols-sm-2 row-cols-md-3 g-3">
                            <?php 
                            // counter
                            $i = 1;
                            // loop on types
                            foreach ($connTypesRows as $key => $connType) {
                                // get count of pieces
                                $pcsCount = countRecords("`piece_id`", "`pieces`", "WHERE `type_id` <> 4 AND `conn_type` = ".$connType['id']);
                                // check counter
                                if($i > 9) { $i = 1; }
                            ?>
                                <div class="col-12">
                                    <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                        <div class="card-body">
                                            <div class="h5 card-title text-uppercase"><?php echo $connType['conn_name'] ?></div>
                                            <span class="nums">
                                                <a href="?do=showConnectionTypes&action=showPiecesConn&type=1&connid=<?php echo $connType['id'] ?>" class="num stretched-link text-black" data-goal="<?php echo $pcsCount ?>">0</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php } ?>
                            <!-- show the number of pieces that not assigned the connection type -->
                            <div class="col-12">
                                <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                    <div class="card-body">
                                        <?php $notAssigned = countRecords("`piece_id`", "`pieces`", "WHERE `type_id` <> 4 AND `conn_type` = 0"); ?>
                                        <div class="h5 card-title text-uppercase"><?php echo language('NOT ASSIGNED', $_SESSION['systemLang']) ?></div>
                                        <span class="nums">
                                            <a href="?do=showConnectionTypes&action=showPiecesConn&type=1&connid=0" class="num stretched-link text-black" data-goal="<?php echo $notAssigned ?>">0</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
            <!-- connection types statistics of clients -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('CONNECTION TYPES STATISTICS', $_SESSION['systemLang'])." - ".language('CLIENTS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF CONNECTION TYPES', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // get all pieces types
                        $connTypesQuery = "SELECT *FROM `conn_types`";
                        $stmt = $con->prepare($connTypesQuery);
                        $stmt->execute();
                        $connTypesRows = $stmt->fetchAll();
                        $connTypesCount =  $stmt->rowCount();
                        // check types count
                        if ($connTypesCount > 0) {
                    ?>
                        <div class="row row-cols-sm-2 row-cols-md-3 g-3">
                            <?php 
                            // counter
                            $i = 1;
                            // loop on types
                            foreach ($connTypesRows as $key => $connType) {
                                // get count of pieces
                                $pcsCount = countRecords("`piece_id`", "`pieces`", "WHERE `type_id` = 4 AND `conn_type` = ".$connType['id']);
                                // check counter
                                if ($i > 9) { $i = 1; }
                            ?>
                                <div class="col-12">
                                    <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                        <div class="card-body">
                                            <div class="h5 card-title text-uppercase"><?php echo $connType['conn_name'] ?></div>
                                            <span class="nums">
                                                <a href="?do=showConnectionTypes&action=showPiecesConn&type=2&connid=<?php echo $connType['id'] ?>" class="num stretched-link text-black" data-goal="<?php echo $pcsCount ?>">0</a>
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
                                        <?php $notAssigned = countRecords("`piece_id`", "`pieces`", "WHERE `type_id` = 4 AND `conn_type` = 0"); ?>
                                        <div class="h5 card-title text-uppercase"><?php echo language('NOT ASSIGNED', $_SESSION['systemLang']) ?></div>
                                        <span class="nums">
                                            <a href="?do=showConnectionTypes&action=showPiecesConn&type=2&connid=0" class="num stretched-link text-black" data-goal="<?php echo $notAssigned ?>">0</a>
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

<!-- include add new connection type modal -->
<?php include_once 'add-conn-type-modal.php' ?>
<!-- include edit connection type modal -->
<?php include_once 'edit-conn-type-modal.php' ?>
<!-- include delete connection type modal -->
<?php include_once 'delete-conn-type-modal.php' ?>