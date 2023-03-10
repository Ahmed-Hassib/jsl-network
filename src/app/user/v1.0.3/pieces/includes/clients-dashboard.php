<!-- start home stats container -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start stats -->
    <div class="stats">
        <div class="mb-3 hstack gap-3">
            <div class="<?php if ($_SESSION['pcs_add'] == 0) {echo 'd-none';} ?>">
                <a href="?name=clients&do=addPiece" class="btn btn-outline-primary py-1">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-person-plus"></i>
                        <?php echo language('ADD NEW CLIENT', $_SESSION['systemLang']) ?>
                    </h6>
                </a>
            </div>
        </div>
        
        <!-- start new design -->
        <div class="mb-3 row g-3 align-items-stretch justify-content-start">
            <!-- total numbers of pieces/clients -->
            <div class="col-sm-12 col-lg-4">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language("CLIENTS STATISTICS", $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW SOME STATISTICS ABOUT THE NUMBERS OF CLIENTS", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <?php 
                        // create an object of Pieces class
                        $pcs_obj = new Pieces();
                    ?>
                    <div class="row row-cols-sm-1 g3">
                        <div class="col-12">
                            <div class="card card-stat bg-primary shadow-sm border border-1">
                                <div class="card-body">
                                    <?php $clients = $pcs_obj->count_records('`piece_id`', '`pieces`', 'WHERE `is_client` = 1 AND `company_id` = '.$_SESSION['company_id']); ?>
                                    <i class="bi bi-people"></i>
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('CLIENTS', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?name=clients&do=showAllClients" class="num stretched-link text-black" data-goal="<?php echo $clients; ?>">0</a>
                                    </span>
                                </div>
                                <?php $newPcsCounter = $db_obj->count_records("`piece_id`", "`pieces`", "WHERE `is_client` = 1 AND `added_date` = CURRENT_DATE() AND `company_id` = ".$_SESSION['company_id']); ?>
                                <?php if ($newPcsCounter > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border border-light bg-danger">
                                        <span><?php echo $newPcsCounter ?></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- latest added clients -->
        <div class="mb-3 row row-cols-1 g-3">
            <div class="col-12 <?php if ($_SESSION['user_show'] == 0) {echo 'd-none';} ?>">
                <div class="section-block">
                    <div class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('LATEST ADDED CLIENTS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW LATEST 10 ADDED CLIENTS', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </div>
                    <!-- get latest added clients -->
                    <?php $latest_added_clients = $pcs_obj->get_latest_records("*", "`pieces`", "WHERE `pieces`.`is_client` = 1 AND `company_id` = ".$_SESSION['company_id'], "`pieces`.`piece_id`", 10); ?>
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-bordered  display compact w-100">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th style="max-width: 25px">#</th>
                                    <th style="min-width: 100px" class="text-uppercase"><?php echo language('IP', $_SESSION['systemLang']) ?></th>
                                    <th style="min-width: 150px"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th style="min-width: 100px"><?php echo language('THE DIRECTION', $_SESSION['systemLang']) ?></th>
                                    <th style="min-width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th style="min-width: 25px"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0; ?>
                                <?php foreach ($latest_added_clients as $key => $client) { ?>
                                    <tr>
                                        <!-- index -->
                                        <td ><?php echo ++$index; ?></td>
                                        <!-- piece ip -->
                                        <td class="text-capitalize <?php echo $client['piece_ip'] == '0.0.0.0' ? 'text-danger ' : '' ?>" data-ip="<?php echo convertIP($client['piece_ip']) ?>"><?php echo $client['piece_ip'] == '0.0.0.0' ?  language("NO DATA ENTERED", $_SESSION['systemLang']) :"<a href='http://" . $client['piece_ip'] . "' target='_blank'>" . $client['piece_ip'] . '</a>'; ?></td>
                                        <!-- piece name -->
                                        <td>
                                            <a class="<?php if ($_SESSION['pcs_update'] == 0) {echo 'd-none';} ?>" href="?name=clients&do=editPiece&pieceid=<?php echo $client['piece_id']; ?>" target="">
                                                <?php echo trim($client['piece_name'], ' '); ?>
                                                <?php if ($client['direction_id'] == 0) { ?>
                                                    <i class="bi bi-exclamation-triangle-fill text-danger" title="<?php echo language("DIRECTION NO DATA ENTERED", $_SESSION['systemLang']) ?>"></i>
                                                <?php } ?>
                                            </a>
                                            <!-- <?php $diff = date_diff(date_create($client['added_date']), date_create(date('Y-m-d'))); ?>
                                            <span class="badge bg-danger p-1 <?php echo $_SESSION['systemLang'] == 'ar' ? 'me-1' : 'ms-1' ?>"><?php echo $diff->days <= 30 ? language("SINCE", $_SESSION['systemLang']) . " $diff->days " . language('DAYS', $_SESSION['systemLang']) : language("SINCE MORE THAN 30 DAYS", $_SESSION['systemLang']) ?></span> -->
                                        </td>
                                        <!-- piece direction -->
                                        <td class="text-capitalize" >
                                            <?php if ($client['direction_id'] != 0) { ?>
                                                <a href="<?php echo $nav_up_level ?>directions/index.php?do=showDir&dirId=<?php echo $client['direction_id']; ?>">
                                                    <?php echo $db_obj->select_specific_column("`direction_name`", "`direction`", "WHERE `direction_id` = ".$client['direction_id'])[0]['direction_name']; ?>
                                                </a>
                                            <?php } else { ?>
                                                <p class="text-danger "><?php echo language("NO DATA ENTERED", $_SESSION['systemLang']) ?></p>
                                            <?php } ?>
                                        </td>
                                        <!-- added date -->
                                        <td><?php echo $client['added_date'] == '0000-00-00' ? language("NO DATA ENTERED", $_SESSION['systemLang']) : $client['added_date'] ?></td>
                                        <!-- control -->
                                        <td>
                                            <a class="btn btn-success text-capitalize fs-12 <?php if ($_SESSION['pcs_update'] == 0) {echo 'd-none';} ?>" href="?name=clients&do=editPiece&pieceid=<?php echo $client['piece_id']; ?>" target=""><i class="bi bi-pencil-square"></i><!-- <?php echo language('EDIT', $_SESSION['systemLang']) ?> --></a>
                                            <?php if ($client['is_client'] == 0) { ?>
                                                <a class="btn btn-outline-primary text-capitalize fs-12 <?php if ($_SESSION['pcs_show'] == 0) {echo 'd-none';} ?>" href="?do=showPiece&dirId=<?php echo $client['direction_id'] ?>&srcId=<?php echo $client['piece_id'] ?>" ><i class="bi bi-eye"></i><!-- <?php echo language('SHOW', $_SESSION['systemLang']).' '.language('PIECES', $_SESSION['systemLang']) ?> --></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- end stats -->
</div>
<!-- end home stats container -->