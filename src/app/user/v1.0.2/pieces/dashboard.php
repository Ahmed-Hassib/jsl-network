<!-- start home stats container -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <div class="header">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES AND CLIENTS', $_SESSION['systemLang']) ?></h1>
    </div>
    <!-- end header -->
    
    <!-- start stats -->
    <div class="stats">
        <div class="mb-3 hstack gap-3">
            <div class="<?php if ($_SESSION['pcs_add'] == 0) {echo 'd-none';} ?>">
                <a href="?do=addPiece" class="btn btn-outline-primary py-1">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-person-plus"></i>
                        <?php echo language('ADD NEW CLIENT/PIECE', $_SESSION['systemLang']) ?>
                    </h6>
                </a>
            </div>
            <div class="<?php if ($_SESSION['pcs_show'] == 0) {echo 'd-none';} ?>">
                <a href="?do=piecesTypes" class="btn btn-outline-primary py-1">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-hdd-rack"></i>
                        <?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES TYPES', $_SESSION['systemLang']) ?>
                    </h6>
                </a>
            </div>
            <div class="<?php if ($_SESSION['pcs_show'] == 0) {echo 'd-none';} ?>">
                <a href="?do=showConnectionTypes" class="btn btn-outline-primary py-1">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-hdd-network"></i>
                        <?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('CONNECTION TYPES', $_SESSION['systemLang']) ?>
                    </h6>
                </a>
            </div>
        </div>
        
        <!-- start new design -->
        <div class="mb-3 row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-3 align-items-stretch justify-content-start">
            <!-- total numbers of pieces/clients -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language("PIECES/CLIENTS STATISTICS", $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF PIECES/CLIENTS", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // create an object of Pieces class
                        $pcs_obj = new Pieces();
                    ?>
                    <div class="row row-cols-sm-2 g3">
                        <div class="col-6">
                            <div class="card card-stat bg-2 shadow-sm border border-1">
                                <div class="card-body">
                                    <?php $pieces = $pcs_obj->count_records('`piece_id`', '`pieces`', 'WHERE `is_client` = 0');   ?>
                                    <i class="bi bi-hdd-rack"></i>
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('PIECES', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        
                                        <a href="?do=showAllPieces" class="num stretched-link text-black" data-goal="<?php echo $pieces; ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-3 shadow-sm border border-1">
                                <div class="card-body">
                                    <?php $clients = $pcs_obj->count_records('`piece_id`', '`pieces`', 'WHERE `is_client` = 1'); ?>
                                    <i class="bi bi-people"></i>
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('CLIENTS', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showAllClients" class="num stretched-link text-black" data-goal="<?php echo $clients; ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- pieces types statistics -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('PIECES TYPES STATISTICS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF PIECES TYPES', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // create an object of PiecesTypes
                        $types_obj = new PiecesTypes();
                        // get all types
                        $types_data = $types_obj->get_all_types($_SESSION['company_id']);
                        // types row
                        $typesRows = $types_data[1];
                        // types count
                        $typesCount = $types_data[0];
                        // check types count
                        if ($typesCount > 0) {
                    ?>
                        <div class="row row-cols-sm-2 row-cols-md-3 g-3">
                            <?php
                                // counter
                                $i = 1;
                                // loop on types
                                foreach ($typesRows as $key => $type) {
                                    // get count of pieces
                                    $pcsCount = $types_obj->count_records("`piece_id`", "`pieces`", "WHERE `type_id` = ".$type['type_id']);
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
                                            <a href="pieces.php?do=piecesTypes&action=showPiecesType&typeid=<?php echo $type['type_id'] ?>" class="num stretched-link text-black" data-goal="<?php echo $pcsCount ?>">0</a>
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
                                        <?php $notAssigned = $pcs_obj->count_records("`piece_id`", "`pieces`", "WHERE `type_id` = 0"); ?>
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
            
            <!-- connection types statistics of pieces -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('CONNECTION TYPES STATISTICS', $_SESSION['systemLang'])." - ".language('PIECES', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF CONNECTION TYPES', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // create an object of PiecesConn class
                        $conn_obj = new PiecesConn();
                        // get all connections 
                        $conn_data = $conn_obj->get_all_conn_types($_SESSION['company_id']);
                        // data counter
                        $connTypesCount = $conn_data[0];
                        // data rows
                        $connTypesRows = $conn_data[1];
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
                                $pcsCount = $conn_obj->count_records("`piece_id`", "`pieces`", "WHERE `is_client` = 0 AND `conn_type` = ".$connType['id']);
                                // check counter
                                if($i > 9) { $i = 1; }
                            ?>
                                <div class="col-12">
                                    <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                        <div class="card-body">
                                            <div class="h5 card-title text-uppercase"><?php echo $connType['conn_name'] ?></div>
                                            <span class="nums">
                                                <a href="?do=showConnectionTypes&type=1&connid=<?php echo $connType['id'] ?>" class="num stretched-link text-black" data-goal="<?php echo $pcsCount ?>">0</a>
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
                                        <?php $notAssigned = $pcs_obj->count_records("`piece_id`", "`pieces`", "WHERE `is_client` = 0 AND `conn_type` = 0"); ?>
                                        <div class="h5 card-title text-uppercase"><?php echo language('NOT ASSIGNED', $_SESSION['systemLang']) ?></div>
                                        <span class="nums">
                                            <a href="?do=showConnectionTypes&type=2&connid=0" class="num stretched-link text-black" data-goal="<?php echo $notAssigned ?>">0</a>
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
                                $pcsCount = $conn_obj->count_records("`piece_id`", "`pieces`", "WHERE `is_client` = 1 AND `conn_type` = ".$connType['id']);
                                // check counter
                                if ($i > 9) { $i = 1; }
                            ?>
                                <div class="col-12">
                                    <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                        <div class="card-body">
                                            <div class="h5 card-title text-uppercase"><?php echo $connType['conn_name'] ?></div>
                                            <span class="nums">
                                                <a href="?do=showConnectionTypes&type=2&connid=<?php echo $connType['id'] ?>" class="num stretched-link text-black" data-goal="<?php echo $pcsCount ?>">0</a>
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
                                        <?php $notAssigned = $conn_obj->count_records("`piece_id`", "`pieces`", "WHERE `is_client` = 1 AND `conn_type` = 0"); ?>
                                        <div class="h5 card-title text-uppercase"><?php echo language('NOT ASSIGNED', $_SESSION['systemLang']) ?></div>
                                        <span class="nums">
                                            <a href="?do=showConnectionTypes&type=2&connid=0" class="num stretched-link text-black" data-goal="<?php echo $notAssigned ?>">0</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- latest added clients -->
            <div class="col-12 <?php if ($_SESSION['user_show'] == 0) {echo 'd-none';} ?>">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('LATEST ADDED CLIENTS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW LATEST 5 ADDED CLIENTS', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <!-- get latest added clients -->
                    <?php $latestClients = $pcs_obj->get_latest_records("*", "`pieces`", "WHERE `pieces`.`type_id` = 4", "`pieces`.`piece_id`"); ?>
                    <!-- check if array not empty -->
                    <?php if (!empty($latestClients)) { ?>
                        <div class="row row-cols-sm-2 justify-content-center g-3">
                            <?php $i = 1; // counter ?>
                            <?php foreach ($latestClients as $index => $client) { ?>
                                <?php if ($i > 9) {$i = 1;} ?>
                                <div class="col-12">
                                    <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                        <div class="card-body">
                                            <a href="?do=editPiece&pieceid=<?php echo $client['piece_id'] ?>" target="" class="<?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?> stretched-link text-black">
                                                <?php echo $client['piece_name'] ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <h5 class="h5 text-danger text-capitalize "><?php echo language('THERE IS NO CLIENTS TO SHOW', $_SESSION['systemLang']) ?></h5>
                    <?php } ?>
                </div>
            </div>
            <!-- latest added pieces -->
            <div class="col-12 <?php if ($_SESSION['user_show'] == 0) {echo 'd-none';} ?>">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('LATEST ADDED PIECES', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW LATEST 5 ADDED PIECES', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <!-- get latest added clients -->
                    <?php $latestPieces = $pcs_obj->get_latest_records("*", "`pieces`", "WHERE `pieces`.`type_id` <> 4", "`pieces`.`piece_id`"); ?>
                    <!-- check if array not empty -->
                    <?php if (!empty($latestPieces)) { ?>
                        <div class="row row-cols-sm-2 justify-content-center g-3">
                            <?php $i = 1; // counter ?>
                            <?php foreach ($latestPieces as $index => $piece) { ?>
                                <?php if ($i > 9) {$i = 1;} ?>
                                <div class="col-12">
                                    <div class="card card-stat bg-<?php echo $i ?> shadow-sm border border-1">
                                        <div class="card-body">
                                            <a href="?do=editPiece&pieceid=<?php echo $piece['piece_id'] ?>" target="" class="<?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?> stretched-link text-black">
                                                <?php echo $piece['piece_name'] ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <h5 class="h5 text-danger text-capitalize "><?php echo language('THERE IS NO PIECES TO SHOW', $_SESSION['systemLang']) ?></h5>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>    
    <!-- end stats -->
</div>
<!-- end home stats container -->