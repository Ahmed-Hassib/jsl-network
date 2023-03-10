<!-- start edit profile page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header">
        <?php
        // check the request post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';

            // create an object of User class
            $user_obj = new User();

            // get personal info from the form
            $userid             = isset($_POST['userid'])   && !empty($_POST['userid'])     ? $_POST['userid']          : '';
            $fullname           = isset($_POST['fullname']) && !empty($_POST['fullname'])   ? $_POST['fullname']        : '';
            $username           = isset($_POST['username']) && !empty($_POST['username'])   ? $_POST['username']        : '';
            $pass               = isset($_POST['password']) && !empty($_POST['password'])   ? $_POST['password']        : '';
            $email              = isset($_POST['email'])                                    ? $_POST['email']           : '';
            $isTech             = isset($_POST['isTech'])   && !empty($_POST['isTech'])     ? $_POST['isTech']          : '';
            $gender             = isset($_POST['gender'])   && !empty($_POST['gender'])     ? $_POST['gender']          : '';
            $address            = isset($_POST['address'])                                  ? $_POST['address']         : '';
            $phone              = isset($_POST['phone'])                                    ? $_POST['phone']           : '';
            $dateOfBirth        = isset($_POST['date-of-birth'])                            ? $_POST['date-of-birth']   : '';
            $jobTitle           = isset($_POST['job-title'])                                ? $_POST['job-title']       : '';
            $twitter            = isset($_POST['twitter'])                                  ? $_POST['twitter']         : '';
            $facebook           = isset($_POST['facebook'])                                 ? $_POST['facebook']        : '';
            // get employee type
            $empType = $user_obj->select_specific_column("`isTech`", "`users`", "WHERE `UserID` = ".$userid)[0]['isTech'];

            $isTech = !isset($_POST['isTech']) ? $empType : $_POST['isTech'];
            // password trick
            $pass = empty($passwd) ? $_POST['old-password'] : sha1($passwd);
            
            // validate the form
            $formErorr = array();   // error array 

            // validate username
            if (strlen($username) < 4) {
                $formErorr[] = 'username cannot be less than <strong>4 characters.</strong>';
            }
            if (empty($username)) {
                $formErorr[] = 'username cannot be <strong>empty.</strong>';
            }

            // validate fullname
            if (empty($fullname)) {
                $formErorr[] = 'full name cannot be <strong>empty.</strong>';
            }

            // validate email
            if (empty($email)) {
                $formErorr[] = 'email cannot be <strong>empty.</strong>';
            }

            // loop on form error array
            foreach ($formErorr as $error) {
                echo '<div class="alert alert-danger text-capitalize w-50 mx-auto align-left">' . $error . '</div>';
            }

            // check if empty form error
            if (empty($formErorr)) {
                // get user that have the same username
                $checkStmt = $con->prepare("SELECT *FROM `users` WHERE `UserName` = ? AND `UserID` != ?");
                $checkStmt->execute(array($username, $userid));
                $count = $checkStmt->rowCount();
                // check if username is exist
                if ($count == 1) {
                    // echo success message
                    $msg = '<div class="alert alert-warning text-capitalize"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;';
                    $msg .= language('THIS USERNAME IS ALREADY EXIST', $_SESSION['systemLang']).'..<br>';
                    $msg .= language('PLEASE, TRY ANOTHER USERNAME', $_SESSION['systemLang']);
                    $msg .= '</div>';
                    // redirect to home page
                    redirectHome($msg, 'back');
                } else {
                    // array of user info
                    $user_info = array();
                    // push user info into array
                    array_push($user_info, $username, $pass, $email, $fullname, $isTech, $jobTitle, $gender, $address, $phone, $dateOfBirth, $twitter, $facebook, $userid);
                    // call update user function
                    $user_obj->update_user_info($user_info);
                    // check update permission
                    if ($_SESSION['user_update'] == 1) {
                        // user permissions
                        $userAdd            = isset($_POST['userAdd'])            ? $_POST['userAdd']            : 0;
                        $userUpdate         = isset($_POST['userUpdate'])         ? $_POST['userUpdate']         : 0;
                        $userDelete         = isset($_POST['userDelete'])         ? $_POST['userDelete']         : 0;
                        $userShow           = isset($_POST['userShow'])           ? $_POST['userShow']           : 0;
                        $pcsAdd             = isset($_POST['pcsAdd'])             ? $_POST['pcsAdd']             : 0;
                        $pcsUpdate          = isset($_POST['pcsUpdate'])          ? $_POST['pcsUpdate']          : 0;
                        $pcsDelete          = isset($_POST['pcsDelete'])          ? $_POST['pcsDelete']          : 0;
                        $pcsShow            = isset($_POST['pcsShow'])            ? $_POST['pcsShow']            : 0;
                        $dirAdd             = isset($_POST['dirAdd'])             ? $_POST['dirAdd']             : 0;
                        $dirUpdate          = isset($_POST['dirUpdate'])          ? $_POST['dirUpdate']          : 0;
                        $dirDelete          = isset($_POST['dirDelete'])          ? $_POST['dirDelete']          : 0;
                        $dirShow            = isset($_POST['dirShow'])            ? $_POST['dirShow']            : 0;
                        $malAdd             = isset($_POST['malAdd'])             ? $_POST['malAdd']             : 0;
                        $malUpdate          = isset($_POST['malUpdate'])          ? $_POST['malUpdate']          : 0;
                        $malDelete          = isset($_POST['malDelete'])          ? $_POST['malDelete']          : 0;
                        $malShow            = isset($_POST['malShow'])            ? $_POST['malShow']            : 0;
                        $malReviw           = isset($_POST['malReview'])          ? $_POST['malReview']          : 0;
                        $combAdd            = isset($_POST['combAdd'])            ? $_POST['combAdd']            : 0;
                        $combUpdate         = isset($_POST['combUpdate'])         ? $_POST['combUpdate']         : 0;
                        $combDelete         = isset($_POST['combDelete'])         ? $_POST['combDelete']         : 0;
                        $combShow           = isset($_POST['combShow'])           ? $_POST['combShow']           : 0;
                        $combReview         = isset($_POST['combReview'])         ? $_POST['combReview']         : 0;
                        
                        
                        
                        // check id exist in users_permissions table
                        $checkItem = $user_obj->is_exist("`UserID`", "`users_permissions`", $userid);
                        // array of permissions
                        $permissions = array();

                        if ($checkItem == true) {
                            // permisssions
                            array_push($permissions, $userAdd, $userUpdate, $userDelete, $userShow, $malAdd, $malUpdate, $malDelete, $malShow, $malReviw, $combAdd, $combUpdate, $combDelete, $combShow, $combReview, $pcsAdd, $pcsUpdate, $pcsDelete, $pcsShow, $dirAdd, $dirUpdate, $dirDelete, $dirShow, $userid);
                            // call permission update function
                            $user_obj->update_user_permissions($permissions);
                        } else {
                            // permisssions
                            array_push($permissions, $userid, $userAdd, $userUpdate, $userDelete, $userShow, $malAdd, $malUpdate, $malDelete, $malShow, $malReviw, $combAdd, $combUpdate, $combDelete, $combShow, $combReview, $pcsAdd, $pcsUpdate, $pcsDelete, $pcsShow, $dirAdd, $dirUpdate, $dirDelete, $dirShow);
                            // call permission insert function
                            $user_obj->insert_user_permissions($permissions);
                        }
                    }

                    // update SESSION variables
                    if ($_SESSION['UserID'] == $userid) {
                        // create an object of Session class
                        $session_obj = new Session();
                        // get user info
                        $user_info = $session_obj->get_user_info($userid);
                        // check if done
                        if ($user_info[0] == true) {
                            // set user session
                            $session_obj->set_user_session($user_info[1]);
                        }
                    }
                    // echo success message
                    $msg = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;'.language('USER INFO UPDATED SUCCESSFULLY', $_SESSION['systemLang']).'</div>';
                    // log message
                    $logMsg = "Update user info -> username: " . $username . ".";
                    createLogs($_SESSION['UserName'], $logMsg);
                    // redirect to home page
                    redirectHome($msg, 'back');
                }
            }
        } else {
            // include_once per
            include_once $globmod . 'permission-error.php';
        }

        ?>
    </header>
</div>