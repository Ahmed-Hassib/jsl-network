<!-- navbar -->
<nav class="mb-5 navbar navbar-expand-lg navbar-light bg-white bg-gradient shadow" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php" <?php if (!isset($_SESSION['UserName'])) { echo "style='margin: auto'"; } ?>>
            <img src="<?php echo $assets ?>jsl.jpeg" alt="sys tree logo" width="40">
            <span class="text-uppercase "><?php echo isset($_SESSION['company_name']) ? $_SESSION['company_name'] : language('NOT ASSIGNED') ?></span>
        </a>
        <?php if (isset($_SESSION['UserName'])) { ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#app-navbar" aria-controls="app-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="app-navbar">
                <?php if (!$isDeveloping) { ?>
                <ul class="navbar-nav <?php echo $_SESSION['systemLang'] == 'ar' ? 'ms-auto' : 'me-auto' ?> mb-2 mb-lg-0 text-capitalize">
                    <li class="nav-item">
                        <a class="nav-link <?php if (strtolower($pageTitle) == languageEn('DASHBOARD')) {echo 'active';} ?>" aria-current="page" href="dashboard.php">
                            <i class="bi bi-house-fill"></i>
                            <span><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></span>
                        </a>
                    </li>
                    <?php if ($_SESSION['isLicenseExpired'] == 0) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if (strtolower($pageTitle) == languageEn('THE EMPLOYEES')) {echo 'active';} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><?php echo language('THE EMPLOYEES', $_SESSION['systemLang']) ?></span>
                            </a>
                            <ul class="dropdown-menu <?php echo $_SESSION['systemLang'] == 'ar' ? 'dropdown-menu-end' : 'dropdown-menu-start' ?> text-capitalize <?php echo $_SESSION['systemLang'] == 'ar' ? 'text-end' : 'text-start' ?>" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['user_show'] == 0) {echo 'disabled';} ?>" href="users.php" >
                                        <i class="bi bi-list-ul"></i>
                                        <span><?php echo language('EMPLOYEES LIST', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                                <hr class="dropdown-divider">
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['user_add'] == 0) {echo 'disabled';} ?>" href="users.php?do=addUser">
                                        <i class="bi bi-plus"></i>
                                        <span><?php echo language('ADD NEW EMPLOYEE', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (strtolower($pageTitle) == languageEn('THE DIRECTIONS')) {echo 'active';} ?> <?php if ($_SESSION['dir_show'] == 0) {echo 'disabled';} ?>" href="directions.php">
                                <?php echo language('THE DIRECTIONS', $_SESSION['systemLang']) ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle <?php if (strtolower($pageTitle) == languageEn('PIECES AND CLIENTS')) {echo 'active';} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><?php echo language('PIECES AND CLIENTS', $_SESSION['systemLang']) ?></span>
                            </a>
                            <ul class="dropdown-menu <?php echo $_SESSION['systemLang'] == 'ar' ? 'dropdown-menu-end' : 'dropdown-menu-start' ?> text-capitalize <?php echo $_SESSION['systemLang'] == 'ar' ? 'text-end' : 'text-start' ?>" aria-labelledby="navbarDropdown" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['pcs_show'] == 0) {echo 'disabled';} ?>" href="pieces.php">
                                        <i class="bi bi-speedometer"></i>
                                        <span><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                                <hr class="dropdown-divider">
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['pcs_show'] == 0) {echo 'disabled';} ?>" href="pieces.php?do=showAllPieces">
                                        <i class="bi bi-hdd-rack"></i>
                                        <span><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('PIECES', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['pcs_show'] == 0) {echo 'disabled';} ?>" href="pieces.php?do=showAllClients">
                                        <i class="bi bi-people"></i>
                                        <span><?php echo language('TOTAL', $_SESSION['systemLang'])." ".language('CLIENTS', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                                <hr class="dropdown-divider">
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['pcs_update'] == 0) {echo 'disabled';} ?>" href="pieces.php?do=showConnectionTypes">
                                        <i class="bi bi-hdd-network"></i>
                                        <?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('CONNECTION TYPES', $_SESSION['systemLang']) ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['pcs_update'] == 0) {echo 'disabled';} ?>" href="pieces.php?do=piecesTypes">
                                        <i class="bi bi-hdd-rack"></i>
                                        <?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('PIECES TYPES', $_SESSION['systemLang']) ?>
                                    </a>
                                </li>
                                <hr class="dropdown-divider">
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['pcs_update'] == 0) {echo 'disabled';} ?>" href="pieces.php?do=addPiece">
                                        <i class="bi bi-person-plus"></i>
                                        <?php echo language('ADD NEW PIECE/CLIENT', $_SESSION['systemLang']) ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if (strtolower($pageTitle) == languageEn('THE COMBINATIONS') || strtolower($pageTitle) == languageEn('THE MALFUNCTIONS')) {echo 'active';} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><?php echo language('COMBINATIONS/MALFUNCTIONS', $_SESSION['systemLang']) ?></span>
                            </a>
                            <ul class="dropdown-menu <?php echo $_SESSION['systemLang'] == 'ar' ? 'dropdown-menu-end' : 'dropdown-menu-start' ?> text-capitalize <?php echo $_SESSION['systemLang'] == 'ar' ? 'text-end' : 'text-start' ?>" aria-labelledby="navbarDropdown" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
                                <li>
                                    <a class="dropdown-item  <?php if ($_SESSION['comb_show'] == 0) {echo 'disabled';} ?>" href="combinations.php">
                                        <i class="bi bi-terminal"></i>
                                        <span><?php echo language('THE COMBINATIONS', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a class="dropdown-item <?php if ($_SESSION['comb_add'] == 0) {echo 'disabled';} ?>" href="combinations.php?do=addCombinations">
                                        <i class="bi bi-plus"></i>
                                        <span><?php echo language('ADD NEW COMBINATION', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li> -->
                                <!-- <hr class="dropdown-divider"> -->
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['mal_show'] == 0) {echo 'disabled';} ?>" href="malfunctions.php">
                                        <i class="bi bi-folder-x"></i>
                                        <span><?php echo language('THE MALFUNCTIONS', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a class="dropdown-item <?php if ($_SESSION['mal_add'] == 0) {echo 'disabled';} ?>" href="malfunctions.php?do=addMalfunction">
                                        <i class="bi bi-plus"></i>
                                        <span><?php echo language('ADD NEW MALFUNCTION', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if (strtolower($pageTitle) == languageEn('ARCHIVE') || strtolower($pageTitle) == languageEn('REPORTS') || strtolower($pageTitle) == languageEn('MOTIVATION POINTS')) {echo 'active';} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><?php echo language('OTHERS', $_SESSION['systemLang']) ?></span>
                            </a>
                            <ul class="dropdown-menu <?php echo $_SESSION['systemLang'] == 'ar' ? 'dropdown-menu-end' : 'dropdown-menu-start' ?> text-capitalize <?php echo $_SESSION['systemLang'] == 'ar' ? 'text-end' : 'text-start' ?>" aria-labelledby="navbarDropdown" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['sugg_show'] == 0) {echo 'disabled';} ?>" href="comp-sugg.php">
                                        <i class="bi bi-mailbox"></i>
                                        <span><?php echo language('COMPLAINTS & SUGGESTIONS', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a class="dropdown-item <?php if ($_SESSION['archive_show'] == 0) {echo 'disabled';} ?>" href="archives.php">
                                        <i class="bi bi-archive"></i>
                                        <span><?php echo language('ARCHIVE', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php if ($_SESSION['reports_show'] == 0) {echo 'disabled';} ?>" href="reports.php">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <span><?php echo language('REPORTS', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>  -->
                                <!-- <hr class="dropdown-divider">
                                <li>
                                    <span class="dropdown-item backupBtn text-capitalize w-100 <?php if ($_SESSION['take_backup'] == 0) {echo 'disabled';} ?>" id="backup" onclick="getBackup('<?php echo $_SESSION['UserID'] ?>')"><i class="bi bi-download"></i>&nbsp;<?php echo language('BACKUP', $_SESSION['systemLang']) ?></span>
                                </li> -->
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>
                <ul class="navbar-nav <?php echo $isDeveloping ? "me-auto" : "" ?>">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span><i class="bi bi-person-circle"></i>&nbsp;<?php echo $_SESSION['UserName'] ?></span>
                        </a>
                        <ul class="dropdown-menu <?php echo $_SESSION['systemLang'] == 'ar' ? 'dropdown-menu-start' : 'dropdown-menu-end' ?> text-capitalize <?php echo $_SESSION['systemLang'] == 'ar' ? 'text-end' : 'text-start' ?>" aria-labelledby="navbarDropdown">
                            <?php if (!$isDeveloping) { ?>
                            <li>
                                <a class="dropdown-item" href="requests.php?do=updateSession&user-id=<?php echo $_SESSION['UserID'] ?>">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    <span><?php echo language('REFRESH', $_SESSION['systemLang']) ?></span>
                                </a>
                            </li>
                            <?php if ($_SESSION['isLicenseExpired'] == 0) { ?>
                                <li>
                                    <a class="dropdown-item" href="users.php?do=editUser&userid=<?php echo $_SESSION['UserID']; ?>">
                                        <i class="bi bi-sliders"></i>
                                        <span><?php echo language('PROFILE', $_SESSION['systemLang']) ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                            <!-- <hr class="dropdown-divider"> -->
                            <li>
                                <a class="dropdown-item" href="settings.php">
                                    <i class="bi bi-gear"></i>
                                    <span><?php echo language('SETTINGS', $_SESSION['systemLang']) ?></span>
                                </a>
                            </li>
                            <hr class="dropdown-divider">
                            <?php } ?>
                            <li>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span><?php echo language('LOG OUT', $_SESSION['systemLang']) ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>
</nav>
<!-- navbar -->