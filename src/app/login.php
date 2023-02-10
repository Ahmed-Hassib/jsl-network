<?php
// start output buffering
ob_start();
// start session
session_start();
// regenerate session id
session_regenerate_id();
// no navbar
$noNavBar = "all";
// title page
$pageTitle = "Login";
// level
$level = 2;
// nav level
$nav_level = 0;
// initial configration of system
include_once str_repeat("../", $level) . "etc/init.php";
// check username in SESSION variable
if (isset($_SESSION['UserName'])) {
    if ($_SESSION['isRoot'] == 1) {
        // redirect to admin page
        header("Location: root/dashboard/index.php");
        exit();
    } else {
        // redirect to user page
        header("Location: user/$curr_version/dashboard/index.php");  
        exit();
    }
}
// check if user comming from http request ..
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    // get request info
    $username   = $_POST["username"];
    $pass       = $_POST["pass"];
    $hashedPass = sha1($pass);
    
    // columns to select
    $users_permission_columns   = "`users_permissions`.`user_add`,`users_permissions`.`user_update`,`users_permissions`.`user_delete`,`users_permissions`.`user_show`,`users_permissions`.`mal_add`,`users_permissions`.`mal_update`,`users_permissions`.`mal_delete`,`users_permissions`.`mal_show`,`users_permissions`.`mal_review`,`users_permissions`.`comb_add`,`users_permissions`.`comb_update`,`users_permissions`.`comb_delete`,`users_permissions`.`comb_show`,`users_permissions`.`comb_review`,`users_permissions`.`pcs_add`,`users_permissions`.`pcs_update`,`users_permissions`.`pcs_delete`,`users_permissions`.`pcs_show`,`users_permissions`.`dir_add`,`users_permissions`.`dir_update`,`users_permissions`.`dir_delete`,`users_permissions`.`dir_show`,`users_permissions`.`sugg_replay`,`users_permissions`.`sugg_delete`,`users_permissions`.`sugg_show`,`users_permissions`.`points_add`,`users_permissions`.`points_delete`,`users_permissions`.`points_show`,`users_permissions`.`reports_show`,`users_permissions`.`archive_show`,`users_permissions`.`take_backup`,`users_permissions`.`restore_backup`";
    // query select
    $query = "SELECT 
                `users`.*,
                $users_permission_columns,
                `companies`.`company_name`
            FROM `users` 
            LEFT JOIN `users_permissions` ON `users`.`UserID` = `users_permissions`.`UserID`
            LEFT JOIN `companies` ON `companies`.`company_id` = `users`.`company_id`
            WHERE `users`.`UserName` = ? AND `users`.`Pass` = ? LIMIT 1";
            
    // check if user exist in database
    $stmt = $con->prepare($query);
    $stmt->execute(array($username, $hashedPass));
    $userInfo = $stmt->fetch();
    $count = $stmt->rowCount();
    
    // if count > 0 this mean that user exist
    if ($count > 0) {
        // create an object of Session class to set session
        $session_obj = new Session();
        // set session
        $session_obj->set_user_session($userInfo);
        // check license expiration
        if (isset($_SESSION['isLicenseExpired']) && $_SESSION['isLicenseExpired'] == 1) {
            // query statement
            $query = "UPDATE `license` SET `isEnded`= 1 WHERE `ID` = ?";
            // prepare statement
            $stmt = $con->prepare($query);
            $stmt->execute(array($_SESSION['license_id']));
        }
        // reset login error variable
        $_SESSION['loginError'] = 0;
        // check logined user
        if ($_SESSION['isRoot'] == 1) {
            // redirect to admin page
            // header("Location: root/$curr_version/dashboard/index.php"); 
            header("Location: root/dashboard/index.php"); 
            exit();
        } else {
            // redirect to user page
            header("Location: user/$curr_version/dashboard/index.php");
            exit();

        }
    } else {
        $_SESSION['loginError'] = 1;
    }
}

// check if user comming from signup page..
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {
    // nwe username
    $username = isset($_GET['username']) && !empty($_GET['username']) ? $_GET['username'] : "";
    $password = isset($_GET['password']) && !empty($_GET['password']) ? $_GET['password'] : "";
}
?>

<div class="loginPageContainer">
    <div class="imgBox">
        <div class="hero-content">
            <img src="<?php echo $assets ?>images/login-2.svg" alt="" />
        </div>
    </div>
    <div class="contentBox">
        <div class="formBox">
            <div class="formBoxHeader">
                <h2 class="h2"><?php echo languageEn('LOGIN') ?></h2>
            </div>
            <!-- login form -->
            <form class="login-form" id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mb-4">
                    <label class="mb-2" for="username"><?php echo languageEn('USERNAME') ?></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo languageEn('USERNAME') ?>" value="<?php echo isset($_GET['username']) && isset($_GET['password']) ? $username : "" ?>" data-no-astrisk="true" required>
                </div>
                <div class="mb-4 position-relative login">
                    <label class="mb-2" for="password"><?php echo languageEn('PASSWORD') ?></label>
                    <input type="password" class="form-control" id="password" name="pass" placeholder="<?php echo languageEn('PASSWORD') ?>" value="<?php echo isset($_GET['username']) && isset($_GET['password']) ? $password : "" ?>" data-no-astrisk="true" required>
                    <i class="bi bi-eye-slash show-pass text-dark" id="show-pass" onclick="showPass(this)"></i>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary w-100 text-capitalize <?php # echo $_SESSION['loginErrorCounter'] > 3 ? 'disabled' : '' ?>" style="border-radius: 6px"><?php echo languageEn('LOGIN') ?></button>
                </div>
                <div class="mb-4" dir="rtl">
                    <span><?php echo languageEn("DON`T HAVE AN ACCOUNT?") ?>&nbsp;</span>
                    <a href="signup.php" class="text-capitalize <?php # echo $_SESSION['loginErrorCounter'] > 3 ? 'disabled' : '' ?>" style="border-radius: 6px"><?php echo languageEn('SIGNUP') ?></a>
                </div>
                <div class="mb-4">
                    <?php 
                        if (isset($_SESSION['loginError']) && $_SESSION['loginError'] == 1) {
                            echo "<span class='text-danger text-capitalize'>" . languageEn("SORRY, USERNAME OR PASSWORD IS WRONG PLEASE TRY LATER") . "</span>";
                        }
                        ?>
                </div>
            </form>
            <hr>

            <div class="row g-2">
                <div class="col-10">
                    <a href="../../index.php" class="btn btn-outline-primary w-100"><?php echo language("LEADER GROUP EGYPT") ?></a>
                </div>
                <div class="col-2">
                    <a href="https://www.facebook.com/LeaderGroupEGYPT" target="_blank" class="btn btn-outline-primary w-100 px-0"><i class="bi bi-facebook"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) { // if request method = GET && comming from signup page, submit form ?>
    <script>decument.querySelector("#login-form").submit();</script>
<?php } ?>

<?php 
    // include_once $tpl . "footer.php"; 
    include_once $tpl . "js-includes.php";
?>