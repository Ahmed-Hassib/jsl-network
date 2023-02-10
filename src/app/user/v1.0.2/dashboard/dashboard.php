<?php
    // check if system write a log for login into system
    if ($_SESSION['log'] == 0) {
        // log message
        $msg = "loginning to system";
        createLogs($_SESSION['UserName'], $msg);
        $_SESSION['log'] = 1;
    }

    // check if the current user is technical man
    if ($_SESSION['mal_show'] == 1 && $_SESSION['isTech'] == 1) {
        $techMalCondition = "AND `tech_id` = " . $_SESSION['UserID'];
    } else {
        $techMalCondition = "";
    }
    
    // check if the current user is technical man
    if ($_SESSION['comb_show'] == 1 && $_SESSION['isTech'] == 1) {
        $techCombCondition = "AND `UserID` = " . $_SESSION['UserID'];
    } else {
        $techCombCondition = "";
    }

    $ss = new Session();

    // get user columns control
    $user_controls = $ss->get_user_columns_control($_SESSION['UserID']);
    // chekc if exist
    if ($user_controls[0] == true) {
        // set user controls
        $ss->set_user_columns_control(...$user_controls[1]);
    }
?>


    <!-- start home stats container -->
    <div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <!-- start header -->
        <header class="header">
            <h1 class="h1 text-capitalize"><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></h1>
        </header>
        <!-- end header -->
        <!-- start stats -->
        <div class="stats">
            <?php if ($_SESSION['isLicenseExpired'] == 0) { ?>
                <!-- check if application suspended or not -->
                <?php if ($isDeveloping) { ?>
                    <div class="mb-3 row row-cols-md-3 g-3 justify-content-center">
                        <div class="col">
                            <div class="card card-stat bg-info py-4 px-1">
                                <div class="card-body text-white">
                                    <span class="" dir="<?php echo $_SESSION['systemLang'] == "ar" ? "rtl" : "ltr"; ?>">
                                        <i class="bi bi-info-circle-fill"></i>
                                        <?php echo language("SORRY, THE APP IS SUSPENDED TODAY DUE TO DEVELOPMENT WORK", $_SESSION['systemLang']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <?php
                    // create an object of Database
                    $db_obj = new Database();
                    ?>
                    <!-- start new design -->
                    <div class="mb-3 row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 justify-content-sm-center">
                        <div class="col-6 <?php if ($_SESSION['user_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-primary';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-people"></i>
                                    <span>
                                        <a href="users.php" class="stretched-link text-capitalize">
                                            <?php echo language('THE EMPLOYEES', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                                <?php $newEmpCounter = $db_obj->count_records("`UserID`", "`users`", "WHERE `joinedDate` = CURRENT_DATE()"); ?>
                                <?php if ($newEmpCounter > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border border-light bg-danger">
                                        <span><?php echo $newEmpCounter ?></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-6 <?php if ($_SESSION['dir_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-primary';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-signpost-2"></i>
                                    <span>
                                        <a href="directions.php" class="stretched-link text-capitalize">
                                            <?php echo language('THE DIRECTIONS', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                                <?php $newDirCounter = $db_obj->count_records("`direction_id`", "`direction`", "WHERE `added_date` = CURRENT_DATE()"); ?>
                                <?php if ($newDirCounter > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border border-light bg-danger">
                                        <span><?php echo $newDirCounter ?></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-6 <?php if ($_SESSION['pcs_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-primary';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-hdd-rack"></i>
                                    <span>
                                        <a href="pieces.php" class="stretched-link text-capitalize">
                                            <?php echo language('PIECES AND CLIENTS', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                                <?php $newPcsCounter = $db_obj->count_records("`piece_id`", "`pieces`", "WHERE `added_date` = CURRENT_DATE()"); ?>
                                <?php if ($newPcsCounter > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border border-light bg-danger">
                                        <span><?php echo $newPcsCounter ?></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-6 <?php if ($_SESSION['sugg_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-primary';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-mailbox"></i>
                                    <span>
                                        <a href="comp-sugg.php" class="stretched-link text-capitalize">
                                            <?php echo language('COMPLAINTS & SUGGESTIONS', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                                <?php $newSuggCounter = $db_obj->count_records("`id`", "`comp_sugg`", "WHERE `added_date` = CURRENT_DATE"); ?>
                                <?php if ($newSuggCounter > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border border-light bg-danger">
                                        <span><?php echo $newSuggCounter ?></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-6 <?php if ($_SESSION['mal_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-mal card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-danger';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-folder-x"></i>
                                    <!-- <h5 class="card-title text-capitalize"><?php echo language('TOTAL SUGGESTIONS', $_SESSION['systemLang']) ?></h5> -->
                                    <span>
                                        <a href="malfunctions.php" class="stretched-link text-capitalize">
                                            <?php echo language('THE MALFUNCTIONS', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                                <?php $newMalCounter = $db_obj->count_records("`mal_id`", "`malfunctions`", "WHERE `added_date` = CURRENT_DATE"); ?>
                                <?php if ($newMalCounter > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border border-light bg-danger">
                                        <span><?php echo $newMalCounter ?></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-6 <?php if ($_SESSION['comb_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-comb card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-success';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-terminal"></i>
                                    <!-- <h5 class="card-title text-capitalize"><?php echo language('TOTAL SUGGESTIONS', $_SESSION['systemLang']) ?></h5> -->
                                    <span>
                                        <a href="combinations.php" class="stretched-link text-capitalize">
                                            <?php echo language('THE COMBINATIONS', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                                <?php $newCombCounter = $db_obj->count_records("`comb_id`", "`combinations`", "WHERE `added_date` = CURRENT_DATE"); ?>
                                <?php if ($newCombCounter > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border border-light bg-danger">
                                        <span><?php echo $newCombCounter ?></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-6 <?php if ($_SESSION['points_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-primary';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-award"></i>
                                    <!-- <h5 class="card-title text-capitalize"></h5> -->
                                    <span>
                                        <a href="users.php?do=motivationPoints&userid=<?php echo $_SESSION['UserID'] ?>" class="stretched-link text-capitalize">
                                            <?php echo language('PERSONAL MOTIVATION POINTS', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                                <?php $newPointCounter = $db_obj->count_records("`id`", "`users_points`", "WHERE `points_date` = CURRENT_DATE AND `UserID` = ".$_SESSION['UserID']); ?>
                                <?php if ($newPointCounter > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border border-light bg-danger">
                                        <span><?php echo $newPointCounter ?></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-6 <?php if ($_SESSION['reports_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-primary';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-file-text"></i>
                                    <!-- <h5 class="card-title text-capitalize"></h5> -->
                                    <span>
                                        <a href="reports.php" class="stretched-link text-capitalize">
                                            <?php echo language('REPORTS', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-6 <?php if ($_SESSION['archive_show'] == 0) {echo 'd-none';} ?>">
                            <div class="card card-stat <?php if ($_SESSION['system_theme'] == 2) { echo 'card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } else { echo 'bg-primary';} ?> bg-gradient">
                                <div class="card-body">
                                    <i class="bi bi-archive"></i>
                                     -->
                                    <!-- <h5 class="card-title text-capitalize"></h5> -->
                                    <!-- <span>
                                        <a href="archives.php" class="stretched-link text-capitalize">
                                            <?php echo language('ARCHIVE', $_SESSION['systemLang']) ?>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="mb-3 row row-cols-md-3 g-3 justify-content-center">
                    <div class="col">
                        <div class="card card-stat bg-danger py-4 px-1">
                            <div class="card-body text-white">
                                <span class="" dir="<?php echo $_SESSION['systemLang'] == "ar" ? "rtl" : "ltr"; ?>">
                                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.5rem"></i>
                                    <br>&nbsp;
                                    <?php echo language("YOUR LICENSE HAD BEEN ENDED, PLEASE CALL THE TECHNICAL SUPPORT", $_SESSION['systemLang']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- end stats -->
    </div>
    <!-- end dashboard page -->