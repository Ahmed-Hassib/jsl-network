<!-- start edit profile page -->
<div class="container">
    <!-- start header -->
    <header class="header">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // show page header
            echo '<h1 class="text-capitalize">'.language('ADD NEW COMBINATION', $_SESSION['systemLang']).'</h1>';

            // // print $_POST request variables
            // print_r($_POST);

            // get piece info from the form
            $adminID        = $_POST['admin-id'];
            $adminName      = $_POST['admin-name'];
            $techID         = $_POST['technical-id'];
            $clientName     = $_POST['client-name'];
            $clientPhone    = $_POST['client-phone'];
            $clientAddr     = $_POST['client-address'];
            $clientNotes    = $_POST['client-notes'];

            // validate the form
            $formErorr = array();   // error array 

            // validate client name
            if (empty($clientName)) {
                $formErorr[] = 'client name cannot be <strong>empty</strong>';
            }
            // validate technical id
            if (empty($clientPhone)) {
                $formErorr[] = 'client address cannot be <strong>empty.</strong>';
            }
            // validate username
            if (empty($clientAddr)) {
                $formErorr[] = 'client address cannot be <strong>empty.</strong>';
            }
            
            // loop on form error array
            foreach ($formErorr as $error) {
                echo '<div class="alert alert-danger text-capitalize w-50 mx-auto align-left">' . $error . '</div>';
            }

            // check if empty form error
            if (empty($formErorr)) {
                // INSERT INTO combinations
                $q = "INSERT INTO `combinations` (`client_name`, `phone`, `address`, `added_date`, `added_time`, `isFinished`, `comment`, `UserID`, `addedBy`) VALUES (?, ?, ?, CURRENT_DATE, CURRENT_TIME, 0, ?, ?, ?);";

                // insert user info in database
                $stmt = $con->prepare($q);
                $stmt->execute(array($clientName, $clientPhone, $clientAddr, $clientNotes, $techID, $adminID));

                // log message
                $logMsg = "Added a new combination -> added by: " . $adminName . ".";
                // createLogs($_SESSION['UserName'], $logMsg);

                // echo success message
                $msg = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;The new combination is added successfully!</div>';

                // redirect to add new user
                redirectHome($msg, 'back');
            } else {
        ?>
                <div class="my-3">
                    <a class="btn btn-outline-primary text-capitalize" href="?do=addPiece"><?php echo language('RETURN BACK', $_SESSION['systemLang']) ?></a>
                </div>
        <?php
            }
        } else {
            // error message
            $msg = '<div class="alert alert-danger text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;'.language('YOU CANNOT ACCESS THIS PAGE DIRECTLY', $_SESSION['systemLang']).'</div>';
            // redirect to home page
            redirectHome($msg, 'back');
        }

        ?>
    </header>
</div>