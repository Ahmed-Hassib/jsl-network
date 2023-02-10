
<?php
$techCondition1 = "";
$techCondition2 = "";

if ($_SESSION['mal_show'] == 1) {
    $techCondition1 = $_SESSION['isTech'] == 1 ? "AND `tech_id` = ".$_SESSION['UserID'] : "";
    $techCondition2 = $_SESSION['isTech'] == 1 ? "WHERE `tech_id` = ".$_SESSION['UserID'] : "";
} else {
    $techCondition1 = "";
    $techCondition2 = "";
}
?>

<!-- start home stats container -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <div class="header">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE THE MALFUNCTIONS', $_SESSION['systemLang']) ?></h1>
    </div>
    <!-- end header -->
    <!-- start stats -->
    <div class="stats">
        <div class="mb-3 <?php if ($_SESSION['mal_add'] == 0) {echo 'd-none';} ?>">
            <a href="?do=addMalfunction" class="btn btn-outline-primary py-1 shadow-sm">
                <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                    <i class="bi bi-plus"></i>
                    <?php echo language('ADD NEW MALFUNCTION', $_SESSION['systemLang']) ?>
                </h6>
            </a>
        </div>
        <!-- start new design -->
        <div class="mb-3 row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-3 align-items-stretch justify-content-start">
            <!-- malfunction of today section -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('MALFUNCTIONS TODAY', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW ALL STATISTICS ABOUT MALFUNCTIONS TODAY", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <div class="row row-cols-sm-2 g-3">
                        <div class="col-6">
                            <div class="card bg-total bg-gradient">
                                <?php $allTodMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `added_date` = CURRENT_DATE() $techCondition1") ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=today&malStatus=all" class="num stretched-link" data-goal="<?php echo $allTodMal; ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-danger bg-gradient">
                                <?php $unrepTodMal = countRecords("`mal_id`", "`malfunctions`", "WHERE (`mal_status` = 0 AND `isAccepted` <> 2) AND `added_date` = CURRENT_DATE() $techCondition1") ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('UNREPAIRED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=today&malStatus=unrepaired" class="num stretched-link" data-goal="<?php echo $unrepTodMal; ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-success bg-gradient">
                                <?php $repTodMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 1 AND `added_date` = CURRENT_DATE() $techCondition1") ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('REPAIRED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=today&malStatus=repaired" class="stretched-link num" data-goal="<?php echo $repTodMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-warning bg-gradient">
                                <?php $repTodMal = countRecords("`mal_id`", "`malfunctions`", "WHERE (`mal_status` = 2 OR `isAccepted` = 2) AND `added_date` = CURRENT_DATE() $techCondition1") ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('DELAYED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=today&accepted=delayed" class="stretched-link num" data-goal="<?php echo $repTodMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- malfunctions of this month -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language("MALFUNCTIONS OF THIS MONTH", $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW ALL STATISTICS ABOUT MALFUNCTIONS OF THIS MONTH", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <?php
                        $startDate  = Date('Y-m-1');
                        $endDate    = Date('Y-m-30');
                    ?>
                    <div class="row row-cols-sm-2 g-3">
                        <div class="col-6">
                            <div class="card card-stat bg-total bg-gradient">
                            <?php $allMonMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=month&malStatus=all" class="num stretched-link" data-goal="<?php echo $allMonMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-danger bg-gradient">
                                <?php $allMonUnrepMal = countRecords("`mal_id`", "`malfunctions`", "WHERE (`mal_status` = 0 AND `isAccepted` <> 2) AND `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('UNREPAIRED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=month&malStatus=unrepaired" class="num stretched-link" data-goal="<?php echo $allMonUnrepMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-success bg-gradient">
                                <?php $allMonRepMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 1 AND `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('REPAIRED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=month&malStatus=repaired" class="num stretched-link" data-goal="<?php echo $allMonRepMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-warning bg-gradient">
                                <?php $allMonDelMal = countRecords("`mal_id`", "`malfunctions`", "WHERE (`mal_status` = 2 OR `isAccepted` = 2) AND `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('DELAYED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=month&accepted=delayed" class="num stretched-link" data-goal="<?php echo $allMonDelMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- malfunctions of previous month -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language("MALFUNCTIONS OF PREVIOUS MONTH", $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW ALL STATISTICS ABOUT MALFUNCTIONS OF PREVIOUS MONTH", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <?php
                        // date of today
                        $start = Date("Y-m-1");
                        $end = Date("Y-m-30");
                        // license period
                        $period = ' - 1 months';
                        $startDate = Date("Y-m-d", strtotime($start. $period));
                        $endDate = Date("Y-m-d", strtotime($end. $period));
                    ?>
                    <div class="row row-cols-sm-2 g-3">
                        <div class="col-6">
                            <div class="card card-stat bg-total bg-gradient">
                            <?php $allMonMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=previous-month&malStatus=all" class="num stretched-link" data-goal="<?php echo $allMonMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-danger bg-gradient">
                                <?php $allMonUnrepMal = countRecords("`mal_id`", "`malfunctions`", "WHERE (`mal_status` = 0 AND `isAccepted` <> 2) AND `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('UNREPAIRED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=previous-month&malStatus=unrepaired" class="num stretched-link" data-goal="<?php echo $allMonUnrepMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-success bg-gradient">
                                <?php $allMonRepMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 1 AND `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('REPAIRED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=previous-month&malStatus=repaired" class="num stretched-link" data-goal="<?php echo $allMonRepMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-warning bg-gradient">
                                <?php $allMonDelMal = countRecords("`mal_id`", "`malfunctions`", "WHERE (`mal_status` = 2 OR `isAccepted` = 2) AND `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('DELAYED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=previous-month&accepted=delayed" class="num stretched-link" data-goal="<?php echo $allMonDelMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total malfunctions -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language("TOTAL MALFUNCTIONS", $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW ALL STATISTICS ABOUT MALFUNCTIONS OVERALL", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <div class="row row-cols-sm-2 g-3">
                        <div class="col-6">
                            <div class="card card-stat bg-total bg-gradient">
                                <?php $allMal = countRecords("`mal_id`", "`malfunctions`", "$techCondition2") ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=all&malStatus=all" class="num stretched-link" data-goal="<?php echo $allMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-danger bg-gradient">
                                <?php $unrepMal = countRecords("`mal_id`", "`malfunctions`", "WHERE (`mal_status` = 0 AND `isAccepted` <> 2) $techCondition1") ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('UNREPAIRED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=all&malStatus=unrepaired" class="num stretched-link" data-goal="<?php echo $unrepMal ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-success bg-gradient">
                                <?php $repMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 1 $techCondition1") ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('REPAIRED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=all&malStatus=repaired" class="num stretched-link" data-goal="<?php echo $repMal ; ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-warning bg-gradient">
                                <?php $repMal = countRecords("`mal_id`", "`malfunctions`", "WHERE (`mal_status` = 2 OR `isAccepted` = 2) $techCondition1") ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?php echo language('DELAYED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showMalfunctionDetails&period=all&accepted=delayed" class="num stretched-link" data-goal="<?php echo $repMal ; ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('SOME MALFUNCTIONS TODAY', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW LATEST 5 ADDED MALFUNCTIONS", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <?php 
                        // get malfunctions of today
                        $todayMal = selectSpecificColumn("*", "`malfunctions`", "WHERE `added_date` = CURRENT_DATE $techCondition1 ORDER BY `added_time` DESC LIMIT 5");
                        // check if array not empty
                        if (!empty($todayMal)) {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered  display compact table-style">
                            <thead class="table-dark text-capitalize">
                                <tr class="fs-12 text-center">
                                    <th scope="col"><?php echo language('PIECE/CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <!-- <th scope="col"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th> -->
                                    <!-- <th scope="col"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th> -->
                                    <th scope="col"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th scope="col"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th scope="col"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th scope="col"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // loop on data
                                foreach ($todayMal as $index => $mal) {
                                    // get client info
                                    $clientName     = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = ".$mal['client_id'])[0]['piece_name'];
                                    $clientAddr     = selectSpecificColumn("`address`", "`pieces_addr`", "WHERE `piece_id` = ".$mal['client_id']);
                                    $clientPhone    = selectSpecificColumn("`phone`", "`pieces_phone`", "WHERE `piece_id` = ".$mal['client_id']);
                                    $technicalName  = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$mal['tech_id'])[0]['UserName'];
                                ?>
                                    <tr class="fs-12 text-center">
                                        <td style="width: 100px">
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $mal['client_id'] ?>">
                                                <?php echo !empty($clientName) ? $clientName : language('NO DATA ENTERED', $_SESSION['systemLang']) ?>
                                            </a>
                                        </td>
                                        <!-- <td style="width: 100px" class="<?php echo empty($clientAddr) ? 'text-danger ' : '' ?>"><?php echo !empty($clientAddr) ? $clientAddr[0]['address'] : language('NO DATA ENTERED', $_SESSION['systemLang']) ?></td> -->
                                        <!-- <td style="width: 100px" class="<?php echo empty($clientPhone) ? 'text-danger ' : '' ?>"><?php echo !empty($clientPhone) ? $clientPhone[0]['phone'] : language('NO DATA ENTERED', $_SESSION['systemLang']) ?></td> -->
                                        <td style="width: 100px">
                                            <a href="users.php?do=editUser&userid=<?php echo $mal['tech_id'] ?>">
                                                <?php echo !empty($technicalName)   ? $technicalName    : language('NO DATA ENTERED', $_SESSION['systemLang']) ?>
                                            </a>
                                        </td>
                                        <td style="width: 50px">
                                        <?php
                                        if ($mal['mal_status'] == 0) {
                                            $iconStatus   = "bi-x-circle-fill text-danger";
                                            $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                        } elseif ($mal['mal_status'] == 1) {
                                            $iconStatus   = "bi-check-circle-fill text-success";
                                            $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                        } elseif ($mal['mal_status'] == 2) {
                                            $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                            $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                        } else {
                                            $iconStatus   = "bi-dash-circle-fill text-info";
                                            $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                        }
                                        ?>
                                        <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td style="width: 50px">
                                        <?php
                                            if ($mal['isAccepted'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                            } elseif ($mal['isAccepted'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                            } elseif ($mal['isAccepted'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                        ?>
                                        <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td style="width: 50px">
                                            <a href="?do=editMalfunction&malid=<?php echo $mal['mal_id'] ?>" target="" class="btn btn-outline-primary me-1 fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } else { ?>
                        <h5 class="h5 text-danger text-capitalize "><?php echo language('THERE IS NO MALFUNCTIONS TO SHOW', $_SESSION['systemLang']) ?></h5>
                    <?php } ?>
                </div>
            </div>
            
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('LATEST ADDED MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW LATEST 5 ADDED MALFUNCTIONS", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <?php 
                        // get latest added clients
                        $latestMal = getLatestRecord("*", "`malfunctions`", $techCondition2, "`added_date`");
                        // check if array not empty
                        if (!empty($latestMal)) {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered  display compact table-style">
                            <thead class="table-dark text-capitalize">
                                <tr class="fs-12 text-center">
                                    <th scope="col"><?php echo language('PIECE/CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <!-- <th scope="col"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th> -->
                                    <!-- <th scope="col"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th> -->
                                    <th scope="col"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th scope="col"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th scope="col"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th scope="col"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // loop on data
                                foreach ($latestMal as $index => $mal) {
                                    // get client info
                                    $clientName     = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = ".$mal['client_id'])[0]['piece_name'];
                                    $clientAddr     = selectSpecificColumn("`address`", "`pieces_addr`", "WHERE `piece_id` = ".$mal['client_id']);
                                    $clientPhone    = selectSpecificColumn("`phone`", "`pieces_phone`", "WHERE `piece_id` = ".$mal['client_id']);
                                    $technicalName  = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$mal['tech_id'])[0]['UserName'];
                                ?>
                                    <tr class="fs-12 text-center">
                                        <td style="width: 150px">
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $mal['client_id'] ?>">
                                                <?php echo !empty($clientName) ? $clientName : language('NO DATA ENTERED', $_SESSION['systemLang']) ?>
                                            </a>
                                        </td>
                                        <!-- <td style="width: 100px" class="<?php echo empty($clientAddr) ? 'text-danger ' : '' ?>"><?php echo !empty($clientAddr) ? $clientAddr[0]['address'] : language('NO DATA ENTERED', $_SESSION['systemLang']) ?></td> -->
                                        <!-- <td style="width: 100px" class="<?php echo empty($clientPhone) ? 'text-danger ' : '' ?>"><?php echo !empty($clientPhone) ? $clientPhone[0]['phone'] : language('NO DATA ENTERED', $_SESSION['systemLang']) ?></td> -->
                                        <td style="width: 100px">
                                            <a href="users.php?do=editUser&userid=<?php echo $mal['tech_id'] ?>">
                                                <?php echo !empty($technicalName)   ? $technicalName    : language('NO DATA ENTERED', $_SESSION['systemLang']) ?>
                                            </a>
                                        </td>
                                        <td style="width: 50px">
                                        <?php
                                        if ($mal['mal_status'] == 0) {
                                            $iconStatus   = "bi-x-circle-fill text-danger";
                                            $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                        } elseif ($mal['mal_status'] == 1) {
                                            $iconStatus   = "bi-check-circle-fill text-success";
                                            $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                        } elseif ($mal['mal_status'] == 2) {
                                            $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                            $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                        } else {
                                            $iconStatus   = "bi-dash-circle-fill text-info";
                                            $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                        }
                                        ?>
                                        <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td style="width: 50px">
                                        <?php
                                            if ($mal['isAccepted'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                            } elseif ($mal['isAccepted'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                            } elseif ($mal['isAccepted'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                        ?>
                                        <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td style="width: 50px">
                                            <a href="?do=editMalfunction&malid=<?php echo $mal['mal_id'] ?>" target="" class="btn btn-outline-primary me-1 fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } else { ?>
                        <h5 class="h5 text-danger text-capitalize "><?php echo language('THERE IS NO MALFUNCTIONS TO SHOW', $_SESSION['systemLang']) ?></h5>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- end new design -->
    </div>
    <!-- end stats -->
</div>
<!-- end home stats container -->