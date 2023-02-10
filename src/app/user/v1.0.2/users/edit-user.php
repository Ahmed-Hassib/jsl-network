<?php
// check if Get request userid is numeric and get the integer value
$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
// action
$action = isset($_GET['action']) && is_numeric($_GET['action']) ? intval($_GET['action']) : 0;
// check the current users
if ($userid == $_SESSION['UserID'] || $_SESSION['user_show'] == 1) {
    // check
    // get user info from database
    $stmt = $con->prepare("SELECT *FROM `users` WHERE UserID = ? LIMIT 1");
    $stmt->execute(array($userid));                     // execute query
    $row = $stmt->fetch();                              // fetch data
    $count = $stmt->rowCount();                         // get row count
    // check the row count
    if ($count > 0) {
        // get user permissions
        $stmt = $con->prepare("SELECT *FROM `users_permissions` WHERE UserID = ? LIMIT 1");
        $stmt->execute(array($userid));                             // execute query
        $permissions = $stmt->fetch();                              // fetch data
    ?>
        <!-- start edit profile page -->
        <div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
            <!-- start header -->
            <header class="header">
                <h1 class="text-capitalize">
                    <?php echo $_SESSION['UserID'] == $userid ? language('PROFILE', $_SESSION['systemLang']) : language('EMPLOYEE PROFILE', $_SESSION['systemLang']) ?>
                </h1>
                <!-- <h2 class="lead text-secondary ">'<?php echo $row['Fullname'] ?>'</h2> -->
                <?php if ($row['isRoot'] == 1 && $_SESSION['isRoot'] == 0) {
                    // include permission error
                    include_once 'global-modules/permission-error.php';
                } else { ?>
            </header>
                <?php 
                    // check the action
                    switch ($action) {
                        case 0:
                            # show user profile
                            include_once 'includes/show-profile.php';
                            break;

                        case 1:
                            # edit user profile
                            include_once 'includes/edit-profile.php';
                            break;
                    }
                ?>
        </div>
            <!-- end edit profile page -->
            <?php }
    // if there is no such id show erroe message
    } else { 
        // include no data founded module
        include_once 'global-modules/no-data-founded.php';
    }
} else {
    // include permission error module
    include_once 'global-modules/permission-error.php';
}
