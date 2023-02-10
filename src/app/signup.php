<?php
// start output buffering
ob_start();
// start session
session_start();
// regenerate session id
session_regenerate_id();
// check username in SESSION variable
if (isset($_SESSION['UserName'])) {
    if ($_SESSION['isRoot'] == 1) {
        // redirect to admin page
        header('Location: root/dashboard.php');  
        exit();
    } else {
        // redirect to user page
        header('Location: user/dashboard.php');  
        exit();
    }
}

// no navbar
$noNavBar = "all";
// title page
$pageTitle = "Sign up";
// set language
$_SESSION['systemLang'] = "ar";
// level
$level = 2;
// nav level
$nav_level = 0;
// initial configration of system
include_once str_repeat("../", $level) . "etc/init.php";
?>
    <form id="regForm" action="requests/registration.php" method="POST" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <!-- form header -->
        <header class="form-header">
            <h1 class="h1 mb-3"><?php echo language("NEW REGISTRATION", $_SESSION['systemLang']) ?></h1>
        </header>

        <!-- One "tab" for each step in the form: -->
        <div class="tab">
            <header class="tab-header">
                <h4 class="h4"><?php echo language("COMPANY INFO", $_SESSION['systemLang']) ?></h4>
            </header>
            <div class="mb-3">
                <label for="company-name"><?php echo language("COMPANY NAME", $_SESSION['systemLang']) ?></label>
                <input class="form-control" type="text" name="company-name" id="company-name" onblur="is_valid(this, 'company');" required>
            </div>
            <div class="mb-3">
                <label for="manager-name"><?php echo language("MANAGER NAME", $_SESSION['systemLang']) ?></label>
                <input class="form-control" type="text" name="manager-name" id="manager-name" required>
            </div>
            <div class="mb-3">
                <label for="manager-phone"><?php echo language("PHONE", $_SESSION['systemLang']) ?></label>
                <input class="form-control" name="manager-phone" id="manager-phone" required>
            </div>
        </div>

        <div class="tab">
            <header class="tab-header">
                <h4 class="h4"><?php echo language("ADMIN LOGIN INFO", $_SESSION['systemLang']) ?></h4>
            </header>
            <div class="row row-cols-sm-1 row-cols-md-2">
                <div class="mb-3">
                    <label for="fullname"><?php echo language("FULLNAME", $_SESSION['systemLang']) ?></label>
                    <input class="form-control" type="text" name="fullname" id="fullname" required>
                </div>
                <div class="mb-3">
                    <label for="gender"><?php echo language("GENDER", $_SESSION['systemLang']) ?></label>
                    <select class="form-select" name="gender" id="gender" required>
                        <option value="default" disabled selected></option>
                        <option value="0"><?php echo language("MALE", $_SESSION['systemLang']) ?></option>
                        <option value="1"><?php echo language("FEMALE", $_SESSION['systemLang']) ?></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="username"><?php echo language("USERNAME", $_SESSION['systemLang']) ?></label>
                    <input class="form-control" type="text" name="username" id="username" onblur="is_valid(this, 'username');" required>
                </div>
                <div class="mb-3">
                    <label for="password"><?php echo language("PASSWORD", $_SESSION['systemLang']) ?></label>
                    <input class="form-control" type="text" name="password" id="password" required>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="hstack gap-2 justify-content-<?php echo $_SESSION['systemLang'] == 'ar' ? 'end' : 'start' ?> align-items-center">
                <button class="btn btn-outline-primary" type="button" id="prevBtn" onclick="nextPrev(-1)"><?php echo language("PREVIOUS", $_SESSION['systemLang']) ?></button>
                <button class="btn btn-outline-primary" type="button" id="nextBtn" onclick="nextPrev(1)"><?php echo language("NEXT", $_SESSION['systemLang']) ?></button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
        </div>

    </form>

<?php 
    // include_once $tpl . "footer.php"; 
    include_once $tpl . "js-includes.php";
?>