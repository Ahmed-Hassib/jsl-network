<?php
// number of page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// previous page
$previousPage = $page - 1;
// next page
$nextPage = $page + 1;
// array of error
$errorArray = array();
// query condition
if ($query == 'showAllPieces') {
    // show all pieces 
    $condition = "WHERE `pieces`.`type_id` != 4";                   // query condition
    $title = language('SHOW ALL PIECES', $_SESSION['systemLang']);  // page title
    $tableID = "allPieces";                                         // table id
    
} elseif ($query == 'showAllClients') {
    // show all clients
    $condition = "WHERE `pieces`.`type_id` = 4";                    // query condition
    $title = language('SHOW ALL CLIENTS', $_SESSION['systemLang']); // page title
    $tableID = "allClients";                                        // table id
    
} elseif ($query == 'showPiece') {
    // show all pieces of specific dir and specific source
    $condition = "WHERE `pieces`.`direction_id` = $dirId AND `pieces`.`source_id` = $srcId";    // query condition
    $title = language('SHOW ALL SUB PIECES', $_SESSION['systemLang']);                          // page title
    $tableID = "allChildPieces";                                                                // table id
    
} elseif ($query == 'piecesTypes' && $action == 'showPiecesType') {
    // show all pieces of specific type
    if ($typeid != 4) {
        $condition = "WHERE `pieces`.`type_id` = $typeid";              // query condition
        $title = language('SHOW ALL PIECES', $_SESSION['systemLang']);  // page title   
        // page subtitle
        $subTitle = language('SHOW ALL PIECES OF THE TYPE', $_SESSION['systemLang']) .": ". ($typeid == 0 ? language('NOT ASSIGNED', $_SESSION['systemLang']) : selectSpecificColumn("`type_name`", "`types`", "WHERE `type_id` = $typeid")[0]['type_name']);
        $tableID = "allPiecesOfType";                                   // table id
    }
    
} elseif ($query == 'showConnectionTypes' && $action == 'showPiecesConn') {
    // check the passed type
    if ($type == 1) {
        // show all pieces of specific connection type
        $condition = "WHERE `pieces`.`type_id` <> 4 AND `pieces`.`conn_type` = $connid";    // query condition
        $title = language('SHOW ALL PIECES', $_SESSION['systemLang']);                      // page title
        // check the connection id 
        if ($connid != 0) {
            // page subtitle
            $subTitle = language('SHOW ALL PIECES OF THE CONNECTION TYPE', $_SESSION['systemLang']) .": <span class='text-uppercase'>". selectSpecificColumn("`conn_name`", "`conn_types`", "WHERE `id` = $connid")[0]['conn_name']."</span>";    
        } else {    
            // page subtitle
            $subTitle = "<span class='text-danger'>".language('SHOW ALL PIECES OF UNASSIGNED CONNECTION TYPE', $_SESSION['systemLang'])."</span>";   
        }
    } elseif ($type == 2) {
        // show all clients of specific connection type
        $condition = "WHERE `pieces`.`type_id` = 4 AND `pieces`.`conn_type` = $connid";     // query condition
        $title = language('SHOW ALL CLIENTS', $_SESSION['systemLang']);                     // page title
        // check the connection id 
        if ($connid != 0) {
            // page subtitle
            $subTitle = language('SHOW ALL CLIENTS OF THE CONNECTION TYPE', $_SESSION['systemLang']) .": <span class='text-uppercase'>". selectSpecificColumn("`conn_name`", "`conn_types`", "WHERE `id` = $connid")[0]['conn_name']."</span>";    
        } else {    
            // page subtitle
            $subTitle = "<span class='text-danger'>".language('SHOW ALL CLIENTS OF UNASSIGNED CONNECTION TYPE', $_SESSION['systemLang'])."</span>";
        }
    } else {
        // show all clients of specific connection type
        $condition = "WHERE `pieces`.`conn_type` = $connid";     // query condition
        $title = language('SHOW ALL PIECES/CLIENTS', $_SESSION['systemLang']);                     // page title
        // check the connection id 
        if ($connid != 0) {
            // page subtitle
            $subTitle = language('SHOW ALL PIECES/CLIENTS OF THE CONNECTION TYPE', $_SESSION['systemLang']) .": <span class='text-uppercase'>". selectSpecificColumn("`conn_name`", "`conn_types`", "WHERE `id` = $connid")[0]['conn_name']."</span>";
        } else {    
            // page subtitle
            $subTitle = "<span class='text-danger'>".language('SHOW ALL PIECES/CLIENTS OF UNASSIGNED CONNECTION TYPE', $_SESSION['systemLang'])."</span>";
        }
    }
    $tableID = "allPiecesOfConn";                          // table id
    
} else {
    $title = '';
    $condition = '';
    $tableID = "";
    $subTitle = "";
}

//  check if number of rows per page is set
if (isset($_POST['rowsPerPage'])) {
    $_SESSION['rowsPerPage'] = $_POST['rowsPerPage'];
}

// start from
$startFrom = ($page - 1) * $_SESSION['rowsPerPage'];

// query statement
$q = "SELECT 
        `pieces`.*, 
        `pieces_addr`.`address`, 
        `pieces_phone`.`phone`,
        `pieces_additional`.`ssid`,
        `pieces_additional`.`pass_connection`,
        `pieces_additional`.`frequency`,
        `pieces_additional`.`device_type`
    FROM 
        `pieces`
    LEFT JOIN `pieces_addr` ON `pieces_addr`.`piece_id` = `pieces`.`piece_id` 
    LEFT JOIN `pieces_phone` ON `pieces_phone`.`piece_id` = `pieces`.`piece_id`
    LEFT JOIN `pieces_additional` ON `pieces_additional`.`piece_id` = `pieces`.`piece_id`
    $condition
    ORDER BY 
        `pieces`.`direction_id` ASC, 
        `pieces`.`direct` DESC, 
        `pieces`.`type_id` ASC";

$limitation = ' LIMIT '.$startFrom.', '.$_SESSION['rowsPerPage'].';';
$q2 = $q . $limitation;

// prepare statment
$stmt = $con->prepare($q2);
$stmt->execute(); // execute q2
$rows = $stmt->fetchAll(); // fetch data

// prepare statment
$st = $con->prepare($q);
$st->execute(); // execute $q
$rs = $st->fetchAll(); // fetch data

// get row count
$count = $st->rowCount();
// total pages
$totalPages = ceil($count / $_SESSION['rowsPerPage']);

$columns = array(
    "ip_col"            => "IP", 
    "mac_add_col"       => "MAC ADD", 
    "piece_name_col"    => "CLIENT NAME", 
    "username_col"      => "USERNAME", 
    "password_col"      => "PASSWORD", 
    "direction_col"     => "THE DIRECTION", 
    "source_col"        => "THE SOURCE", 
    "ssid_col"          => "SSID" , 
    "pass_conn_col"     => "PASSWORD CONNECTION" , 
    "frequency_col"     => "FREQUENCY", 
    "dev_type_col"      => "DEVICE TYPE", 
    "conn_type_col"     => "CONNECTION TYPE", 
    "address_col"       => "THE ADDRESS", 
    "phone_col"         => "PHONE", 
    "type_col"          => "THE TYPE", 
    "notes_col"         => "THE NOTES",
    "avg_ping_col"      => "AVG PING",
    "packet_loss_col"   => "PACKET LOSS",
    "conn_col"          => "CONNECTION", 
    "added_date_col"    => "ADDED DATE", 
    "added_by_col"      => "ADDED BY",
);
?>
<!-- start edit profile page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header mb-3">
        <!-- title -->
        <h1 class="text-capitalize"><?php echo $title ?></h1>
        
        <!-- check subtitle -->
        <?php if (!empty($subTitle)) { ?>
            <!-- show sub title -->
            <p class=" text-success text-capitalize" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>"><?php echo $subTitle ?></p>
        <?php } ?>

        <!-- check the counter -->
        <?php if ($count > 0) { ?>
            <div class="hstack gap-2">
                <!-- number of table rows -->
                <div>
                    <form action="?do=<?php echo $query ?><?php echo isset($action) && !empty($action) ? '&action='.$action.'&typeid='.$typeid : '' ?>" method="POST">
                        <div class="row">
                            <label for="rowPerPage" class="col-form-label col-sm-3 d-none d-lg-block"><?php echo language("SHOW", $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-8">
                                <select class="form-select py-0 py-md-1" name="rowsPerPage" id="rowPerPage" <?php echo $count < 10 ? 'disabled' : '' ?> onchange="submitForm(this)">
                                    <option value="10" <?php echo $_SESSION['rowsPerPage'] == 10 ? 'selected' : ''; ?>>10</option>
                                    <option value="25" <?php echo $_SESSION['rowsPerPage'] == 25 ? 'selected' : ''; ?>>25</option>
                                    <option value="50" <?php echo $_SESSION['rowsPerPage'] == 50 ? 'selected' : ''; ?>>50</option>
                                    <option value="100" <?php echo $_SESSION['rowsPerPage'] == 100 ? 'selected' : ''; ?>>100 (Recommended)</option>
                                    <option value="500" <?php echo $_SESSION['rowsPerPage'] == 500 ? 'selected' : ''; ?>>500</option>
                                    <option value="750" <?php echo $_SESSION['rowsPerPage'] == 750 ? 'selected' : ''; ?>>750</option>
                                    <option value="1000" <?php echo $_SESSION['rowsPerPage'] == 1000 ? 'selected' : ''; ?>>1000</option>
                                    <option value="1250" <?php echo $_SESSION['rowsPerPage'] == 1250 ? 'selected' : ''; ?>>1250</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- search box -->
                <div class="search-box row row-cols-sm-1">
                    <div class="col">
                        <input type="text" class="form-control w-100 py-0 py-md-1" name="search" id="search" placeholder="<?php echo language('TYPE HERE FOR SEARCH', $_SESSION['systemLang']) ?>" onkeyup="tableFiltration(this)">
                    </div>
                </div>
                <!-- control table`s columns button -->
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary fs-12 py-1" data-bs-toggle="modal" data-bs-target="#controlTableColumn">
                        <i class="bi bi-gear d-sm-block d-md-none"></i>
                        <span class="d-none d-md-block"><?php echo language("CONTROL TABLE COLUMNS", $_SESSION['systemLang']) ?></span>
                    </button>
                </div>
            </div>
        <?php } else { ?>
            <!-- start page not found 404 -->
            <div class="page-error">
                <img src="<?php echo $assets ?>images/no-data-founded.svg" class="img-fluid" alt="<?php echo language("NO DATA FOUNDED", $_SESSION['systemLang']) ?>">
            </div>
            <!-- end page not found 404 -->
            <!-- show alert -->
            <div class="alert alert-danger text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;<?php echo language("NO DATA FOUNDED", $_SESSION['systemLang']) ?></div>
        <?php } ?>
        <!-- end users table -->
        <?php if ($count > 50) { ?>
            <!-- pagination navbar -->
            <nav class="m-3" style="<?php echo $totalPages > 40 ? 'overflow-x: scroll' : '' ?>" aria-label="Page navigation example">
                <ul class="pagination pagination-sm <?php echo $totalPages <= 40 ? 'justify-content-center' : '' ?> " data-current="<?php echo $page ?>">
                    <li class="page-item <?php echo $previousPage == 0 ? 'disabled' : '' ?>"><a class="page-link" id="previousBtn" href="pieces.php?do=<?php echo $query ?><?php echo isset($action) && !empty($action) ? '&action='.$action.'&typeid='.$typeid : '' ?>&page=<?php echo $previousPage; ?>"><i class="bi <?php echo $_SESSION['systemLang'] == 'ar' ? 'bi-arrow-right' : 'bi-arrow-left' ?>"></i></a></li>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <li class="page-item <?php echo $page == $i ? "active" : "" ?>"><a class="page-link" href="pieces.php?do=<?php echo $query ?><?php echo isset($action) && !empty($action) ? '&action='.$action.'&typeid='.$typeid : '' ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    <li class="page-item <?php echo $nextPage > $totalPages ? 'disabled' : '' ?>"><a class="page-link" id="previousBtn" href="pieces.php?do=<?php echo $query ?><?php echo isset($action) && !empty($action) ? '&action='.$action.'&typeid='.$typeid : '' ?>&page=<?php echo $nextPage; ?>"><i class="bi <?php echo $_SESSION['systemLang'] == 'ar' ? 'bi-arrow-left' : 'bi-arrow-right' ?>"></i></a></li>
                </ul>
            </nav>
        <?php } ?>
    </header>
    
    <?php if ($count > 0) { ?>
        <!-- start table container -->
        <div class="table-responsive">
            <!-- strst users table -->
            <table class="table table-bordered  display compact table-style" id="<?php echo $tableID ?>">
                <thead class="table-dark text-capitalize">
                    <tr>
                        <th class="d-none">ID</th>
                        <th style="min-width: 50px" data-order="asc" data-col-type="number">#</th>
                        <th class="<?php echo $_SESSION['ip_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="ip" data-order="asc" data-col-type="ip" class="text-uppercase"><?php echo language('IP', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['mac_add_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="mac-add" data-order="asc" data-col-type="string" class="text-uppercase"><?php echo language('MAC ADD', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['piece_name_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="name" data-order="asc" data-col-type="string"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['username_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="username" data-order="asc" data-col-type="string"><?php echo language('USERNAME', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['password_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="pass" data-order="asc" data-col-type="string"><?php echo language('PASSWORD', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['direction_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="dir" data-order="asc" data-col-type="string"><?php echo language('THE DIRECTION', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['source_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="src" data-order="asc" data-col-type="ip"><?php echo language('THE SOURCE', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['ssid_col'] != 1 ? '' : '' ?>" style="min-width: 100px" data-col="ssid" data-order="asc" data-col-type="string"><?php echo language('SSID', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['pass_conn_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="pass-conn" data-order="asc" data-col-type="string"><?php echo language('PASSWORD CONNECTION', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['frequency_col'] != 1 ? '' : '' ?>" style="min-width: 100px" data-col="freq" data-order="asc" data-col-type="string"><?php echo language('FREQUENCY', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['dev_type_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="dev-type" data-order="asc" data-col-type="string"><?php echo language('DEVICE TYPE', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['conn_type_col'] != 1 ? '' : '' ?>" style="min-width: 100px" data-col="conn-type" data-order="asc" data-col-type="number"><?php echo language('CONNECTION TYPE', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['address_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="addr" data-order="asc" data-col-type="string"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['phone_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="phone" data-order="asc" data-col-type="string"><?php echo language('PHONE', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['type_col'] != 1 ? '' : '' ?>" style="min-width: 100px" data-col="type" data-order="asc" data-col-type="string"><?php echo language('THE TYPE', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['notes_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="notes" data-order="asc" data-col-type="string"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['avg_ping_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="avg-ping" >avg ping</th>
                        <th class="<?php echo $_SESSION['packet_loss_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="pack-loss" >packet loss</th>
                        <th class="<?php echo $_SESSION['conn_col'] != 1 ? '' : '' ?>" style="min-width: 100px" data-col="direct" data-order="asc" data-col-type="string"><?php echo language('CONNECTION', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['added_date_col'] != 1 ? '' : '' ?>" style="min-width: 200px" data-col="adedd-date" data-order="asc" data-col-type="string"><?php echo language('ADDED DATE', $_SESSION['systemLang']) ?></th>
                        <th class="<?php echo $_SESSION['added_by_col'] != 1 ? '' : '' ?>" style="min-width: 100px" data-col="adedd-by" data-order="asc" data-col-type="string"><?php echo language('ADDED BY', $_SESSION['systemLang']) ?></th>
                        <th style="min-width: 200px"><?php echo language('CONTROL', $_SESSION['systemLang']) ?></th>
                    </tr>
                </thead>
                <tbody id="piecesTbl">
                    <?php $index = $startFrom; ?>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td class="d-none"><?php echo $row['piece_id']; ?></td>
                            <td ><?php echo ++$index; ?></td>
                            <td class="text-capitalize <?php echo $row['piece_ip'] == '0.0.0.0' ? 'text-danger ' : '' ?> <?php echo $_SESSION['ip_col'] != 1 ? '' : '' ?>" data-ip="<?php echo convertIP($row['piece_ip']) ?>"><?php echo $row['piece_ip'] == '0.0.0.0' ? 'لا يوجد' :"<a href='http://" . $row['piece_ip'] . "' target='_blank'>" . $row['piece_ip'] . '</a>'; ?></td>
                            <td class="text-capitalize <?php echo !empty($row['mac_add']) ? "" : "text-danger " ?> <?php echo $_SESSION['mac_add_col'] != 1 ? '' : '' ?>"><?php echo !empty($row['mac_add']) ? $row['mac_add'] : language("NO DATA ENTERED", $_SESSION['systemLang']) ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['piece_name_col'] != 1 ? '' : '' ?>">
                                <?php echo $row['piece_name']; ?>
                                <?php if ($row['direction_id'] == 0) { ?>
                                    <i class="bi bi-exclamation-triangle-fill text-danger" title="<?php echo language("DIRECTION NO DATA ENTERED", $_SESSION['systemLang']) ?>"></i>
                                <?php } ?>
                            </td>
                            <td class="text-capitalize <?php echo $_SESSION['username_col'] != 1 ? '' : '' ?>" >
                                <a href="?do=editPiece&pieceid=<?php echo $row['piece_id']; ?>">
                                    <?php echo $row['username']; ?>
                                </a>
                            </td>
                            <td class="text-capitalize <?php echo $_SESSION['password_col'] != 1 ? '' : '' ?>" ><?php echo $row['piece_pass']; ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['direction_col'] != 1 ? '' : '' ?>" >
                                <?php if ($row['direction_id'] != 0) { ?>
                                    <a href="directions.php?do=showDir&dirId=<?php echo $row['direction_id']; ?>">
                                        <?php echo selectSpecificColumn("`direction_name`", "`direction`", "WHERE `direction_id` = ".$row['direction_id'])[0]['direction_name']; ?>
                                    </a>
                                <?php } else { ?>
                                    <p class="text-danger "><?php echo language("NO DATA ENTERED", $_SESSION['systemLang']) ?></p>
                                <?php } ?>
                            </td>
                            <?php $sourceip = $row['source_id'] == 0 ? $row['piece_ip'] : selectSpecificColumn("`piece_ip`", "`pieces`", "WHERE `piece_id` = " . $row['source_id'])[0]['piece_ip']; ?>
                            <td class="<?php echo $_SESSION['source_col'] != 1 ? '' : '' ?>" data-ip="<?php echo convertIP($sourceip) ;?>"> 
                                <?php echo '<a href="http://' . $row['source_id'] . '" target="">' . $sourceip . '</a>'; ?>
                            </td>
                            <td class="text-capitalize <?php echo $_SESSION['ssid_col'] != 1 ? '' : '' ?>"><?php echo $row['ssid']; ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['pass_conn_col'] != 1 ? '' : '' ?>"><?php echo $row['pass_connection']; ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['frequency_col'] != 1 ? '' : '' ?>"><?php echo $row['frequency']; ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['dev_type_col'] != 1 ? '' : '' ?>">
                                <?php if (!empty($row['device_type'])) { ?>
                                    <?php echo $row['device_type'] ?></td>
                                <?php } else { ?>
                                    <p class="text-danger "><?php echo language("NO DATA ENTERED", $_SESSION['systemLang']) ?></p>
                                <?php } ?>
                            <td class="text-uppercase <?php echo $_SESSION['conn_type_col'] != 1 ? '' : '' ?>" data-value="<?php echo $row['conn_type'] ?>"><?php echo $row['conn_type'] == 0 ? 'none' : selectSpecificColumn("`conn_name`", "`conn_types`", "WHERE `id` = ".$row['conn_type'])[0]['conn_name']; ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['address_col'] != 1 ? '' : '' ?>"><?php  echo $row['address'] == '' ? 'لا يوجد' : $row['address']; ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['phone_col'] != 1 ? '' : '' ?>"><?php echo $row['phone'] == '' ? 'لا يوجد' : $row['phone']; ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['type_col'] != 1 ? '' : '' ?>">
                                <?php if ($row['type_id'] != 0) { ?>
                                    <?php echo selectSpecificColumn("`type_name`", "`types`", "WHERE `type_id` = ". $row['type_id'])[0]['type_name']; ?></td>
                                <?php } else { ?>
                                    <p class="text-danger "><?php echo language("NO DATA ENTERED", $_SESSION['systemLang']) ?></p>
                                <?php } ?>
                            <td class="text-capitalize <?php echo $_SESSION['notes_col'] != 1 ? '' : '' ?>"><?php echo $row['notes']; ?></td>
                            <td class="text-capitalize <?php echo $_SESSION['avg_ping_col'] != 1 ? '' : '' ?>">
                                <?php if ($row['piece_ip'] == 1) {
                                    echo 'لا يوجد';
                                } else {
                                    echo '-----';
                                } ?>
                            </td>
                            <td class="text-capitalize <?php echo $_SESSION['packet_loss_col'] != 1 ? '' : '' ?>">
                                <?php if ($row['piece_ip'] == 1) {
                                    echo 'لا يوجد';
                                } else {
                                    echo '-----';
                                } ?>
                            </td>
                            <td class="<?php echo $_SESSION['conn_col'] != 1 ? '' : '' ?>"><?php echo $row['direct'] == 0 ? language('NOT DIRECT', $_SESSION['systemLang']) : language('DIRECT', $_SESSION['systemLang']); ?></td>
                            <td class="<?php echo $_SESSION['added_date_col'] != 1 ? '' : '' ?>"><?php echo $row['added_date'] == '0000-00-00' ? language("NO DATA ENTERED", $_SESSION['systemLang']) : $row['added_date'] ?></td>
                            <td class="<?php echo $_SESSION['added_by_col'] != 1 ? '' : '' ?>"><?php echo selectSpecificColumn("`UserName`", "`users`", "WHERE `UserID` = ". $row['added_by'])[0]["UserName"]; ?></td>
                            <td>
                                <a class="btn btn-success text-capitalize fs-12 <?php if ($_SESSION['pcs_update'] == 0) {echo '';} ?>" href="?do=editPiece&pieceid=<?php echo $row['piece_id']; ?>" target=""><i class="bi bi-pencil-square"></i><!-- <?php echo language('EDIT', $_SESSION['systemLang']) ?> --></a>
                                <?php if ($row['type_id'] != 4) { ?>
                                    <a class="btn btn-outline-primary text-capitalize fs-12 <?php if ($_SESSION['pcs_show'] == 0) {echo '';} ?>" href="?do=showPiece&dirId=<?php echo $row['direction_id'] ?>&srcId=<?php echo $row['piece_id'] ?>" ><i class="bi bi-eye"></i><!-- <?php echo language('SHOW', $_SESSION['systemLang']).' '.language('PIECES', $_SESSION['systemLang']) ?> --></a>
                                <?php } ?>
                                <?php if ($row['piece_ip'] != '0.0.0.0') { ?>
                                    <button class="btn btn-outline-secondary text-capitalize fs-12 ping" onclick="ping(this)" value="<?php echo $row['piece_ip']; ?>">ping</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>