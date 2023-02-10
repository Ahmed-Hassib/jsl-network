<!-- start edit profile page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header">
        <h1 class="text-capitalize"><?php echo language('CONTROL TABLE COLUMNS', $_SESSION['systemLang']) ?></h1>
        <?php
        //  check the request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // get columns that user want to show
            $ip_col             = isset($_POST['ip_col'])           ? $_POST['ip_col']          : 0;
            $mac_add_col        = isset($_POST['mac_add_col'])      ? $_POST['mac_add_col']     : 0;
            $piece_name_col     = isset($_POST['piece_name_col'])   ? $_POST['piece_name_col']  : 0;
            $username_col       = isset($_POST['username_col'])     ? $_POST['username_col']    : 0;
            $password_col       = isset($_POST['password_col'])     ? $_POST['password_col']    : 0;
            $direction_col      = isset($_POST['direction_col'])    ? $_POST['direction_col']   : 0;
            $source_col         = isset($_POST['source_col'])       ? $_POST['source_col']      : 0;
            $ssid_col           = isset($_POST['ssid_col'])         ? $_POST['ssid_col']        : 0;
            $pass_conn_col      = isset($_POST['pass_conn_col'])    ? $_POST['pass_conn_col']   : 0;
            $frequency_col      = isset($_POST['frequency_col'])    ? $_POST['frequency_col']   : 0;
            $dev_type_col       = isset($_POST['dev_type_col'])     ? $_POST['dev_type_col']    : 0;
            $conn_type_col      = isset($_POST['conn_type_col'])    ? $_POST['conn_type_col']   : 0;
            $address_col        = isset($_POST['address_col'])      ? $_POST['address_col']     : 0;
            $phone_col          = isset($_POST['phone_col'])        ? $_POST['phone_col']       : 0;
            $type_col           = isset($_POST['type_col'])         ? $_POST['type_col']        : 0;
            $notes_col          = isset($_POST['notes_col'])        ? $_POST['notes_col']       : 0;
            $avg_ping_col       = isset($_POST['avg_ping_col'])     ? $_POST['avg_ping_col']    : 0;
            $packet_loss_col    = isset($_POST['packet_loss_col'])  ? $_POST['packet_loss_col'] : 0;
            $conn_col           = isset($_POST['conn_col'])         ? $_POST['conn_col']        : 0;
            $added_date_col     = isset($_POST['added_date_col'])   ? $_POST['added_date_col']  : 0;
            $added_by_col       = isset($_POST['added_by_col'])     ? $_POST['added_by_col']    : 0;
            // chek if this user control the columns before or not 
            $isExist = checkItem("`UserID`", "`users_pieces_columns`", $_SESSION['UserID']);
            // if exist update the record
            // if not exist insert the new record
            if ($isExist > 0) {
                // query 
                $query = "UPDATE `users_pieces_columns` SET `ip` = ?, `mac_add` = ?, `piece_name` = ?, `username` = ?, `password` = ?, `direction` = ?, `source` = ?, `ssid` = ?, `pass_conn` = ?, `frequency` = ?, `dev_type` = ?, `conn_type` = ?, `address` = ?, `phone` = ?, `type` = ?, `notes` = ?, `avg_ping` = ?, `packet_loss` = ?, `conn` = ?, `added_date` = ?, `added_by` = ? WHERE `UserID` = ?";
                $stmt = $con->prepare($query);
                $stmt->execute(array($ip_col, $mac_add_col, $piece_name_col, $username_col, $password_col, $direction_col, $source_col, $ssid_col, $pass_conn_col, $frequency_col, $dev_type_col, $conn_type_col, $address_col, $phone_col, $type_col, $notes_col, $avg_ping_col, $packet_loss_col,$conn_col, $added_date_col, $added_by_col, $_SESSION['UserID']));
            } else {
                // query 
                $query = "INSERT INTO `users_pieces_columns` (`UserID`, `ip`, `mac_add`, `piece_name`, `username`, `password`, `direction`, `source`, `ssid`, `pass_conn`, `frequency`, `dev_type`, `conn_type`, `address`, `phone`, `type`, `notes`, `avg_ping`, `packet_loss`, `conn`, `added_date`, `added_by`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $con->prepare($query);
                $stmt->execute(array($_SESSION['UserID'], $ip_col, $mac_add_col, $piece_name_col, $username_col, $password_col, $direction_col, $source_col, $ssid_col, $pass_conn_col, $frequency_col, $dev_type_col, $conn_type_col, $address_col, $phone_col, $type_col, $notes_col, $avg_ping_col, $packet_loss_col,$conn_col, $added_date_col, $added_by_col));
            }
            // update session
            updateSession();
            // success message
            $msg = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;'. language("UPDATED SUCCESSFULLY", $_SESSION['systemLang']) . '</div>';
            // redirect to home page
            redirectHome($msg, 'back', 1);
        } else {
            // error message
            $msg = '<div class="alert alert-warning text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'. language("YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE") . '</div>';
            // redirect to home page
            redirectHome($msg);
        } ?>
    </header>
</div>