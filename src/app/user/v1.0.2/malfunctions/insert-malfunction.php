<!-- start edit profile page -->
<div class="container">
    <!-- start header -->
    <header class="header">

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // show page header
            echo '<h1 class="text-capitalize">'.language('ADD NEW MALFUNCTION', $_SESSION['systemLang']).'</h1>';

            // // print $_POST request variables
            // print_r($_POST);

            // get piece info from the form
            $mng_id         = $_POST['admin-id'];
            $tech_id        = $_POST['technical-id'];
            $client_id      = $_POST['client-id'];
            $descreption    = $_POST['descreption'];
        

            // validate the form
            $formErorr = array();   // error array 

            // validate manager id
            if (empty($mng_id)) {
                $formErorr[] = 'manager id cannot be <strong>empty</strong>';
            }
            // validate technical id
            if (empty($tech_id)) {
                $formErorr[] = 'technical id cannot be <strong>empty.</strong>';
            }
            // validate username
            if (empty($client_id)) {
                $formErorr[] = 'client id cannot be <strong>empty.</strong>';
            }
            // validate descreption
            if (empty($descreption)) {
                $formErorr[] = 'descreption cannot be <strong>empty.</strong>';
            }

            // loop on form error array
            foreach ($formErorr as $error) {
                echo '<div class="alert alert-danger text-capitalize w-50 mx-auto align-left">' . $error . '</div>';
            }

            // check if empty form error
            if (empty($formErorr)) {
                // INSERT INTO malfunctions
                $q = "INSERT INTO `malfunctions` (`mng_id`, `tech_id`, `client_id`, `descreption`, `added_date`, `added_time`) VALUES (?, ?, ?, ?, now(), now());";

                // insert user info in database
                $stmt = $con->prepare($q);
                $stmt->execute(array($mng_id, $tech_id, $client_id, $descreption));

                // echo success message
                $msg = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;' . $stmt->rowCount() . ' record added succefully!</div>';

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