<?php
// start output buffering
ob_start();
// start session
session_start();
// regenerate session id
session_regenerate_id();
// title page
$pageTitle = "Reports";
// level
$level = 5;
// nav level
$nav_level = 1;
// initial configration of system
include_once str_repeat("../", $level) . "etc/init.php";
// check username in SESSION variable
if (isset($_SESSION['UserName']) && $_SESSION['isLicenseExpired'] == 0) {
    // get the query
    $query = isset($_GET['do']) ? $_GET['do'] : 'manage';
    // check the query
    if ($query == "manage") {
    ?>
        <!-- start home stats container -->
        <div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
            <!-- start header -->
            <div class="header">
                <h1 class="h1 text-capitalize"><?php echo language('REPORTS', $_SESSION['systemLang']) ?></h1>
            </div>
            <!-- end dashboard page -->
            <div class="mb-3 row row-cols-sm-1 row-cols-md-4 g-3">
                <div class="col">
                    <div class="card  bg-primary bg-gradient">
                        <div class="card-body">
                            <i class="bi bi-people"></i>
                            <span>
                                <a href="?do=clientsReports" class="stretched-link">
                                    <?php echo language('CLIENTS REPORTS', $_SESSION['systemLang']) ?>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card  bg-success bg-gradient">
                        <div class="card-body">
                            <i class="bi bi-terminal"></i>
                            <span>
                                <a href="?do=combinationsReports" class="stretched-link">
                                    <?php echo language('COMBINATIONS REPORTS', $_SESSION['systemLang']) ?>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card  bg-danger bg-gradient">
                        <div class="card-body">
                            <i class="bi bi-folder-x"></i>
                            <span>
                                <a href="?do=malfunctionsReports" class="stretched-link">
                                    <?php echo language('MALFUNCTIONS REPORTS', $_SESSION['systemLang']) ?>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } elseif ($query == "clientsReports") { ?>
        <!-- start home stats container -->
        <div class="container ">
            <!-- start header -->
            <div class="mb-5 header">
                <h1 class="h1 text-capitalize"><?php echo language('REPORTS', $_SESSION['systemLang']) ?></h1>
                <h4 class="h4  text-capitalize text-secondary"><?php echo language("CLIENTS REPORTS", $_SESSION['systemLang']) ?></h4>
                <p class="lead  text-danger"><?php echo language("SORRY, THIS PAGE IS UNDER DEVELOPING", $_SESSION['systemLang']); ?></p>
            </div>
            <div class="mb-5 stats">

            </div>
        </div>

    <?php } elseif ($query == "combinationsReports") { ?>
        <!-- start home stats container -->
        <div class="container ">
            <!-- start header -->
            <div class="mb-5 header">
                <h1 class="h1 text-capitalize"><?php echo language('REPORTS', $_SESSION['systemLang']) ?></h1>
                <h4 class="h4  text-capitalize text-secondary"><?php echo language("COMBINATIONS REPORTS", $_SESSION['systemLang']) ?></h4>
                <!-- <p class="lead  text-danger"><?php echo language("SORRY, THIS PAGE IS UNDER DEVELOPING", $_SESSION['systemLang']); ?></p> -->
            </div>
        
            <div class="mb-5 stats">
                <div class="mb-3 row row-cols-sm-1 row-cols-md-6 g-3">
                    <div class="col">
                        <div class="card  card-color-5 bg-gradient">
                            <div class="card-body">
                                <i class="bi bi-arrow-left-circle"></i>
                                <span class="">
                                    <a href="reports.php" class="stretched-link"><?php echo language('BACK', $_SESSION['systemLang']) ?></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-total bg-gradient">
                            <div class="card-body">
                                <?php $allComb = countRecords("`comb_id`", "`combinations`", ""); ?>
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) . " " .language('THE COMBINATIONS', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#comb" class="stretched-link num" data-goal="<?php echo $allComb ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-success bg-gradient">
                            <div class="card-body">
                                <?php $allComb = countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 1"); ?>
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) . " " .language('FINISHED COMBINATIONS', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#combFinished" class="stretched-link num" data-goal="<?php echo $allComb ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-danger bg-gradient">
                            <div class="card-body">
                                <?php $allComb = countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 0"); ?>
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) . " " .language('UNFINISHED COMBINATIONS', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#combUnfinished" class="stretched-link num" data-goal="<?php echo $allComb ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row row-cols-sm-1 row-cols-md-6 g-3">
                    <div class="col">
                        <div class="card  card-color-1 bg-gradient">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) . " " . language('COMBINATIONS', $_SESSION['systemLang']) . " " . language('TODAY', $_SESSION['systemLang']) ?></h5>
                                <span>
                                    <a href="#combToday" class="stretched-link">
                                        <?php echo countRecords("`comb_id`", "`combinations`", "WHERE `added_date` = CURRENT_DATE()") ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-success bg-gradient">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('FINISHED COMBINATIONS', $_SESSION['systemLang']) . " " . language('TODAY', $_SESSION['systemLang']) ?></h5>
                                <span>
                                    <a href="#finishedCombToday" class="stretched-link">
                                        <?php echo countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 1 AND added_date = CURRENT_DATE()") ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-danger bg-gradient">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('UNFINISHED COMBINATIONS', $_SESSION['systemLang']) . " " . language('TODAY', $_SESSION['systemLang']) ?></h5>
                                <span>
                                    <a href="#unfinishedCombToday" class="stretched-link">
                                        <?php echo countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 0 AND added_date = CURRENT_DATE()") ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  card-color-1 bg-gradient">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang']) . " " . language('COMBINATIONS', $_SESSION['systemLang']) . " " . language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                                <span>
                                    <a href="#combMonth" class="stretched-link">
                                        <?php
                                            $startDate  = Date('Y-m-1');
                                            $endDate    = Date('Y-m-31');
                                            echo countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."'");
                                        ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-success bg-gradient">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('FINISHED COMBINATIONS', $_SESSION['systemLang']) . " " . language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                                <span>
                                    <a href="#finishedCombMonth" class="stretched-link">
                                        <?php echo countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `isFinished` = 1"); ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-danger bg-gradient">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('UNFINISHED COMBINATIONS', $_SESSION['systemLang']) . " " . language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                                <span>
                                    <a href="#unfinishedCombMonth" class="stretched-link">
                                        <?php echo countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `isFinished` = 0"); ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- reports -->
            <div class="reports">
                <!-- all combinations -->
                <div class="mb-5" id="comb">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('THE COMBINATIONS', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalComb = countRecords("`comb_id`", "`combinations`", "");
                                $descTotalComb = language("TOTAL", $_SESSION['systemLang'])." = ".$totalComb." ".($totalComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descTotalComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations`";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all finished combinations -->
                <div class="mb-5" id="combFinished">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('FINISHED COMBINATIONS', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalComb = countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 1");
                                $descTotalComb = language("TOTAL", $_SESSION['systemLang'])." = ".$totalComb." ".($totalComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descTotalComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations` WHERE `isFinished` = 1";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all UNfinished combinations -->
                <div class="mb-5" id="combUnfinished">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('UNFINISHED COMBINATIONS', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalComb = countRecords("`comb_id`", "`combinations`", "WHERE `isFinished` = 0");
                                $descTotalComb = language("TOTAL", $_SESSION['systemLang'])." = ".$totalComb." ".($totalComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descTotalComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations` WHERE `isFinished` = 0";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all combinations today -->
                <div class="mb-5" id="combToday">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('COMBINATIONS', $_SESSION['systemLang'])." ".language('TODAY', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $todayComb = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` = CURRENT_DATE()");
                                $descTodayComb = language("TOTAL", $_SESSION['systemLang'])." = ".$todayComb." ".($todayComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descTodayComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations` WHERE `added_date` = CURRENT_DATE()";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all finished combinations today -->
                <div class="mb-5" id="finishedCombToday">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('FINISHED COMBINATIONS', $_SESSION['systemLang'])." ".language('TODAY', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $finishedComb = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` = CURRENT_DATE() AND `isFinished` = 1");
                                $descFinishedComb = language("TOTAL", $_SESSION['systemLang'])." = ".$finishedComb." ".($finishedComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descFinishedComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations` WHERE `added_date` = CURRENT_DATE() AND `isFinished` = 1";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all unfinished combinations today -->
                <div class="mb-5" id="unfinishedCombToday">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('UNFINISHED COMBINATIONS', $_SESSION['systemLang']) . " " . language('TODAY', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $unfinishedComb = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` = CURRENT_DATE() AND `isFinished` = 0");
                                $descUnfinishedComb = language("TOTAL", $_SESSION['systemLang'])." = ".$unfinishedComb." ".($unfinishedComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descUnfinishedComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations` WHERE `added_date` = CURRENT_DATE() AND `isFinished` = 0";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all combinations of this month -->
                <div class="mb-5" id="combMonth">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('COMBINATIONS', $_SESSION['systemLang'])." ".language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $date = "'".date("Y-m-1")."' AND '".date("Y-m-31")."'";
                                $monthComb = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN $date");
                                $descMonthComb = language("TOTAL", $_SESSION['systemLang'])." = ".$monthComb." ".($monthComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descMonthComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations` WHERE `added_date` BETWEEN $date";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all finished combinations of this month -->
                <div class="mb-5" id="finishedCombMonth">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('FINISHED COMBINATIONS', $_SESSION['systemLang'])." ".language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $monthFinishedComb = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN $date AND `isFinished` = 1");
                                $descFinishedMonthComb = language("TOTAL", $_SESSION['systemLang'])." = ".$monthFinishedComb." ".($monthFinishedComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descFinishedMonthComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations` WHERE `added_date` BETWEEN $date AND `isFinished` = 1";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all unfinished combinations of this month -->
                <div class="mb-5" id="unfinishedCombMonth">
                    <header class="section-header">
                        <h5 class="h5 text-capitalize "><?php echo language('UNFINISHED COMBINATIONS', $_SESSION['systemLang'])." ".language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $monthUnfinishedComb = countRecords("`comb_id`", "`combinations`", "WHERE `added_date` BETWEEN $date AND `isFinished` = 0");
                                $descUnfinishedMonthComb = language("TOTAL", $_SESSION['systemLang'])." = ".$monthUnfinishedComb." ".($monthUnfinishedComb > 2 ? language("COMBINATIONS", $_SESSION['systemLang']):language("COMBINATION", $_SESSION['systemLang']));
                                echo $descUnfinishedMonthComb;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `combinations` WHERE `added_date` BETWEEN $date AND `isFinished` = 0";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>

                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-bordered  display compact table-style" id="combinations">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) { ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['comb_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['addedBy'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['addedBy'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['UserID'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['UserID'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['client_name'] ?></td>
                                        <td class="text-center"><?php echo $row['address'] ?></td>
                                        <td class="text-center"><?php echo $row['phone'] ?></td>
                                        <td class="text-center"><?php echo $row['comment'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isFinished'] == 0) {
                                                    $icon   = "bi-dash-circle-fill text-info";
                                                    $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                                } elseif ($row['isFinished'] == 1) {
                                                    $icon   = "bi-check-circle-fill text-success";
                                                    $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $icon   = "bi-circle";
                                                    $title  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $icon ?>" title="<?php echo $title ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="combinations.php?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           
        </div>
    <?php } elseif ($query == "malfunctionsReports") { ?>
        <!-- start home stats container -->
        <div class="container ">
            <!-- start header -->
            <div class="mb-5 header">
                <h1 class="h1 text-capitalize"><?php echo language('REPORTS', $_SESSION['systemLang']) ?></h1>
                <h4 class="h4  text-capitalize text-secondary"><?php echo language("MALFUNCTIONS REPORTS", $_SESSION['systemLang']) ?></h4>
                <!-- <p class="lead  text-danger"><?php echo language("SORRY, THIS PAGE IS UNDER DEVELOPING", $_SESSION['systemLang']); ?></p> -->
            </div>
            <div class="mb-5 stats">
                <div class="mb-3 row row-cols-sm-1 row-cols-md-6 g-3">
                    <div class="col">
                        <div class="card  card-color-5 bg-gradient">
                            <div class="card-body">
                                <i class="bi bi-arrow-left-circle"></i>
                                <span class="">
                                    <a href="reports.php" class="stretched-link"><?php echo language('BACK', $_SESSION['systemLang']) ?></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-total bg-gradient">
                            <?php $allMal = countRecords("`mal_id`", "malfunctions", "") ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('THE MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#mals" class="num stretched-link" data-goal="<?php echo $allMal ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-success bg-gradient">
                            <?php $allMal = countRecords("`mal_id`", "malfunctions", "WHERE `mal_status` = 1") ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('REPAIRED MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#malsRepaired" class="num stretched-link" data-goal="<?php echo $allMal ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-danger bg-gradient">
                            <?php $allMal = countRecords("`mal_id`", "malfunctions", "WHERE `mal_status` = 0") ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('UNREPAIRED MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#malsUnrepaired" class="num stretched-link" data-goal="<?php echo $allMal ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row row-cols-sm-1 row-cols-md-6 g-3">
                    <div class="col">
                        <div class="card  card-color-1 bg-gradient">
                            <?php $allTodMal = countRecords("`mal_id`", "malfunctions", "WHERE added_date = CURRENT_DATE()") ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('MALFUNCTIONS', $_SESSION['systemLang'])." ".language('TODAY', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#malsToday" class="num stretched-link" data-goal="<?php echo $allTodMal; ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-success">
                            <?php $repTodMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 1 AND `added_date` = CURRENT_DATE()") ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('REPAIRED MALFUNCTIONS', $_SESSION['systemLang'])." ".language('TODAY', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#repairedMalsToday" class="stretched-link num" data-goal="<?php echo $repTodMal ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-danger bg-gradient">
                            <?php $unrepTodMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 0 AND `added_date` = CURRENT_DATE()") ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('UNREPAIRED MALFUNCTIONS', $_SESSION['systemLang'])." ".language('TODAY', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#unrepairedMalsToday" class="num stretched-link" data-goal="<?php echo $unrepTodMal; ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-total">
                            <?php
                                $startDate  = Date('Y-m-1');
                                $endDate    = Date('Y-m-30');
                                $allMonMal = countRecords("`mal_id`", "malfunctions", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."'");
                            ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('MALFUNCTIONS', $_SESSION['systemLang'])." ".language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#malsMonth" class="num stretched-link" data-goal="<?php echo $allMonMal ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-success">
                            <?php $repMal = countRecords("`mal_id`", "malfunctions", "WHERE mal_status = 1") ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('REPAIRED MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#repairedMalsMonth" class="num stretched-link" data-goal="<?php echo $repMal ; ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card  bg-danger">
                            <?php $unrepMal = countRecords("`mal_id`", "malfunctions", "WHERE mal_status = 0") ?>
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('UNREPAIRED MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                                <span class="nums">
                                    <a href="#unrepairedMalsMonth" class="num stretched-link" data-goal="<?php echo $unrepMal ?>">0</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reports">
                <!-- all malfunctions -->
                <div class="mb-5" id="mals">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('THE MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `malfunctions` ORDER BY `added_date` DESC, `added_time` DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all repaired malfunctions -->
                <div class="mb-5" id="malsRepaired">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('REPAIRED MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 1");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `malfunctions` WHERE `mal_status` = 1 ORDER BY `added_date` DESC, `added_time` DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- all repaired malfunctions -->
                <div class="mb-5" id="malsUnrepaired">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('UNREPAIRED MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 0");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `malfunctions` WHERE `mal_status` = 0 ORDER BY `added_date` DESC, `added_time` DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- malfunctions today -->
                <div class="mb-5" id="malsToday">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('MALFUNCTIONS', $_SESSION['systemLang'])." ".language('TODAY', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `added_date` = CURRENT_DATE()");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `malfunctions` WHERE `added_date` = CURRENT_DATE() ORDER BY `added_date` DESC, `added_time` DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- repaired malfunctions today -->
                <div class="mb-5" id="repairedMalsToday">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('REPAIRED MALFUNCTIONS', $_SESSION['systemLang'])." ".language('TODAY', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 1 AND `added_date` = CURRENT_DATE()");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `malfunctions` WHERE `mal_status` = 1 AND `added_date` = CURRENT_DATE() ORDER BY added_date DESC, added_time DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- unrepaired malfunctions today -->
                <div class="mb-5" id="unrepairedMalsToday">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('UNREPAIRED MALFUNCTIONS', $_SESSION['systemLang'])." ".language('TODAY', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `mal_status` = 0 AND `added_date` = CURRENT_DATE()");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `malfunctions` WHERE `mal_status` = 0 AND `added_date` = CURRENT_DATE() ORDER BY added_date DESC, added_time DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- malfunctions of this months -->
                <div class="mb-5" id="malsMonth">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('MALFUNCTIONS', $_SESSION['systemLang'])." ".language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."'");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $startDate  = Date('Y-m-1');
                        $endDate    = Date('Y-m-30');
                        $q = "SELECT *FROM `malfunctions` WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' ORDER BY added_date DESC, added_time DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- repaired malfunctions of this months -->
                <div class="mb-5" id="repairedMalsMonth">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('REPAIRED MALFUNCTIONS', $_SESSION['systemLang'])." ".language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `mal_status` = 1");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `malfunctions` WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `mal_status` = 1 ORDER BY added_date DESC, added_time DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- unrepaired malfunctions of this months -->
                <div class="mb-5" id="unrepairedMalsMonth">
                    <header class="section-header">
                        <h5 class="text-capitalize "><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('UNREPAIRED MALFUNCTIONS', $_SESSION['systemLang'])." ".language('OF THIS MONTH', $_SESSION['systemLang']) ?></h5>
                        <span class="fs-12 text-capitalize">
                            <?php 
                                $totalMal = countRecords("`mal_id`", "`malfunctions`", "WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `mal_status` = 0");
                                $desctotalMal = language("TOTAL", $_SESSION['systemLang'])." = ".$totalMal." ".($totalMal > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']):language("MALFUNCTION", $_SESSION['systemLang']));
                                echo $desctotalMal;
                            ?>
                        </span>
                        <span class="section-icon"><i class="bi bi-dash"></i></span>
                        <hr>
                    </header>
                    <?php
                        $q = "SELECT *FROM `malfunctions` WHERE `added_date` BETWEEN '".$startDate."' AND '".$endDate."' AND `mal_status` = 0 ORDER BY added_date DESC, added_time DESC";
                        // prepaire the query
                        $stmt = $con->prepare($q);
                        $stmt->execute();               // execute query
                        $rows = $stmt->fetchAll();      // fetch data
                        $count = $stmt->rowCount();     // get row count
                    ?>
                    <!-- start table container -->
                    <div class="table-responsive-sm">
                        <!-- strst users table -->
                        <table class="table table-striped table-bordered  display compact table-style" id="malfunctions">
                            <thead class="table-dark text-capitalize">
                                <tr>
                                    <th class="text-center d-none">id</th>
                                    <th data-order="asc" data-col-type="number" class="text-center" style="max-width: 50px">#</th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 150px"><?php echo language('PIECE NAME', $_SESSION['systemLang'])." / ".language('THE CLIENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="max-width: 200px"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: "><?php echo language('TECHNICAL MAN COMMENT', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 100px"><?php echo language('ADDED TIME', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center" style="width: 70px"><?php echo language('STATUS', $_SESSION['systemLang']) ?></th>
                                    <th data-order="asc" data-col-type="string" class="text-center fs-10-sm" style="width: 70px"><?php echo language('TECH STATUS', $_SESSION['systemLang']) ?></th>
                                    <th class="text-center "><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $index => $row) {
                                ?>
                                    <tr>
                                        <td class="d-none"><?php echo $row['mal_id'] ?></td>
                                        <td class="text-center"><?php echo ($index + 1) ?></td>
                                        <td class="text-center">
                                            <?php $adminName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['mng_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['mng_id'];?>"><?php echo $adminName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $techName = selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ".$row['tech_id'])[0]['UserName']; ?>
                                            <a href="users.php?do=editUser&userid=<?php echo $row['tech_id'];?>"><?php echo $techName ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?php $clientnName = selectSpecificColumn("`piece_name`", "`pieces`", "WHERE `piece_id` = '" . $row['client_id'] . "' LIMIT 1")[0]['piece_name']; ?>
                                            <a href="pieces.php?do=editPiece&pieceid=<?php echo $row['client_id'];?>"><?php echo $clientnName ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row['descreption'] ?></td>
                                        <td class="text-center <?php echo empty($row['tech_comment']) ? 'text-danger ' : '' ?>"><?php echo !empty($row['tech_comment']) ? $row['tech_comment'] : language('THERE IS NO COMMENT OR NOTE TO SHOW', $_SESSION['systemLang']) ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_date']), "Y-m-d") ?></td>
                                        <td class="text-center"><?php echo date_format(date_create($row['added_time']), "h:i a") ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($row['mal_status'] == 0) {
                                                $iconStatus   = "bi-x-circle-fill text-danger";
                                                $titleStatus  = language('UNREPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 1) {
                                                $iconStatus   = "bi-check-circle-fill text-success";
                                                $titleStatus  = language('REPAIRED', $_SESSION['systemLang']);
                                            } elseif ($row['mal_status'] == 2) {
                                                $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                            } else {
                                                $iconStatus   = "bi-dash-circle-fill text-info";
                                                $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                            }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($row['isAccepted'] == 0) {
                                                    $iconStatus   = "bi-x-circle-fill text-danger";
                                                    $titleStatus  = language('NOT ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 1) {
                                                    $iconStatus   = "bi-check-circle-fill text-success";
                                                    $titleStatus  = language('ACCEPTED', $_SESSION['systemLang']);
                                                } elseif ($row['isAccepted'] == 2) {
                                                    $iconStatus   = "bi-exclamation-circle-fill text-warning";
                                                    $titleStatus  = language('DELAYED COMBINATION', $_SESSION['systemLang']);
                                                } else {
                                                    $iconStatus   = "bi-dash-circle-fill text-info";
                                                    $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                                }
                                            ?>
                                            <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="malfunctions.php?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    <?php } else { ?>
    <!-- start edit profile page -->
        <div class="my-5 container">
            <!-- start header -->
            <header class="header">
                <?php
                    // echo "No page with this name";
                    // error message
                    $msg = '<div class="alert alert-warning text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'.language('THERE IS NO PAGE WITH THIS NAME', $_SESSION['systemLang']).'</div>';
                    // redirect to home page
                    redirectHome($msg);
                ?>
            </header>
        </div>
<?php }

} else { ?>
    <!-- start edit profile page -->
        <div class="my-5 container">
            <!-- start header -->
            <header class="header">
                <?php
                    // echo "No page with this name";
                    // error message
                    $msg = '<div class="alert alert-warning text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'.language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE').'</div>';
                    // redirect to home page
                    redirectHome($msg);
                ?>
            </header>
        </div>
<?php }

// footer
include_once $tpl . "footer.php"; 
include_once $tpl . "js-includes.php";
// include_once $tpl . "comb-reports-charts.php";

ob_end_flush();
?>