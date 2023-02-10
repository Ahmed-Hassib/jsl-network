<!-- start add new user page -->
<div class="container">
    <!-- start header -->
    <header class="header">
        <h1 class="text-capitalize"><?php echo language('ADD NEW MALFUNCTION', $_SESSION['systemLang']) ?></h1>
    </header>
    <!-- end header -->
    <!-- start form -->
    <form class="py-3 my-5 custom-form" action="?do=insertMalfunctions" method="POST">
        <div class="row row-cols-sm-1 row-cols-md-2 gy-sm-5 gx-lg-3">
            <!-- first column -->
            <div class="mb-5 col-12">
                <div class="section-block">
                    <div class="section-header">
                        <h5><?php echo language('RESPONSIBLE FOR REPAIR INFO', $_SESSION['systemLang']) ?></h5>
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

                                $usersRows = selectSpecificColumn("`UserID`, `UserName`", "`users`", "WHERE `isTech` = 1");

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
                    <!-- phone -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="client-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('CLIENT NAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8 position-relative">
                            <input type="hidden" name="client-id" id="client-id" class="form-control w-100" placeholder="Client ID" />
                            <input type="text" name="client-name" id="client-name" class="form-control w-100" placeholder="<?php echo language('ADMIN NAME', $_SESSION['systemLang']) ?>" onkeyup="search(this)" required />
                            <div class="result w-100">
                                <ul class="clients-names" id="clients-names"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- forth column -->
            <div class="col">
                <div class="section-block">
                    <div class="section-header">
                        <h5><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></h5>
                        <hr />
                    </div>
                    <!-- notes -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="descreption" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <textarea name="descreption" id="descreption" title="<?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?>" class="form-control w-100" style="height: 10rem; resize: none; direction: <?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>" placeholder="<?php echo language('MALFUNCTION DESCRIPTION', $_SESSION['systemLang']) ?>" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- submit -->
        <div class="my-3 row">
            <div class="ms-auto col-sm-3">
                <button type="submit" class="btn btn-primary text-capitalize form-control bg-gradient <?php if ($_SESSION['mal_add'] == 0) {echo 'disabled';} ?>" id="add-malfunctions">
                    <?php echo language('ADD', $_SESSION['systemLang'])." ".language('THE MALFUNCTION', $_SESSION['systemLang']) ?>
                </button>
            </div>
        </div>
    </form>
    <!-- end form -->
</div>