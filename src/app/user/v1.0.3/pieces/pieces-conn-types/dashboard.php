<!-- start home stats container -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
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
        <div class="mb-3 row row-cols-sm-1 g-3 align-items-stretch justify-content-start">
            <!-- total connection types statistics -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('CONNECTION TYPES STATISTICS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF PIECES TYPES', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // create an object of PiecesConn class
                        $conn_obj = new PiecesConn();
                        // get all connections 
                        $conn_data = $conn_obj->get_all_conn_types($_SESSION['company_id']);
                        // data counter
                        $typesCount = $conn_data[0];
                        // data rows
                        $typesRows = $conn_data[1];
                        // check types count
                        if ($typesCount > 0) {
                    ?>
                        <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                            <?php
                            // counter
                            $i = 1;
                            // loop on types
                            foreach ($typesRows as $key => $type) {
                                // get count of pieces
                                $pcsCount = $conn_obj->count_records("`piece_id`", "`pieces`", "WHERE `conn_type` = ".$type['id']);
                                // check counter
                                if($i > 9) { $i = 1; }
                            ?>
                                <div class="col-12">
                                    <div class="card card-stat bg-primary shadow-sm border border-1">
                                        <div class="card-body">
                                            <h5 class="h5 card-title text-uppercase"><?php echo $type['conn_name'] ?></h5>
                                            <span class="nums">
                                                <a href="?name=pieces&do=showConnectionTypes&action=showPiecesConn&connid=<?php echo $type['id'] ?>" class="num stretched-link text-black" data-goal="<?php echo $pcsCount ?>">0</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php } ?>
                            <!-- show the number of clients that not assigned the connection type -->
                            <div class="col-12">
                                <div class="card card-stat bg-danger shadow-sm border border-1">
                                    <div class="card-body">
                                        <?php $notAssigned = $conn_obj->count_records("`piece_id`", "`pieces`", "WHERE `conn_type` = 0 AND `company_id` = ".$_SESSION['company_id']); ?>
                                        <h5 class="h5 card-title text-uppercase"><?php echo language('NOT ASSIGNED', $_SESSION['systemLang']) ?></h5>
                                        <span class="nums">
                                            <a href="?name=pieces&do=showConnectionTypes&action=showPiecesConn&connid=0" class="num stretched-link text-black" data-goal="<?php echo $notAssigned ?>">0</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <h5 class="h5 text-capitalize text-danger"><?php echo language('THERE IS NO CONNECTION TYPES TO SHOW', $_SESSION['systemLang']) ?></h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#addNewPieceConnTypeModal">
                            <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                                <i class="bi bi-file-plus"></i>
                                <?php echo language("ADD NEW CONNECTION TYPE", $_SESSION['systemLang']) ?>
                            </h6>
                        </button>
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