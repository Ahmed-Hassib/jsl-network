<!-- start sidebar menu -->
<div class="sidebar-menu sidebar-menu-<?php echo $_SESSION['systemLang'] == 'ar' ? 'right' : 'left' ?>">
    <!-- start sidebar menu brand -->
    <div class="sidebar-menu-brand" href="dashboard.php" <?php if (!isset($_SESSION['UserName'])) { echo "style='margin: auto'"; } ?>>
        <img class="sidebar-menu-logo-img" src="<?php echo $assets ?>jsl.jpeg" alt="<?php echo isset($_SESSION['company_name']) ? $_SESSION['company_name'] : language('NOT ASSIGNED') ?>">
        <span class="sidebar-menu-logo-name text-uppercase "><?php echo isset($_SESSION['company_name']) ? $_SESSION['company_name'] : language('NOT ASSIGNED') ?></span>
        <!-- close icon displayed in small screens -->
        <span class="close-btn"><i class="bi bi-x"></i></span>
    </div>
    <!-- end sidebar menu brand -->
    <!-- start sidebar menu content -->
    <ul class="nav-links">
        <!-- start dashboard page link -->
        <li>
            <a href="<?php echo $nav_up_level ?>dashboard/index.php">
                <i class="bi bi-grid"></i>
                <span class="link-name"><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></span>
            </a>
            <!-- start blank sub menu -->
            <ul class="sub-menu blank">
                <li>
                    <a href="<?php echo $nav_up_level ?>dashboard/index.php">
                        <span class="link-name"><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
            </ul>
            <!-- end blank sub menu -->
        </li>
        <!-- end dashboard page link -->
        <!-- start employee nav link -->
        <li>
            <!-- start link containing sub menu -->
            <div class="icon-link">
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span class="link-name"><?php echo language('THE EMPLOYEES', $_SESSION['systemLang']) ?></span>
                </a>
                <i class="bi bi-arrow-down-short"></i>
            </div>
            <!-- end link containing sub menu -->
            <!-- start sub menu -->
            <ul class="sub-menu">
                <li>
                    <a class="<?php if ($_SESSION['user_show'] == 0) {echo 'disabled';} ?>" href="<?php echo $nav_up_level ?>users/index.php">
                        <span class="link-name"><?php echo language('EMPLOYEES LIST', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a class="<?php if ($_SESSION['user_add'] == 0) {echo 'disabled';} ?>" href="<?php echo $nav_up_level ?>users/index.php?do=addUser">
                        <span class="link-name"><?php echo language('ADD NEW EMPLOYEE', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
            </ul>
            <!-- end sub menu -->
        </li>
        <!-- end employee nav link -->
        <!-- start directions nav link -->
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bi bi-diagram-3"></i>
                    <span class="link-name"><?php echo language('THE DIRECTIONS', $_SESSION['systemLang']) ?></span>
                </a>
                <i class="bi bi-arrow-down-short"></i>
            </div>
            <!-- start sub menu -->
            <ul class="sub-menu">
                <li>
                    <a href="<?php echo $nav_up_level ?>directions/index.php" class="<?php if ($_SESSION['dir_show'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('DIRECTIONS LIST', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addNewDirectionModal" class="<?php if ($_SESSION['dir_add'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('ADD NEW DIRECTION', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
            </ul>
            <!-- end sub menu -->
        </li>
        <!-- end directions nav link -->
        <!-- start pieces nav link -->
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bi bi-router"></i>
                    <span class="link-name"><?php echo language('PIECES', $_SESSION['systemLang']) ?></span>
                </a>
                <i class="bi bi-arrow-down-short"></i>
            </div>
            <!-- start sub menu -->
            <ul class="sub-menu">
                <li>
                    <a href="<?php echo $nav_up_level ?>pieces/index.php?name=pieces" class="<?php if ($_SESSION['pcs_show'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $nav_up_level ?>pieces/index.php?name=pieces&do=showAllPieces" class="<?php if ($_SESSION['pcs_show'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('PIECES LIST', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $nav_up_level ?>pieces/index.php?name=pieces&do=showConnectionTypes" class="<?php if ($_SESSION['pcs_update'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('CONNECTION TYPES', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $nav_up_level ?>pieces/index.php?name=pieces&do=piecesTypes" class="<?php if ($_SESSION['pcs_update'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES TYPES', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $nav_up_level ?>pieces/index.php?name=pieces&do=addPiece" class="<?php if ($_SESSION['pcs_add'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('ADD NEW PIECE', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
            </ul>
            <!-- end sub menu -->
        </li>
        <!-- end pieces nav link -->
        <!-- start clients nav link -->
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span class="link-name"><?php echo language('CLIENTS', $_SESSION['systemLang']) ?></span>
                </a>
                <i class="bi bi-arrow-down-short"></i>
            </div>
            <!-- start sub menu -->
            <ul class="sub-menu">
                <li>
                    <a href="<?php echo $nav_up_level ?>pieces/index.php?name=clients" class="<?php if ($_SESSION['pcs_show'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $nav_up_level ?>pieces/index.php?name=clients&do=showAllClients" class="<?php if ($_SESSION['pcs_show'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('CLIENTS LIST', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $nav_up_level ?>pieces/index.php?name=clients&do=addPiece" class="<?php if ($_SESSION['pcs_add'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('ADD NEW CLIENT', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
            </ul>
            <!-- end sub menu -->
        </li>
        <!-- end clients nav link -->
        <!-- start malfunctions nav link -->
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bi bi-lightning-charge"></i>
                    <span class="link-name"><?php echo language('THE MALFUNCTIONS', $_SESSION['systemLang']) ?></span>
                </a>
                <i class="bi bi-arrow-down-short"></i>
            </div>
            <!-- start sub menu -->
            <ul class="sub-menu">
                <li>
                    <a href="<?php echo $nav_up_level ?>malfunctions/index.php" class="<?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $nav_up_level ?>malfunctions/index.php?do=addMalfunction" class="<?php if ($_SESSION['mal_add'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('ADD NEW MALFUNCTION', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
            </ul>
            <!-- end sub menu -->
        </li>
        <!-- end malfunctions nav link -->
        <!-- start combinations nav link -->
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bi bi-braces-asterisk"></i>
                    <span class="link-name"><?php echo language('THE COMBINATIONS', $_SESSION['systemLang']) ?></span>
                </a>
                <i class="bi bi-arrow-down-short"></i>
            </div>
            <!-- start sub menu -->
            <ul class="sub-menu">
                <li>
                    <a href="<?php echo $nav_up_level ?>combinations/index.php" class="<?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $nav_up_level ?>combinations/index.php?do=addCombinations" class="<?php if ($_SESSION['comb_add'] == 0) {echo 'disabled';} ?>">
                        <span class="link-name"><?php echo language('ADD NEW COMBINATION', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
            </ul>
            <!-- end sub menu -->
        </li>
        <!-- end combinations nav link -->
        <!-- start setting nav link -->
        <li>
            <a href="<?php echo $nav_up_level ?>settings/index.php">
                <i class="bi bi-gear"></i>
                <span class="link-name"><?php echo language('SETTINGS', $_SESSION['systemLang']) ?></span>
            </a>
            <!-- start blank sub menu -->
            <ul class="sub-menu blank">
                <li>
                    <a href="<?php echo $nav_up_level ?>settings/index.php">
                        <span class="link-name"><?php echo language('SETTINGS', $_SESSION['systemLang']) ?></span>
                    </a>
                </li>
            </ul>
            <!-- end blank sub menu -->
        </li>
        <!-- start setting nav link -->
        <?php if (isset($_SESSION['UserName'])) { ?>
        <!-- start profile details nav link -->
        <li>
            <!-- start profile details -->
            <div class="profile-details">
                <a href="<?php echo $nav_up_level ?>users/index.php?do=editUser&userid=<?php echo $_SESSION['UserID']; ?>">
                <div class="profile-content">
                    <img src="<?php echo $assets . "jsl.jpeg" ?>" class="profile-img">
                </div>
                    <div class="name-job">
                        <div class="profile-name"><?php echo $_SESSION['UserName'] ?></div>
                        <?php if (!empty($_SESSION['job_title'])) { ?>
                            <div class="profile-job"><?php echo $_SESSION['job_title'] ?></div>
                        <?php } ?>
                    </div>
                </a>
                <a href="<?php echo $nav_up_level.$nav_up_level ?>logout.php" class="logout-btn"><i class="bi bi-box-arrow-right"></i></a>
            </div>
            <!-- end profile details -->
        </li>
        <!-- start profile details nav link -->
        <?php } ?>
    </ul>
    <!-- end sidebar menu content -->
</div>
<!-- end sidebar menu -->

<div class="top-navbar top-navbar-<?php echo $_SESSION['systemLang'] == 'ar' ? 'right' : 'left' ?>">
    <div class="top-navbar-content">
        <i class="bi bi-list sidebar-menubtn"></i>
        <!-- <span class="top-navbar-text">demo text</span> -->
        
        <?php if (isset($_SESSION['isTrial']) && $_SESSION['isTrial'] == 1) {?>
            <span class="<?php echo $_SESSION['systemLang'] == 'ar' ? 'me-auto' : 'ms-auto' ?> mx-3">
                <span class="badge bg-danger"><?php echo language("TRIAL", $_SESSION['systemLang']) ?></span>
            </span>
        <?php } ?>
    </div>
</div>

<div class="main-content">
    