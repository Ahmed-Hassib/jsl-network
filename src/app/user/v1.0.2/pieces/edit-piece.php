<?php
// edit piece page
// check if Get request pieceid is numeric and get the integer value
$pieceid = isset($_GET['pieceid']) && is_numeric($_GET['pieceid']) ? intval($_GET['pieceid']) : 0;
// get user info from database
$q = 'SELECT 
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
WHERE 
    `pieces`.`piece_id` = ?
ORDER BY 
    `pieces`.`direction_id` ASC, 
    `pieces`.`direct` DESC, 
    `pieces`.`type_id` ASC';
    
// prepare the query
$stmt = $con->prepare($q);
$stmt->execute([$pieceid]); // execute query
$row = $stmt->fetch(); // fetch data
$count = $stmt->rowCount(); // get row count
// check the row count
if ($count > 0) { ?>
    <!-- start add new user page -->
    <div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <!-- start header -->
        <header class="header">
            <h1 class="h1 text-capitalize"><?php echo language('EDIT', $_SESSION['systemLang']) ?> <?php if ($row['type_id'] != 4) { echo language('PIECE', $_SESSION['systemLang']); } else { echo language('CLIENT', $_SESSION['systemLang']); } ?></h1>
            <h5 class="h5 text-capitalize text-secondary "><?php if ($row['type_id'] != 4) { echo language('PIECE NAME', $_SESSION['systemLang']); } else { echo language('CLIENT NAME', $_SESSION['systemLang']); } ?>: <?php echo $row['piece_name']; ?></h5>
        </header>
        <!-- end header -->
        <!-- start new design -->
        <form class="custom-form need-validation" action="?do=updatePieceInfo" method="POST" id="editPiece">
            <!-- horzontal stack -->
            <div class="hstack gap-3">
                <h6 class="h6  text-decoration-underline text-capitalize text-danger">
                    <span><?php echo language('NOTE', $_SESSION['systemLang']) ?>:</span>&nbsp;
                    <span><?php echo language('THIS SIGN * IS REFERE TO REQUIRED FIELDS', $_SESSION['systemLang']) ?></span>
                </h6>
            </div>
            <!-- start piece info -->
            <div class="mb-3 row row-cols-sm-1 row-cols-md-2 g-3 align-items-stretch justify-content-start">
                <!-- first column -->
                <div class="col-12">
                    <div class="section-block">
                        <div class="section-header">
                            <h5><?php echo language('PERSONAL INFO', $_SESSION['systemLang']) ?></h5>
                            <hr />
                        </div>
                        <!-- Id -->
                        <input type="hidden" class="form-control" id="piece-id" name="piece-id" placeholder="ID" readonly value="<?php echo $row['piece_id']; ?>"/>
                        <!-- piece name -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="piece-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('FULLNAME', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control" id="piece-name" name="piece-name" placeholder="<?php echo language('FULLNAME', $_SESSION['systemLang']) ?>" value="<?php echo $row['piece_name']; ?>" required />
                            </div>
                        </div>
                        <!-- address -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="address" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" name="address" id="address" class="form-control w-100" placeholder="<?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?>" value="<?php echo $row['address']; ?>" />
                            </div>
                        </div>
                        <!-- phone -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="phone-number" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('PHONE', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" name="phone-number" id="phone-number" class="form-control w-100" placeholder="<?php echo language('PHONE', $_SESSION['systemLang']) ?>" value="<?php echo $row['phone']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- second column -->
                <div class="col-12">
                    <div class="section-block">
                        <div class="section-header">
                            <h5><?php echo language('CONNECTION INFO', $_SESSION['systemLang']) ?></h5>
                            <hr />
                        </div>
                        <!-- direction -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="direction" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE DIRECTION', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <select class="form-select" id="direction" name="direction" onchange="getSources(this)" required>
                                    <?php
                                    // prepare query
                                    $q = 'SELECT *FROM `direction`';
                                    // prepare the query
                                    $stmt = $con->prepare($q); // select all users
                                    $stmt->execute(); // execute data
                                    $dirrows = $stmt->fetchAll(); // assign all data to variable
                                    $count = $stmt->rowCount();
                                    // check the row count
                                    if ($count > 0) { ?>
                                        <option value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('THE DIRECTION', $_SESSION['systemLang']) ?></option>
                                        <?php foreach ($dirrows as $dirrow) { ?>
                                            <option value="<?php echo $dirrow['direction_id'] ?>" data-dir-ip="<?php echo $dirrow['direction_ip'] ?>" <?php echo $row['direction_id'] == $dirrow['direction_id'] ? 'selected' : '' ?> >
                                                <?php echo  $dirrow['direction_name'] ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="default" disabled selected><?php echo language('NOT AVAILABLE NOW', $_SESSION['systemLang']) ?></option>';
                                    <?php } ?>
                                </select>
                                <div id="dirHelp" class="form-text text-muted">
                                    <span><?php echo language('IF YOU WANT TO CHANGE THE DIRECTION OF THIS PIECE, THE DIRECTION OF ALL CHILDREN OF THIS PIECE -IF EXIST- WILL BE CHANGE TOO', $_SESSION['systemLang']) ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- type -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="types" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE TYPE', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <select class="form-select" id="types" name="type" required>
                                    <?php
                                    // prepare query
                                    $q = 'SELECT *FROM `types`';
                                    // prepare the query
                                    $stmt = $con->prepare($q); // select all users
                                    $stmt->execute(); // execute data
                                    $typerows = $stmt->fetchAll(); // assign all data to variable
                                    $count = $stmt->rowCount();
                                    // check the row count
                                    if ($count > 0) { ?>
                                        <option value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('THE TYPE', $_SESSION['systemLang']) ?></option>
                                        <?php foreach ($typerows as $typerow) { ?>
                                            <option value="<?php echo $typerow['type_id'] ?>" <?php echo $row['type_id'] == $typerow['type_id'] ? 'selected' : '' ?>>
                                                <?php echo $typerow['type_name'] ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="default" disabled selected><?php echo language('NOT AVAILABLE NOW', $_SESSION['systemLang']) ?></option>';
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- source -->
                        <div class="mb-3 row">
                            <label for="sources" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE SOURCE', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <select class="form-select" id="sources" name="sourceid" required>
                                    <option value="default" selected disabled><?php echo language('SELECT', $_SESSION['systemLang']) ." ". language('THE SOURCE', $_SESSION['systemLang']) ?></option>
                                    <?php
                                    // prepare query
                                    $q = 'SELECT `pieces`.`piece_id`, `pieces`.`piece_ip`, `pieces`.`piece_name` FROM `pieces` LEFT JOIN `types` ON `types`.`type_id` = `pieces`.`type_id` WHERE `pieces`.`type_id` != 4 AND `pieces`.`piece_id` <> ? AND `pieces`.`direction_id` = ? ORDER BY `pieces`.`direction_id` ASC, `pieces`.`piece_id` ASC, `types`.`type_name` ASC';
                                    
                                    $stmt = $con->prepare($q); // select all directions
                                    $stmt->execute(array($row['piece_id'], $row['direction_id'])); // execute data
                                    $srcrows = $stmt->fetchAll(); // assign all data to variable
                                    $count = $stmt->rowCount();
                                    // check the result of the query
                                    if ($count > 0) { ?>
                                        <?php foreach ($srcrows as $srcrow) { ?>
                                            <option value="<?php echo $srcrow['piece_id'] ?>" <?php echo $row['source_id'] == $srcrow['piece_id'] ? 'selected' : '' ?> <?php echo $row['source_id'] == 0 && $row['piece_ip'] == $srcrow['piece_ip'] ? 'selected' : '' ?>>
                                                <?php echo $srcrow['piece_ip'] . ' - ' . $srcrow['piece_name'] ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="default" disabled selected><?php echo language('NOT AVAILABLE NOW', $_SESSION['systemLang']) ?></option>';
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- direct -->
                        <div class="mb-3 row">
                            <label for="direct" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('CONNECTION', $_SESSION['systemLang']) ?></label>
                            <div class="mt-1 col-sm-12 col-md-8">
                                <select class="form-select" name="direct" id="direct" required>
                                    <option value="default" selected disabled><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('CONNECTION', $_SESSION['systemLang']) ?></option>
                                    <option value="1" <?php if ( $row['direct'] == 1) { echo 'selected';} ?>><?php echo language('DIRECT', $_SESSION['systemLang']) ?></option>
                                    <option value="0" <?php if ( $row['direct'] == 0) { echo 'selected';} ?>><?php echo language('NOT DIRECT', $_SESSION['systemLang']) ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- connection type -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="conn-type" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('CONNECTION TYPE', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <select class="form-select text-uppercase" name="conn-type" id="conn-type" required>
                                    <?php
                                    // prepare query
                                    $q = 'SELECT *FROM `conn_types`';

                                    $stmt = $con->prepare($q); // select all directions
                                    $stmt->execute(); // execute data
                                    $connTypeRows = $stmt->fetchAll(); // assign all data to variable
                                    $count = $stmt->rowCount();
                                    ?>
                                    <?php if ($count > 0) { ?>
                                        <option value="default" selected disabled><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('CONNECTION TYPE', $_SESSION['systemLang']) ?></option>
                                        <?php foreach ($connTypeRows as $connTypesRow) { ?>
                                            <option value='<?php echo $connTypesRow['id'] ?>' <?php echo $row['conn_type'] == $connTypesRow['id'] ? 'selected' : '' ?>>
                                                <?php echo $connTypesRow['conn_name'] ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="default" disabled selected><?php echo language('NOT AVAILABLE NOW', $_SESSION['systemLang']) ?></option>';
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- third column -->
                <div class="col-12">
                    <div class="section-block">
                        <div class="section-header">
                            <h5><?php echo language('PIECE INFO', $_SESSION['systemLang']) ?></h5>
                            <hr />
                        </div>
                        <!-- IP -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="ip" class="col-sm-12 col-md-4 col-form-label"><span class="text-uppercase"><?php echo language('IP', $_SESSION['systemLang']) ?></span></label>
                            <div class="col-sm-12 col-md-8">
                                    <input type="text" class="form-control" id="ip" name="ip" placeholder="xxx.xxx.xxx.xxx" onfocus="validateIPaddress(this)" onkeyup="validateIPaddress(this)" required value="<?php echo $row['piece_ip']; ?>" />
                                    <?php if ($row['piece_ip'] == "0.0.0.0") {
                                        echo '<div id="ipHelp" class="form-text text-info">'. language('THIS DEVICE/CLIENT DOESN`T HAVE AN IP', $_SESSION['systemLang']) .'</div>';
                                    } ?>
                                    <div id="ipHelp" class="form-text text-info"><?php echo language('IF PIECE/CLIENT NOT HAVE AN IP PRESS 0.0.0.0', $_SESSION['systemLang']) ?></div>
                            </div>
                        </div>
                        <!-- user name -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="user-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('USERNAME', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control" id="user-name" name="user-name" placeholder="<?php echo language('USERNAME', $_SESSION['systemLang']) ?>" value="<?php echo $row['username']; ?>" required />
                            </div>
                        </div>
                        <!-- password -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="password" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('PASSWORD', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo language('PASSWORD', $_SESSION['systemLang']) ?>" required value="<?php echo $row['piece_pass']; ?>" />
                                <i class="bi bi-eye-slash show-pass <?php echo $_SESSION['systemLang'] == 'ar' ? 'show-pass-left' : 'show-pass-right' ?>" onclick="showPass(this)"></i>
                                <div id="passHelp" class="form-text text-warning"><?php echo language('DON`T SHARE THIS PASSWORD WITH ANYONE', $_SESSION['systemLang']) ?></div>
                            </div>
                        </div>
                        <?php
                            // check if the piece has an additional info or not 
                            $checkAddInfo = checkItem("`piece_id`", "`pieces_additional`", $row['piece_id']);
                            // checck 
                            if ($checkAddInfo > 0) {
                                $additionalInfo = selectSpecificColumn("`ssid`, `pass_connection`, `frequency`, `device_type`", "`pieces_additional`", "WHERE `piece_id` = ".$pieceid)[0];
                            }
                        ?>
                        <!-- ssid -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="ssid" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('SSID', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control" id="ssid" name="ssid" placeholder="<?php echo language('SSID', $_SESSION['systemLang']) ?>" value="<?php echo $checkAddInfo ? $additionalInfo['ssid'] : "" ?>" />
                            </div>
                        </div>
                        <!-- password-connection -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="password-connection" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('PASSWORD CONNECTION', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="password" class="form-control" id="password-connection" name="password-connection" placeholder="<?php echo language('PASSWORD CONNECTION', $_SESSION['systemLang']) ?>" value="<?php echo $checkAddInfo ? $additionalInfo['pass_connection'] : "" ?>" />
                                <i class="bi bi-eye-slash show-pass <?php echo $_SESSION['systemLang'] == 'ar' ? 'show-pass-left' : 'show-pass-right' ?>" onclick="showPass(this)" ></i>
                                <div id="passHelp" class="form-text text-warning"><?php echo language('DON`T SHARE THIS PASSWORD WITH ANYONE', $_SESSION['systemLang']) ?></div>
                            </div>
                        </div>
                        <!-- frequency -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="frequency" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('FREQUENCY', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control" id="frequency" name="frequency" placeholder="<?php echo language('FREQUENCY', $_SESSION['systemLang']) ?>" value="<?php echo $checkAddInfo ? $additionalInfo['frequency'] : "" ?>" />
                            </div>
                        </div>
                        <!-- device-type -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="device-type" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('DEVICE TYPE', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control" id="device-type" name="device-type" placeholder="<?php echo language('DEVICE TYPE', $_SESSION['systemLang']) ?>" value="<?php echo $checkAddInfo ? $additionalInfo['device_type'] : "" ?>" />
                            </div>
                        </div>
                        <!-- MAC ADD -->
                        <div class="mb-sm-2 mb-md-3 row">
                            <label for="mac-add" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('MAC ADD', $_SESSION['systemLang']) ?></label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control" id="mac-add" name="mac-add" onfocus="validateMacAddress(this)" onkeyup="validateMacAddress(this)"  placeholder="<?php echo language('MAC ADD', $_SESSION['systemLang']) ?>" value="<?php echo $row['mac_add'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- forth column -->
                <div class="col-12">
                    <div class="vstack gap-3">
                        <div>
                            <div class="section-block">
                                <div class="section-header">
                                    <h5><?php echo language('ADDITIONAL INFO', $_SESSION['systemLang']) ?></h5>
                                    <hr />
                                </div>
                                <!-- notes -->
                                <div class="mb-sm-2 mb-md-3 row">
                                    <label for="notes" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></label>
                                    <div class="col-sm-12 col-md-8">
                                        <textarea name="notes" id="notes" title="put some notes hete if exist" class="form-control w-100" style="height: 10rem; resize: none; direction: <?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>" placeholder="<?php echo language('PUT YOUR NOTES HERE', $_SESSION['systemLang']) ?>" ><?php echo $row['notes']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- malfunctions -->
                        <?php $malCounter = countRecords("`mal_id`", "`malfunctions`", "WHERE `client_id` = ".$row['piece_id']) ?>
                        <?php if ($malCounter > 0) { ?>
                            <div>
                                <div class="section-block">
                                    <div class="section-header">
                                        <h5><?php echo language('THE MALFUNCTIONS', $_SESSION['systemLang']) ?></h5>
                                        <hr />
                                    </div>
                                    <!-- malfunctions counter -->
                                    <div class="mb-sm-2 mb-md-3 row">
                                        <label for="malfunction-counter" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('MALFUNCTIONS COUNTER', $_SESSION['systemLang']) ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <label class="col-form-label text-capitalize">
                                                <span class="m-3 me-3 text-start" dir="<?php echo $_SESSION['systemLang'] == "ar" ? "rtl" : "ltr" ?>"><?php echo $malCounter . " " . ($malCounter > 2 ? language("MALFUNCTIONS", $_SESSION['systemLang']) : language("MALFUNCTION", $_SESSION['systemLang'])) ?></span>
                                                <a href="malfunctions.php?do=showPiecesMal&pieceid=<?php echo $row['piece_id'] ?>" class="mt-2 text-start" dir="<?php echo $_SESSION['systemLang'] == "ar" ? "rtl" : "ltr" ?>"><?php echo language("SHOW DETAILS", $_SESSION['systemLang']) ?></a>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- malfunctions counter -->
                                    <div class="mb-sm-2 mb-md-3 row">
                                        <label for="malfunction-counter" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('LATEST MALFUNCTION DATE', $_SESSION['systemLang']) ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <?php $latestMalDate = get_latest_records("`added_date`", "`malfunctions`", "WHERE `client_id` = ".$row['piece_id'], "added_date", 1)[0]['added_date'] ?>
                                            <input type="text" class="form-control"  value="<?php echo $latestMalDate ?>" readonly /> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- submit -->
            <div class="hstack gap-3">
                <div class="<?php echo $_SESSION['systemLang'] == 'ar' ? 'me-auto' : 'ms-auto' ?>">
                    <button type="button" form="editPiece" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'ltr' : 'rtl' ?>" class="btn btn-primary text-capitalize" <?php if ($_SESSION['pcs_update'] == 0 && $row['UserID'] != $_SESSION['UserID']) {echo 'disabled';} ?> onclick="validateForm(this.form)"><i class="bi bi-check-all"></i>&nbsp;<?php echo language('SAVE CHANGES', $_SESSION['systemLang']) ?></button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deletePieceModal" class="btn btn-outline-danger text-capitalize bg-gradient <?php if ($_SESSION['pcs_delete'] == 0) {echo 'd-none';} ?>" id="delete-piece">
                        <i class="bi bi-trash"></i>&nbsp;<?php echo language('DELETE', $_SESSION['systemLang']) ?>
                    </button>
                </div>
            </div>
        </form>

        <!-- include delete piece modal -->
        <?php if ($_SESSION['pcs_delete'] == 1) { include_once 'includes/delete-piece-modal.php'; } ?>

    </div>
<?php } else { 

    // include no data founded module
    include_once 'global-modules/no-data-founded.php';

} ?>