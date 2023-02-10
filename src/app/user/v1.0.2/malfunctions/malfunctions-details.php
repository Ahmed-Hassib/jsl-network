<?php
// period value
$action = isset($_GET['period']) && !empty($_GET['period']) ? $_GET['period'] : 'all';
// malStatus of combination
$malStatus = isset($_GET['malStatus']) && !empty($_GET['malStatus']) ? $_GET['malStatus'] : '-1';
// is accept status of combination
$accepted = isset($_GET['accepted']) && !empty($_GET['accepted']) ? $_GET['accepted'] : '-1';

// title
$title = "SHOW ALL";

// base query
$baseQuery = "SELECT *FROM `malfunctions`";

// switch case to prepare the condition of the cobination
switch($malStatus) {
    case 'unrepaired':
        $title .= " UNREPAIRED";
        $conditionStatus = "`mal_status` = 0 AND `isAccepted` <> 2";
        break;
    case 'repaired':
        $title .= " REPAIRED";
        $conditionStatus = "`mal_status` = 1";
        break;
    case 'delayed':
        $title .= " DELAYED";
        $conditionStatus = "(`mal_status` = 2 OR `isAccepted` = 2)";
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
        $acceptedStatus = "(`mal_status` = 2 OR `isAccepted` = 2)";
        break;
    default:
        $acceptedStatus = "";
}

$title .= " MALFUNCTIONS";

// switch case to prepare period of the query
switch($action) {
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
$userCondition = $_SESSION['isTech'] == 1 ? "`tech_id` = ".$_SESSION['UserID'] : "";

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
$q = $baseQuery . ' ORDER BY `added_date` ASC';

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
        <h1 class="text-capitalize"><?php echo language('SHOW', $_SESSION['systemLang'])." ".language('THE MALFUNCTIONS', $_SESSION['systemLang']) ?></h1>
        <h5 class="h5 text-capitalize  text-secondary"><?php echo language($title, $_SESSION['systemLang']) ?></h5>
        <!-- if no malfunction today -->
        <?php if ($count == 0) { ?>
            <h6 class="h6 text-capitalize text-danger "><?php echo language('THERE IS NO MALFUNCTIONS TO SHOW', $_SESSION['systemLang']) ?></h6>
        <?php } ?>
    </header>
    <?php
    if ($count > 0) {
    ?>
        <!-- start table container -->
        <div class="table-responsive">
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
                                        $titleStatus  = language('DELAYED', $_SESSION['systemLang']);
                                    } else {
                                        $iconStatus   = "bi-dash-circle-fill text-info";
                                        $titleStatus  = language('NO STATUS', $_SESSION['systemLang']);
                                    }
                                ?>
                                <i class="bi <?php echo $iconStatus ?>" title="<?php echo $titleStatus ?>"></i>
                            </td>
                            <td class="text-center">
                                <a href="?do=editMalfunction&malid=<?php echo $row['mal_id'] ?>" class="btn btn-outline-primary fs-12 <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    }
    ?>
</div>