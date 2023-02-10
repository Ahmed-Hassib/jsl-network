<!-- start add new user page -->
<div class="container" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
    <!-- start header -->
    <header class="header">
        <h1 class="text-capitalize"><?php echo language("ADD NEW PIECE/CLIENT", $_SESSION['systemLang']); ?></h1>
    </header>
    <!-- end header -->
    <!-- start form -->
    <form class="custom-form need-validation" action="?do=insertPiece" method="POST" id="addPiece">
        <!-- horzontal stack -->
        <div class="hstack gap-3">
            <h6 class="h6  text-decoration-underline text-capitalize text-danger">
                <span><?php echo language('NOTE', $_SESSION['systemLang']) ?>:</span>&nbsp;
                <span><?php echo language('THIS SIGN * IS REFERE TO REQUIRED FIELDS', $_SESSION['systemLang']) ?></span>
            </h6>
        </div>
        <!-- start piece info -->
        <div class="mb-3 row row-cols-sm-1 row-cols-md-2 g-3 align-items-stretch justify-content-start">
            <!-- first column -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5><?php echo language('PERSONAL INFO', $_SESSION['systemLang']) ?></h5>
                        <hr />
                    </div>
                    <!-- Id -->
                    <input type="hidden" class="form-control" id="next-id" name="next-id" value="<?php echo getNextID( 'pieces' ); ?>" placeholder="ID" autocomplete="off" readonly />
                    <!-- piece name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="piece-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('FULLNAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="piece-name" name="piece-name" placeholder="<?php echo language('FULLNAME', $_SESSION['systemLang']) ?>" autocomplete="off" required />
                        </div>
                    </div>
                    <!-- address -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="address" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" name="address" id="address" class="form-control w-100" placeholder="<?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?>" />
                        </div>
                    </div>
                    <!-- phone -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="phone-number" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('PHONE', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" name="phone-number" id="phone-number" class="form-control w-100" placeholder="<?php echo language('PHONE', $_SESSION['systemLang']) ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- second column -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5><?php echo language('CONNECTION INFO', $_SESSION['systemLang']) ?></h5>
                        <hr />
                    </div>
                    <!-- direction -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="direction" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE DIRECTION', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <select class="form-select" id="direction" name="direction" onchange="getSources(this)" required>
                                <?php
                                // prepare query
                                $q = 'SELECT *FROM `direction`';
                                // prepare the query
                                $stmt = $con->prepare($q); // select all users
                                $stmt->execute(); // execute data
                                $dirrows = $stmt->fetchAll(); // assign all data to variable
                                $count = $stmt->rowCount();
                                // check the row count
                                if ($count > 0) { ?>
                                    <option value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('THE DIRECTION', $_SESSION['systemLang']) ?></option>
                                    <?php foreach ($dirrows as $dirrow) { ?>
                                        <option value="<?php echo $dirrow['direction_id'] ?>" data-dir-ip="<?php echo $dirrow['direction_ip'] ?>">
                                            <?php echo  $dirrow['direction_name'] ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="default" disabled selected><?php echo language('NOT AVAILABLE NOW', $_SESSION['systemLang']) ?></option>';
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- type -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="types" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE TYPE', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <select class="form-select" id="types" name="type" required>
                                <?php
                                // prepare query
                                $q = 'SELECT *FROM `types`';
                                // prepare the query
                                $stmt = $con->prepare($q); // select all users
                                $stmt->execute(); // execute data
                                $typerows = $stmt->fetchAll(); // assign all data to variable
                                $count = $stmt->rowCount();
                                // check the row count
                                if ($count > 0) { ?>
                                    <option value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('THE TYPE', $_SESSION['systemLang']) ?></option>
                                    <?php foreach ($typerows as $typerow) { ?>
                                        <option value="<?php echo $typerow['type_id'] ?>">
                                            <?php echo $typerow['type_name'] ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="default" disabled selected><?php echo language('NOT AVAILABLE NOW', $_SESSION['systemLang']) ?></option>';
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- source -->
                    <div class="mb-3 row">
                        <label for="sources" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE SOURCE', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <select class="form-select" id="sources" name="sourceid" required>
                                <option  value="default" selected disabled><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('THE SOURCE', $_SESSION['systemLang']) ?></option>
                            </select>
                        </div>
                    </div>
                    <!-- direct -->
                    <div class="mb-3 row">
                        <label for="direct" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('CONNECTION', $_SESSION['systemLang']) ?></label>
                        <div class="mt-1 col-sm-12 col-md-8">
                            <select class="form-select" name="direct" id="direct" required>
                                <option value="default" selected disabled><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('CONNECTION', $_SESSION['systemLang']) ?></option>
                                <option value="1"><?php echo language('DIRECT', $_SESSION['systemLang']) ?></option>
                                <option value="0"><?php echo language('NOT DIRECT', $_SESSION['systemLang']) ?></option>
                            </select>
                        </div>
                    </div>
                    <!-- connection type -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="conn-type" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('CONNECTION TYPE', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <select class="form-select text-uppercase" name="conn-type" id="conn-type" required>
                                <?php
                                // prepare query
                                $q = 'SELECT *FROM `conn_types`';

                                $stmt = $con->prepare($q); // select all directions
                                $stmt->execute(); // execute data
                                $connTypeRows = $stmt->fetchAll(); // assign all data to variable
                                $count = $stmt->rowCount();
                                ?>
                                <?php if ($count > 0) { ?>
                                    <option value="default" selected disabled><?php echo language('SELECT', $_SESSION['systemLang'])." ". language('CONNECTION TYPE', $_SESSION['systemLang']) ?></option>
                                    <?php foreach ($connTypeRows as $connTypesRow) { ?>
                                        <option value='<?php echo $connTypesRow['id'] ?>'>
                                            <?php echo $connTypesRow['conn_name'] ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="default" disabled selected><?php echo language('NOT AVAILABLE NOW', $_SESSION['systemLang']) ?></option>';
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- third column -->
            <div class="col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5><?php echo language('PIECE INFO', $_SESSION['systemLang']) ?></h5>
                        <hr />
                    </div>
                    <!-- IP -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="ip" class="col-sm-12 col-md-4 col-form-label"><span class="text-uppercase"><?php echo language('IP', $_SESSION['systemLang']) ?></span></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="ip" name="ip" placeholder="xxx.xxx.xxx.xxx" onkeyup="validateIPaddress(this)" autocomplete="off" required />
                            <div id="ipHelp" class="form-text text-info"><?php echo language('IF PIECE/CLIENT NOT HAVE AN IP PRESS 0.0.0.0', $_SESSION['systemLang']) ?></div>
                        </div>
                    </div>
                    <!-- user name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="user-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('USERNAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="user-name" name="user-name" placeholder="<?php echo language('USERNAME', $_SESSION['systemLang']) ?>" autocomplete="off" required />
                        </div>
                    </div>
                    <!-- password -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="password" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('PASSWORD', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="password" name="password" placeholder="<?php echo language('PASSWORD', $_SESSION['systemLang']) ?>" autocomplete="off" required />
                        </div>
                    </div>
                    <!-- ssid -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="ssid" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('SSID', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="ssid" name="ssid" placeholder="<?php echo language('SSID', $_SESSION['systemLang']) ?>" />
                        </div>
                    </div>
                    <!-- password-connection -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="password-connection" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('PASSWORD CONNECTION', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="password" class="form-control" id="password-connection" name="password-connection" placeholder="<?php echo language('PASSWORD CONNECTION', $_SESSION['systemLang']) ?>" autocomplete="off" />
                            <i class="bi bi-eye-slash show-pass <?php echo $_SESSION['systemLang'] == 'ar' ? 'show-pass-left' : 'show-pass-right' ?>" onclick="showPass(this)"></i>
                            <div id="passHelp" class="form-text text-warning "><?php echo language('DON`T SHARE THIS PASSWORD WITH ANYONE', $_SESSION['systemLang']) ?></div>
                        </div>
                    </div>
                    <!-- frequency -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="frequency" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('FREQUENCY', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="frequency" name="frequency" placeholder="<?php echo language('FREQUENCY', $_SESSION['systemLang']) ?>"  />
                        </div>
                    </div>
                    <!-- device-type -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="device-type" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('DEVICE TYPE', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="device-type" name="device-type" placeholder="<?php echo language('DEVICE TYPE', $_SESSION['systemLang']) ?>" />
                        </div>
                    </div>
                    <!-- MAC ADD -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="mac-add" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('MAC ADD', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="mac-add" name="mac-add" onkeyup="validateMacAddress(this)" placeholder="<?php echo language('MAC ADD', $_SESSION['systemLang']) ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- forth column -->
            <div class="col-12">
                <div class="vstack gap-3">
                    <div>
                        <div class="section-block">
                            <div class="section-header">
                                <h5><?php echo language('ADDITIONAL INFO', $_SESSION['systemLang']) ?></h5>
                                <hr />
                            </div>
                            <!-- notes -->
                            <div class="row">
                                <label for="notes" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <textarea name="notes" id="notes" title="put some notes hete if exist" class="form-control w-100" style="height: 10rem; resize: none; direction: <?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>" placeholder="<?php echo language('PUT YOUR NOTES HERE', $_SESSION['systemLang']) ?>"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- location -->
                    <!-- <div>
                        <div class="section-block">
                            <div class="section-header">
                                <h5><?php echo language('LOCATION', $_SESSION['systemLang']) ?></h5>
                                <hr />
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <iframe src="https://www.google.com/maps/@30.5613866,31.0137037,17z" frameborder="0" width="100%"></iframe>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- submit -->
        <div class="hstack gap-3">
            <button type="button" form="addPiece" class="btn btn-primary text-capitalize bg-gradient <?php echo $_SESSION['systemLang'] == 'ar' ? 'me-auto' : 'ms-auto' ?>" id="add-piece" <?php if ($_SESSION['pcs_add'] == 0) {echo 'disabled';} ?> onclick="validateForm(this.form)">
                <i class="bi bi-plus"></i>
                <?php echo language('ADD NEW PIECE/CLIENT', $_SESSION['systemLang']) ?>
            </button>
        </div>
    </form>
    <!-- end form -->
</div>
