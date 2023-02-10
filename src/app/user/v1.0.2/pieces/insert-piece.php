<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
    <!-- start edit profile page -->
    <div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <!-- start header -->
        <header class="header">
            
            <!-- show page header -->
            <h1 class="text-capitalize"><?php echo language('ADD NEW PIECE/CLIENT', $_SESSION['systemLang']) ?></h1>

            <?php
            // // print $_POST request variables
            // print_r($_POST);

            // get piece info from the form
            $id         = isset($_POST['next-id'])    && !empty($_POST['next-id'])   ? trim($_POST['next-id'], ' ')    : '';
            $pieceName  = isset($_POST['piece-name']) && !empty($_POST['piece-name'])? trim($_POST['piece-name'], ' ') : '';
            $ip         = isset($_POST['ip'])         && !empty($_POST['ip'])        ? trim($_POST['ip'], ' ')         : '';
            $username   = isset($_POST['user-name'])  && !empty($_POST['user-name']) ? trim($_POST['user-name'], ' ')  : '';
            $pass       = isset($_POST['password'])   && !empty($_POST['password'])  ? trim($_POST['password'], ' ')   : '';
            $dirid      = isset($_POST['direction'])  && !empty($_POST['direction']) ? trim($_POST['direction'], ' ')  : '';
            $typeid     = isset($_POST['type'])       && !empty($_POST['type'])      ? trim($_POST['type'], ' ')       : '';
            
            // get source id
            $sourceid   = isset($_POST['sourceid']) ? trim($_POST['sourceid'], ' ')   : -1;

            $phone      = trim($_POST['phone-number'], ' ');
            $address    = trim($_POST['address'], ' ');
            $connType   = isset($_POST['conn-type'])  && !empty($_POST['conn-type']) ? trim($_POST['conn-type'], ' ')  : '';
            $direct     = isset($_POST['direct'])     && !empty($_POST['direct'])    ? trim($_POST['direct'], ' ')     : '';
            $notes      = empty(trim($_POST['notes'], ' ')) ? 'لا توجد ملاحظات' : trim($_POST['notes'], ' ');
            $ssid       = trim($_POST['ssid'], ' ');
            $passConn   = trim($_POST['password-connection'], ' ');
            $frequency  = trim($_POST['frequency'], ' ');
            $devType    = trim($_POST['device-type'], ' ');
            $macAdd     = trim($_POST['mac-add'], ' ');

            // validate the form
            $formErorr = []; // error array

            // validate piece id
            if (empty($id)) {
                $formErorr[] = 'piece name cannot be less than <strong>4 characters.</strong>';
            }

            // validate piece name
            if (empty($pieceName)) {
                $formErorr[] = 'piece name cannot be <strong>empty</strong>';
            }
            // validate ip
            if (empty($ip)) {
                $formErorr[] = '<span class="text-uppercase">IP</span> cannot be <strong>empty.</strong>';
            }
            // validate username
            if (empty($username)) {
                $formErorr[] = 'username cannot be <strong>empty.</strong>';
            }
            // validate password
            if (empty($pass)) {
                $formErorr[] = 'password cannot be <strong>empty.</strong>';
            }
            // validate direction
            if (empty($dirid) || $dirid == 0) {
                $formErorr[] = 'direction cannot be <strong>empty.</strong>';
            }
            // validate type
            if (empty($typeid) || $typeid == 0) {
                $formErorr[] = 'type cannot be <strong>empty.</strong>';
            }
            // validate source ip
            if ($sourceid < 0) {
                $formErorr[] = 'source <span class="text-uppercase">ip</span> cannot be <strong>empty.</strong>';
            }

            // validate connection type
            if (empty($connType) || $connType < 0) {
                $formErorr[] = 'connection type cannot be <strong>empty.</strong>';
            }

            // loop on form error array
            foreach ($formErorr as $error) {
                echo '<div class="alert alert-danger text-capitalize w-50 mx-auto align-left">' . $error . '</div>';
            }

            // check if empty form error
            if (empty($formErorr)) {
                // check if user is exist in database or not
                $checkUser      = checkItem("`piece_name`", "`pieces`", $pieceName);
                $checkMacAdd    = !empty($macAdd) ? checkItem("`mac_add`", "`pieces`", $macAdd) : 0;
                $checkIPAdd     = $ip == '0.0.0.0' ? 0 : countRecords("`piece_id`", "`pieces`", "WHERE `piece_ip` = '$ip' AND `direction_id` = $dirid");

                if ($checkUser > 0) {
                    // show erroe message
                    $msg = '<div class="alert alert-warning text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'.language('THIS USERNAME IS ALREADY EXIST', $_SESSION['systemLang']).'</div>';
                } elseif ($checkMacAdd > 0) {
                    $msg = '<div class="alert alert-warning text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'.language('THIS MAC ADD IS ALREADY EXIST', $_SESSION['systemLang']).'</div>';
                } elseif ($checkIPAdd > 0) {
                    $msg = '<div class="alert alert-warning text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'.language('THIS IP ADD IS ALREADY EXIST', $_SESSION['systemLang']).'</div>';
                } else {
                    // INSERT INTO basic info
                    $q = "INSERT INTO `pieces`(`piece_name`, `mac_add`, `piece_ip`, `username`, `piece_pass`, `direction_id`, `source_id`, `type_id`, `direct`, `conn_type`, `added_by`, `added_date`, `notes`) VALUES (?,?,?,?,?,?,?,?,?,?,?,CURRENT_DATE(),?);";
                    // INSERT INTO pieces_addr
                    $q .= "INSERT INTO `pieces_addr` VALUES (?, ?);";
                    // INSERT INTO piece phone ..
                    $q .= "INSERT INTO `pieces_phone` VALUES (?, ?);";
                    // insert user info in database
                    $q .= "INSERT INTO `pieces_additional` (`piece_id`, `ssid`, `pass_connection`, `frequency`, `device_type`) VALUES (?,?,?,?,?);";
                    // insert user info in database
                    $stmt = $con->prepare($q);
                    $stmt->execute(array($pieceName, $macAdd, $ip, $username, $pass, $dirid, $sourceid, $typeid, $direct, $connType, $_SESSION['UserID'], $notes, $id, $address, $id, $phone, $id, $ssid, $passConn, $frequency, $devType));
                    // log message
                    $logMsg = "Added a new piece or client with name " . $pieceName . "..";
                    createLogs($_SESSION['UserName'], $logMsg);
                    // echo success message
                    $msg = '<div class="alert alert-success text-capitalize" dir="' . ($_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr') . '"><i class="bi bi-check-circle-fill"></i>&nbsp;' . language('PIECE/CLIENT ADDED SUCCESSFULLY', $_SESSION['systemLang']) . '</div>';
                }
                // redirect to add new user
                redirectHome($msg, 'back');
            } else {
        ?>
                <div class="my-3">
                    <a class="btn btn-outline-primary text-capitalize" href="?do=addPiece">return back</a>
                </div>
        <?php } ?>
    </header>
</div>
<?php } else {
    // include permission error module
    include_once 'global-module/permission-error.php';
} ?>