<!-- start add new user page -->
<div class="container">
    <!-- start header -->
    <header class="header">
        <h1 class="text-capitalize"><?php echo language('ADD NEW COMBINATION', $_SESSION['systemLang']) ?></h1>
    </header>
    <!-- end header -->
    <!-- start form -->
    <form class="py-3 my-5 custom-form" action="?do=insertCombination" method="POST">
        <div class="row row-cols-sm-1 row-cols-md-2 gy-sm-5 gx-lg-3">
            <!-- first column -->
            <!-- first column -->
            <div class="mb-5 col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5><?php echo language('RESPONSIBLE FOR COMB INFO', $_SESSION['systemLang']) ?></h5>
                        <hr />
                    </div>
                    <!-- Administrator name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="admin-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="hidden" class="form-control" id="admin-id" name="admin-id" value="<?php echo $_SESSION['UserID'] ?>" autocomplete="off" required />
                            <input type="text" class="form-control" id="admin-name" name="admin-name" placeholder="administrator name" value="<?php echo $_SESSION['UserName'] ?>" autocomplete="off" required readonly />
                        </div>
                    </div>
                    <!-- Technical name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="technical-id" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('TECHNICAL NAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <select class="form-select" id="technical-id" name="technical-id">
                                <option  value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ".language('TECHNICAL NAME', $_SESSION['systemLang']) ?></option>
                                <?php
                                $usersRows = selectSpecificColumn("`UserID`, `UserName`", "users", "WHERE `isTech` = 1");

                                if (count($usersRows) > 0) {
                                    // loop on result ..
                                    foreach ($usersRows as $userRow) {
                                        // get all information of pieces..
                                        echo "<option value='" . $userRow['UserID'] . "'>";
                                        echo $userRow['UserName'];
                                        echo "</option>";
                                    }
                                } else {
                                    echo "<option>Not available now</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5><?php echo language('CLIENT INFO', $_SESSION['systemLang']) ?></h5>
                        <hr />
                    </div>
                    <!-- client-nameme -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="client-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" name="client-name" placeholder="<?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?>" required>
                        </div>
                    </div>
                    <!-- phone -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="client-phone" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('PHONE', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8 position-relative">
                            <input type="text" name="client-phone" id="client-phone" class="form-control w-100" placeholder="<?php echo language('PHONE', $_SESSION['systemLang']) ?>" required/>
                        </div>
                    </div>
                    <!-- address -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="client-address" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8 position-relative">
                            <input type="text" name="client-address" id="client-address" class="form-control w-100" placeholder="<?php echo language('THE ADDRESS', $_SESSION['systemLang']) ?>" required />
                        </div>
                    </div>
                    <!-- notes -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="client-notes" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8 position-relative">
                            <textarea type="text" name="client-notes" id="client-notes" class="form-control w-100" rows="5" placeholder="<?php echo language('THE NOTES', $_SESSION['systemLang']) ?>" style="resize: none; direction: <?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>" required ></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- submit -->
        <div class="my-3 row">
            <div class="ms-auto col-sm-4">
                <button type="submit" class="btn btn-primary text-capitalize form-control bg-gradient <?php if ($_SESSION['comb_add'] == 0) {echo 'disabled';} ?>" id="add-malfunctions">
                    <?php echo language('ADD THE COMBINATION', $_SESSION['systemLang']) ?>
                </button>
            </div>
        </div>
    </form>
    <!-- end form -->
</div>