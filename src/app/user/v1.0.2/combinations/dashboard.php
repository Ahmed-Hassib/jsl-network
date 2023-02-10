<?php    
$techCondition1 = "";
$techCondition2 = "";

if ($_SESSION['comb_show'] == 1 && $_SESSION['isTech'] == 1) {
    $techCondition1 = "AND `UserID` = " . $_SESSION['UserID'];
    $techCondition2 = "WHERE `UserID` = " . $_SESSION['UserID'];
} else {
    $techCondition1 = "";
    $techCondition2 = "";
}
?>
<!-- start home stats container -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <div class="header">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang']) . " " . language('THE COMBINATIONS', $_SESSION['systemLang']) ?></h1>
        <!-- <h2 class="h2 text-capitalize"><?php echo language('SORRY, THIS PAGE IS UNDER DEVELOPING', $_SESSION['systemLang']) ?></h2> -->
    </div>
    <!-- end header -->
    <!-- start stats -->
    <div class="stats">
        <div class="mb-3 <?php if ($_SESSION['mal_add'] == 0) {echo 'd-none';} ?>">
            <a href="?do=addCombinations" class="btn btn-outline-primary py-1 shadow-sm">
                <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                    <span class="bi bi-plus"></span>
                    <?php echo language("ADD NEW COMBINATION", $_SESSION['systemLang']) ?>
                </h6>
            </a>
        </div>
        <!-- start new design -->
        <div class="mb-3 row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-3 align-items-stretch justify-content-start">
            <!-- combinations of today -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('COMBINATIONS TODAY', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW ALL STATISTICS ABOUT COMBINATIONS TODAY', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <div class="row row-cols-sm-2 g-3">
                        <div class="col-6">
                            <div class="card bg-total bg-gradient">
                                <div class="card-body">
                                    <?php $allCombToday = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` = CURRENT_DATE() $techCondition1") ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=today&combStatus=-1" class="num stretched-link" data-goal="<?php echo $allCombToday ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-danger bg-gradient">
                                <div class="card-body">
                                    <?php $unfinishedToday = countRecords("`comb_id`", "`combinations`", "WHERE (`isFinished` = 0 AND `isAccepted` <> 2) AND added_date = CURRENT_DATE() $techCondition1") ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('UNFINISHED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=today&combStatus=unfinished" class="num stretched-link" data-goal="<?php echo $unfinishedToday ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-success bg-gradient">
                                <div class="card-body">
                                    <?php $finishedToday = countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 1 AND added_date = CURRENT_DATE() $techCondition1") ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('FINISHED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=today&combStatus=finished" class="num stretched-link" data-goal="<?php echo $finishedToday ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-warning bg-gradient">
                                <div class="card-body">
                                    <?php $delayedToday = countRecords("`comb_id`", "`combinations`", "WHERE (`isAccepted` = 2 OR `isFinished` = 2) AND added_date = CURRENT_DATE() $techCondition1") ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('DELAYED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=today&accepted=delayed" class="num stretched-link" data-goal="<?php echo $delayedToday ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- combinations of this month -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('COMBINATIONS OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW ALL STATISTICS ABOUT COMBINATIONS OF THIS MONTH', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    
                    <?php $startDate  = Date('Y-m-1'); ?>
                    <?php $endDate    = Date('Y-m-31'); ?>
                    
                    <div class="row row-cols-sm-2 g-3">
                        <div class="col-6">
                            <div class="card card-stat bg-total bg-gradient">
                                <div class="card-body">
                                    <?php $allCombMonth = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=month&combStatus=-1" class="num stretched-link" data-goal="<?php echo $allCombMonth ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-danger bg-gradient">
                                <div class="card-body">
                                    <?php $unfinishedMonth = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `isFinished` = 0 AND `isAccepted` <> 2 $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('UNFINISHED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=month&combStatus=unfinished" class="num stretched-link" data-goal="<?php echo $unfinishedMonth ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-success bg-gradient">
                                <div class="card-body">
                                    <?php $finishedMonth = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `isFinished` = 1 $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('FINISHED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=month&combStatus=finished" class="num stretched-link" data-goal="<?php echo $finishedMonth ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-warning bg-gradient">
                                <div class="card-body">
                                    <?php $delayedMonth = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND (`isAccepted` = 2 OR `isFinished` = 2) $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('DELAYED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=month&accepted=delayed" class="num stretched-link" data-goal="<?php echo $delayedMonth ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- combinations of previous month -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('COMBINATIONS OF PREVIOUS MONTH', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW ALL STATISTICS ABOUT COMBINATIONS OF PREVIOUS MONTH', $_SESSION['systemLang']) ?></p>
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
                                <div class="card-body">
                                    <?php $allCombMonth = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=previous-month&combStatus=-1" class="num stretched-link" data-goal="<?php echo $allCombMonth ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-danger bg-gradient">
                                <div class="card-body">
                                    <?php $unfinishedMonth = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `isFinished` = 0 AND `isAccepted` <> 2 $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('UNFINISHED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=previous-month&combStatus=unfinished" class="num stretched-link" data-goal="<?php echo $unfinishedMonth ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-success bg-gradient">
                                <div class="card-body">
                                    <?php $finishedMonth = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `isFinished` = 1 $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('FINISHED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=previous-month&combStatus=finished" class="num stretched-link" data-goal="<?php echo $finishedMonth ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-stat bg-warning bg-gradient">
                                <div class="card-body">
                                    <?php $delayedMonth = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND (`isAccepted` = 2 OR `isFinished` = 2) $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('DELAYED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&period=previous-month&accepted=delayed" class="num stretched-link" data-goal="<?php echo $delayedMonth ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total combinations -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('TOTAL COMBINATIONS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW ALL STATISTICS ABOUT COMBINATIONS OVERALL', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <div class="row row-cols-sm-2 g-3">
                        <div class="col-6">
                            <div class="card bg-total bg-gradient">
                                <div class="card-body">
                                    <?php $allComb = countRecords("`comb_id`", "`combinations`", $techCondition2); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails" class="stretched-link num" data-goal="<?php echo $allComb ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-danger bg-gradient">
                                <div class="card-body">
                                    <?php $allComb = countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 0 AND `isAccepted` <> 2 $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('UNFINISHED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&combStatus=unfinished" class="stretched-link num" data-goal="<?php echo $allComb ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-success bg-gradient">
                                <div class="card-body">
                                    <?php $allComb = countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 1 $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('FINISHED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&combStatus=finished" class="stretched-link num" data-goal="<?php echo $allComb ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-warning bg-gradient">
                                <div class="card-body">
                                    <?php $allComb = countRecords("`comb_id`", "`combinations`", "WHERE (`isAccepted` = 2 OR `isFinished` = 2) $techCondition1"); ?>
                                    <h5 class="card-title text-capitalize"><?php echo language('DELAYED', $_SESSION['systemLang']) ?></h5>
                                    <span class="nums">
                                        <a href="?do=showCombinationDetails&accepted=delayed" class="stretched-link num" data-goal="<?php echo $allComb ?>">0</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- some combinations of today -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('SOME COMBINATIONS TODAY', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language('HERE WILL SHOW LATEST 5 ADDED COMBINATIONS', $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <?php
                    // get `combinations` of today of the cureent employee
                    $todayComb = selectSpecificColumn("*", "`combinations`", "WHERE `added_date` = CURRENT_DATE ".$techCondition1." ORDER BY `added_date` DESC LIMIT 5");
                    
                    // check if array not empty
                    if (!empty($todayComb)) {   
                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered  display compact table-style">
                                <thead class="table-dark text-capitalize">
                                    <tr class="fs-12 text-center">
                                        <th scope="col"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                        <!-- <th scope="col"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th> -->
                                        <!-- <th scope="col"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th> -->
                                        <th scope="col"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                        <th scope="col"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                        <th scope="col"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                        <th scope="col"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($todayComb as $index => $comb) { ?>
                                        <tr class="fs-12 text-center">
                                            <td style="width: 150px"><?php echo $comb['client_name'] ?></td>
                                            <!-- <td style="width: 100px"><?php echo $comb['address'] ?></td> -->
                                            <!-- <td style="width: 100px"><?php echo $comb['phone'] ?></td> -->
                                            <td style="width: 100px">
                                                <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$comb['UserID'])[0]['UserName']; ?>
                                                <a href="users.php?do=editUser&userid=<?php echo $comb['UserID'];?>"><?php echo $techName ?></a>
                                            </td>
                                            <td style="width: 50px">
                                                <?php
                                                    if ($comb['isFinished'] == 0) {
                                                        $icon   = "bi-x-circle-fill text-danger";
                                                        $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                    } elseif ($comb['isFinished'] == 1) {
                                                        $icon   = "bi-check-circle-fill text-success";
                                                        $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                    } else {
                                                        $icon   = "bi-dash-circle-fill text-info";
                                                        $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                    }
                                                ?>
                                                <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                            </td>
                                            <td style="width: 50px">
                                                <?php
                                                    if ($comb['isAccepted'] == 0) {
                                                        $iconStatus   = "bi-x-circle-fill text-danger";
                                                        $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                    } elseif ($comb['isAccepted'] == 1) {
                                                        $iconStatus   = "bi-check-circle-fill text-success";
                                                        $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                    } elseif ($comb['isAccepted'] == 2) {
                                                        $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                        $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                    } else {
                                                        $iconStatus   = "bi-dash-circle-fill text-info";
                                                        $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                    }
                                                ?>
                                                <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                            </td>
                                            <td style="width: 50px">
                                                <a href="?do=editCombination&combid=<?php echo $comb['comb_id'] ?>" target="" class="btn btn-outline-primary me-1 fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <h5 class="h5 text-danger text-capitalize "><?php echo language('THERE IS NO COMBINATIONS TO SHOW', $_SESSION['systemLang']) ?></h5>
                    <?php } ?>
                </div>
            </div>
            <!-- latest added combinations -->
            <div class="col-12">
                <div class="section-block">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize"><?php echo language('LATEST ADDED COMBINATIONS', $_SESSION['systemLang']) ?></h5>
                        <p class="text-muted "><?php echo language("HERE WILL SHOW LATEST 5 ADDED MALFUNCTIONS", $_SESSION['systemLang']) ?></p>
                        <hr>
                    </header>
                    <?php
                    // get latest added combinations of the cureent employee
                    $latestComb = getLatestRecord("*", "`combinations`", $techCondition2, "`added_date`");
                    
                    // check if array not empty
                    if (!empty($latestComb)) {   
                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered  display compact table-style">
                                <thead class="table-dark text-capitalize">
                                    <tr class="fs-12 text-center">
                                        <th scope="col"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                        <!-- <th scope="col"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th> -->
                                        <!-- <th scope="col"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th> -->
                                        <th scope="col"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                        <th scope="col"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                        <th scope="col"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                        <th scope="col"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($latestComb as $index => $comb) { ?>
                                        <tr class="fs-12 text-center">
                                            <td style="width: 150px"><?php echo $comb['client_name'] ?></td>
                                            <!-- <td style="width: 100px"><?php echo $comb['address'] ?></td> -->
                                            <!-- <td style="width: 100px"><?php echo $comb['phone'] ?></td> -->
                                            <td style="width: 100px">
                                                <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$comb['UserID'])[0]['UserName']; ?>
                                                <a href="users.php?do=editUser&userid=<?php echo $comb['UserID'];?>"><?php echo $techName ?></a>
                                            </td>
                                            <td style="width: 50px">
                                                <?php
                                                    if ($comb['isFinished'] == 0) {
                                                        $icon   = "bi-x-circle-fill text-danger";
                                                        $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                    } elseif ($comb['isFinished'] == 1) {
                                                        $icon   = "bi-check-circle-fill text-success";
                                                        $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                    } else {
                                                        $icon   = "bi-dash-circle-fill text-info";
                                                        $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                    }
                                                ?>
                                                <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                            </td>
                                            <td style="width: 50px">
                                                <?php
                                                    if ($comb['isAccepted'] == 0) {
                                                        $iconStatus   = "bi-x-circle-fill text-danger";
                                                        $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                    } elseif ($comb['isAccepted'] == 1) {
                                                        $iconStatus   = "bi-check-circle-fill text-success";
                                                        $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                    } elseif ($comb['isAccepted'] == 2) {
                                                        $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                        $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                    } else {
                                                        $iconStatus   = "bi-dash-circle-fill text-info";
                                                        $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                    }
                                                ?>
                                                <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                            </td>
                                            <td style="width: 50px">
                                                <a href="?do=editCombination&combid=<?php echo $comb['comb_id'] ?>" target="" class="btn btn-outline-primary me-1 fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <h5 class="h5 text-danger text-capitalize "><?php echo language('THERE IS NO COMBINATIONS TO SHOW', $_SESSION['systemLang']) ?></h5>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- end new design -->
    </div>
    <!-- end stats -->
</div>
<!-- end home stats container -->