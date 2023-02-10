<?php
// period value
$period = isset($_GET['period']) && !empty($_GET['period']) ? $_GET['period'] : 'all';
// combStatus of combination
$combStatus = isset($_GET['combStatus']) && !empty($_GET['combStatus']) ? $_GET['combStatus'] : '-1';
// is accept status of combination
$accepted = isset($_GET['accepted']) && !empty($_GET['accepted']) ? $_GET['accepted'] : '-1';

// title
$title = "SHOW ALL";

// base query
$baseQuery = "SELECT *FROM `combinations`";

// switch case to prepare the condition of the cobination
switch($combStatus) {
    case 'unfinished':
        $title .= " UNFINISHED";
        $conditionStatus = "`isFinished` = 0 AND `isAccepted` <> 2";
        break;
    case 'finished':
        $title .= " FINISHED";
        $conditionStatus = "`isFinished` = 1";
        break;
    case 'delayed':
        $title .= " DELAYED";
        $conditionStatus = "`isAccepted` = 2 OR `isFinished` = 2";
        break;
    default:
        $conditionStatus = "";
}

// switch case to prepare the condition of the cobination
switch($accepted) {
    case 'notAccepted':
        $title .= " NOT ACCEPTED";
        $acceptedStatus = "`isAccepted` = 0";
        break;
    case 'accepted':
        $title .= " ACCEPTED";
        $acceptedStatus = "`isAccepted` = 1";
        break;
    case 'delayed':
        $title .= " DELAYED";
        $acceptedStatus = "(`isAccepted` = 2 OR `isFinished` = 2)";
        break;
    default:
        $acceptedStatus = "";
}

$title .= " COMBINATIONS";

// switch case to prepare period of the query
switch($period) {
    case 'today':
        $title .= " OF TODAY";
        $conditionPeriod = " `added_date` = CURRENT_DATE";
        break;
    case 'month':
        $title .= " OF THIS MONTH";
        $conditionPeriod = " `added_date` BETWEEN '".Date('Y-m-1')."' AND '".Date('Y-m-30')."'";
        break;
    case 'previous-month':
        $title .= " OF PREVIOUS MONTH";
        // date of today
        $start = Date("Y-m-1");
        $end = Date("Y-m-30");
        // license period
        $period = ' - 1 months';
        $startDate = Date("Y-m-d", strtotime($start. $period));
        $endDate = Date("Y-m-d", strtotime($end. $period));
        // period condition
        $conditionPeriod = " `added_date` BETWEEN '$startDate' AND '$endDate'";
        break;
    default:
        $conditionPeriod = "";
}

// switch case for the logged user is tech or not
$userCondition = $_SESSION['isTech'] == 1 ? "`UserID` = ".$_SESSION['UserID'] : "";

// check the combination status condition
if (!empty($conditionStatus)) {
    // append combination status condition
    $baseQuery .= ' WHERE ' . $conditionStatus;
    // check type of combinations
    if (!empty($acceptedStatus)) {
        $baseQuery .= ' AND ' . $acceptedStatus;
        // check the condition period
        if (!empty($conditionPeriod)) {
            $baseQuery .= ' AND ' . $conditionPeriod;
            // check user condition
            if (!empty($userCondition)) {
                $baseQuery .= ' AND ' . $userCondition;
            }
        } else {
            // check user condition
            if (!empty($userCondition)) {
                $baseQuery .= ' AND ' . $userCondition;
            }
        }
    } else {
        // check the condition period
        if (!empty($conditionPeriod)) {
            $baseQuery .= ' AND ' . $conditionPeriod;
            // check user condition
            if (!empty($userCondition)) {
                $baseQuery .= ' AND ' . $userCondition;
            }
        } else {
            // check user condition
            if (!empty($userCondition)) {
                $baseQuery .= ' AND ' . $userCondition;
            }
        }
    }
} else {
    // check type of combinations
    if (!empty($acceptedStatus)) {
        $baseQuery .= ' WHERE ' . $acceptedStatus;
        // check the condition period
        if (!empty($conditionPeriod)) {
            $baseQuery .= ' AND ' . $conditionPeriod;
            // check user condition
            if (!empty($userCondition)) {
                $baseQuery .= ' AND ' . $userCondition;
            }
        } else {
            // check user condition
            if (!empty($userCondition)) {
                $baseQuery .= ' AND ' . $userCondition;
            }
        }
    } else {
        // check the condition period
        if (!empty($conditionPeriod)) {
            $baseQuery .= ' WHERE ' . $conditionPeriod;
            // check user condition
            if (!empty($userCondition)) {
                $baseQuery .= ' AND ' . $userCondition;
            }
        } else {
            // check user condition
            if (!empty($userCondition)) {
                $baseQuery .= ' WHERE ' . $userCondition;
            }
        }
    }
}

// query
$q = $baseQuery . ' ORDER BY `isFinished` DESC';

// prepaire the query
$stmt = $con->prepare($q);
$stmt->execute();               // execute query
$rows = $stmt->fetchAll();      // fetch data
$count = $stmt->rowCount();     // get row count

?>
<!-- start edit profile page -->
<div class="container">
    <!-- start header -->
    <header class="header mb-3">
        <h1 class="text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang']) . " " . language('THE COMBINATIONS', $_SESSION['systemLang']) ?></h1>
        <h5 class="h5 text-capitalize text-secondary "><?php echo language($title, $_SESSION['systemLang']); ?></h5>
        <!-- if no malfunction today -->
        <?php if ($count == 0) { ?>
            <h6 class="h6 text-capitalize text-danger "><?php echo language('THERE IS NO COMBINATIONS TO SHOW', $_SESSION['systemLang']) ?></h6>
        <?php } ?>
    </header>
    <?php
    if ($count > 0) {
    ?>
        <!-- start table container -->
        <div class="table-responsive">
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
                                        $icon   = "bi-x-circle-fill text-danger";
                                        $title  = language('UNFINISHED COMBINATION', $_SESSION['systemLang']);
                                    } elseif ($row['isFinished'] == 1) {
                                        $icon   = "bi-check-circle-fill text-success";
                                        $title  = language('FINISHED COMBINATION', $_SESSION['systemLang']);
                                    } else {
                                        $icon   = "bi-dash-circle-fill text-info";
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
                                <a href="?do=editCombination&combid=<?php echo $row['comb_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>