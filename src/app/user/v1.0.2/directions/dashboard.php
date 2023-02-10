<!-- start add new user page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header">
        <h1 class="h1 text-capitalize"><?php echo language('MANAGE', $_SESSION['systemLang'])." ".language('THE DIRECTIONS', $_SESSION['systemLang']) ?></h1>
    </header>
    <!-- end header -->
    <!-- start stats -->
    <div class="stats">
        <div class="mb-3 hstack gap-3">
            <!-- add new direction -->
            <div class="<?php if ($_SESSION['dir_add'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#addNewDirectionModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-node-plus"></i>
                        <?php echo language("ADD NEW DIRECTION", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>
            <!-- edit direction -->
            <div class="<?php if ($_SESSION['dir_update'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#editDirectionModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-pencil-square"></i>
                        <?php echo language("EDIT DIRECTION", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>
            <!-- delete direction -->
            <div class="<?php if ($_SESSION['dir_delete'] == 0) {echo 'd-none';} ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger shadow-sm py-1" data-bs-toggle="modal" data-bs-target="#deleteDirectionModal">
                    <h6 class="h6 mb-0 text-center text-capitalize fs-12">
                        <i class="bi bi-trash"></i>
                        <?php echo language("DELETE DIRECTION", $_SESSION['systemLang']) ?>
                    </h6>
                </button>
            </div>
        </div>

        <!-- second row -->
        <div class="mb-3">
            <?php
            // prepare query
            $q = "SELECT *From `direction`";
            $stmt = $con->prepare($q); // select all users
            $stmt->execute(); // execute data
            $rows = $stmt->fetchAll(); // assign all data to variable
            // check number of employees
            if (empty($rows)) { ?>
                <h5 class='h5 text-center text-danger '><?php echo language('THERE IS NO EMPLOYEES TO SHOW', $_SESSION['systemLang']) ?></h5>
            <?php } else { ?>
                <!-- display all employees -->
                <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 align-items-stretch justify-content-start">
                    <?php foreach ($rows as $index => $row) { ?>
                        <div class="col-12">
                            <div class="card <?php if ($_SESSION['system_theme'] == 2) { echo 'card-effect '; echo $_SESSION['systemLang'] == "ar" ? "card-effect-right":"card-effect-left"; } ?>">
                                <!-- employee details -->
                                <div class="card-body">
                                    <!-- vstack for employee info -->
                                    <div class="vstack gap-1">
                                        <!-- card title -->
                                        <h5 class="mb-0 card-title ">
                                            <?php echo $row['direction_name'] ?>
                                        </h5>
                                        <hr>
                                    </div>
                                    <!-- vstack for some statistics -->
                                    <div class="vstack gap-1 nums <?php echo $_SESSION['systemLang'] == 'ar' ? 'text-end' : 'text-start' ?>">
                                        <?php

                                        $clientsQ = "WHERE `direction_id` = '" . $row['direction_id'] . "' AND `is_client` = 1";
                                        $piecsQ = "WHERE `direction_id` = '" . $row['direction_id'] . "' AND `is_client` = 0";

                                        // count pieces
                                        $pieces = countRecords("`piece_id`", "pieces", $piecsQ);
                                        // count clients
                                        $clients = countRecords("`piece_id`", "pieces", $clientsQ);
                                        ?>
                                        <!-- clients -->
                                        <p class="mb-0 card-text text-black text-capitalize">
                                            <i class="bi bi-people"></i>
                                            <span><?php echo language('CLIENTS', $_SESSION['systemLang']) ?></span>
                                            <span class="num" data-goal="<?php echo $clients ?>">0</span>
                                        </p>
                                        <!-- pieces -->
                                        <p class="mb-0 card-text text-black text-capitalize">
                                            <i class="bi bi-hdd-rack"></i>
                                            <span><?php echo language('PIECES', $_SESSION['systemLang']) ?></span>
                                            <span class="num" data-goal="<?php echo $pieces ?>">0</span>
                                        </p>
                                        <!-- horizontal rule -->
                                        <hr>
                                    </div>
                                    <?php if ($clients > 0 || $pieces > 0) { ?>
                                        <!-- vstack for some statistics -->
                                        <div class="vstack gap-1 <?php echo $_SESSION['systemLang'] == 'ar' ? 'text-end' : 'text-start' ?>">
                                            <p class="mb-0 card-text text-capitalize text-danger  fs-12">
                                                <i class="bi bi-exclamation-triangle-fill"></i>&nbsp;<?php echo language('CANNOT DELETE THIS DIRECTION BECAUSE THIS DIR CONTAINS ONE PIECE OR MORE', $_SESSION['systemLang']) ?>
                                            </p>
                                            <!-- horizontal rule -->
                                            <hr>
                                        </div>
                                    <?php } ?>
                                    <!-- hstack for buttons -->
                                    <div class="hstack gap-1 align-items-baseline">
                                        <!-- added date -->
                                        <p class="card-text text-secondary text-capitalize mt-3 mb-0 fs-12 fs-10-sm"><?php echo language('ADDED DATE', $_SESSION['systemLang'])." ".$row['added_date'] ?></p>
                                        <!-- edit direction -->
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editDirectionModal" class='<?php echo $_SESSION['systemLang'] == 'ar' ? 'me-auto' : 'ms-auto' ?> p-1 btn btn-primary text-capitalize fs-12 <?php if ($_SESSION['user_delete'] == 0) {echo 'disabled';} ?> fs-10-sm' onclick="putUpdatedDirectionData(this)" data-direction-id="<?php echo $row['direction_id'] ?>" data-direction-name="<?php echo $row['direction_name'] ?>" data-direction-ip="<?php echo $row['direction_ip'] ?>"><?php echo language('EDIT', $_SESSION['systemLang']) ?></button>
                                        <!-- delete direction -->
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteDirectionModal" class='p-1 btn btn-outline-danger text-capitalize fs-12 <?php if ($_SESSION['user_delete'] == 0 || $clients > 0 || $pieces > 0) {echo 'disabled';} ?> fs-10-sm' style="<?php if ($_SESSION['user_delete'] == 0 || $clients > 0 || $pieces > 0) {echo 'cursor: not-allowed';} ?>" onclick="putDeletedDirectionData(this)" data-direction-id="<?php echo $row['direction_id'] ?>"><?php echo language('DELETE', $_SESSION['systemLang']) ?></button>
                                        <!-- show direction tree -->
                                        <a href="?do=showDir&dirId=<?php echo $row["direction_id"] ?>" class="btn btn-outline-primary p-1 fs-12 fs-10-sm <?php if ($_SESSION['dir_show'] == 0) {echo 'd-none';} ?>">
                                            <i class="bi bi-eye p-1"></i>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- end stats -->
</div>
    
<!-- include add new direction modal -->
<?php include_once 'add-direction-modal.php' ?>
<!-- include edit direction modal -->
<?php include_once 'edit-direction-modal.php' ?>
<!-- include delete direction modal -->
<?php include_once 'delete-direction-modal.php' ?>