<?php if ($_SESSION['isRoot'] || $_SESSION['companies_show']) { ?>
<!-- <div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('CONTROL COMPANIES', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['companies_add'] == 1) {echo 'checked';} ?> value="1" name="companiesAdd" id="companiesPage1">
                    <label class="form-check-label" for="companiesPage1">
                        <?php echo language("ADD", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['companies_update'] == 1) {echo 'checked';} ?> value="1" name="companiesUpdate" id="companiesPage2">
                    <label class="form-check-label" for="companiesPage2">
                        <?php echo language("EDIT", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['companies_delete'] == 1) {echo 'checked';} ?> value="1" name="companiesDelete" id="companiesPage3">
                    <label class="form-check-label" for="companiesPage3">
                        <?php echo language("DELETE", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['companies_show'] == 1) {echo 'checked';} ?> value="1" name="companiesShow" id="companiesPage4">
                    <label class="form-check-label" for="companiesPage4">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div> -->
<?php } ?>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('THE EMPLOYEES', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['user_add'] == 1) {echo 'checked';} ?> value="1" name="userAdd" id="usersPage1">
                    <label class="form-check-label" for="usersPage1">
                        <?php echo language("ADD", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['user_update'] == 1) {echo 'checked';} ?> value="1" name="userUpdate" id="usersPage2">
                    <label class="form-check-label" for="usersPage2">
                        <?php echo language("EDIT", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['user_delete'] == 1) {echo 'checked';} ?> value="1" name="userDelete" id="usersPage3">
                    <label class="form-check-label" for="usersPage3">
                        <?php echo language("DELETE", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['user_show'] == 1) {echo 'checked';} ?> value="1" name="userShow" id="usersPage4">
                    <label class="form-check-label" for="usersPage4">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('PIECES/CLIENTS', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['pcs_add'] == 1) {echo 'checked';} ?> value="1" name="pcsAdd" id="pcsPage1">
                    <label class="form-check-label" for="pcsPage1">
                        <?php echo language("ADD", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['pcs_update'] == 1) {echo 'checked';} ?> value="1" name="pcsUpdate" id="pcsPage2">
                    <label class="form-check-label" for="pcsPage2">
                        <?php echo language("EDIT", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['pcs_delete'] == 1) {echo 'checked';} ?> value="1" name="pcsDelete" id="pcsPage3">
                    <label class="form-check-label" for="pcsPage3">
                        <?php echo language("DELETE", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['pcs_show'] == 1) {echo 'checked';} ?> value="1" name="pcsShow" id="pcsPage4">
                    <label class="form-check-label" for="pcsPage4">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('THE DIRECTIONS', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['dir_add'] == 1) {echo 'checked';} ?> value="1" name="dirAdd" id="dirPage1">
                    <label class="form-check-label" for="dirPage1">
                        <?php echo language("ADD", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['dir_update'] == 1) {echo 'checked';} ?> value="1" name="dirUpdate" id="dirPage2">
                    <label class="form-check-label" for="dirPage2">
                        <?php echo language("EDIT", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['dir_delete'] == 1) {echo 'checked';} ?> value="1" name="dirDelete" id="dirPage3">
                    <label class="form-check-label" for="dirPage3">
                        <?php echo language("DELETE", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['dir_show'] == 1) {echo 'checked';} ?> value="1" name="dirShow" id="dirPage4">
                    <label class="form-check-label" for="dirPage4">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('THE MALFUNCTIONS', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['mal_add'] == 1) {echo 'checked';} ?> value="1" name="malAdd" id="malAdd">
                    <label class="form-check-label" for="malAdd">
                        <?php echo language("ADD", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['mal_update'] == 1) {echo 'checked';} ?> value="1" name="malUpdate" id="malUpdate">
                    <label class="form-check-label" for="malUpdate">
                        <?php echo language("EDIT", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['mal_delete'] == 1) {echo 'checked';} ?> value="1" name="malDelete" id="malDelete">
                    <label class="form-check-label" for="malDelete">
                        <?php echo language("DELETE", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['mal_show'] == 1) {echo 'checked';} ?> value="1" name="malShow" id="malShow">
                    <label class="form-check-label" for="malShow">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['mal_review'] == 1) {echo 'checked';} ?> value="1" name="malReview" id="malReview">
                    <label class="form-check-label" for="malReview">
                        <?php echo language("RATING", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('THE COMBINATIONS', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['comb_add'] == 1) {echo 'checked';} ?> value="1" name="combAdd" id="combAdd">
                    <label class="form-check-label" for="combAdd">
                        <?php echo language("ADD", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['comb_update'] == 1) {echo 'checked';} ?> value="1" name="combUpdate" id="combUpdate">
                    <label class="form-check-label" for="combUpdate">
                        <?php echo language("EDIT", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['comb_delete'] == 1) {echo 'checked';} ?> value="1" name="combDelete" id="combDelete">
                    <label class="form-check-label" for="combDelete">
                        <?php echo language("DELETE", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['comb_show'] == 1) {echo 'checked';} ?> value="1" name="combShow" id="combShow">
                    <label class="form-check-label" for="combShow">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['comb_review'] == 1) {echo 'checked';} ?> value="1" name="combReview" id="combReview">
                    <label class="form-check-label" for="combReview">
                        <?php echo language("RATING", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('COMPLAINTS & SUGGESTIONS', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['sugg_replay'] == 1) {echo 'checked';} ?> value="1" name="suggReplay" id="suggReplay">
                    <label class="form-check-label" for="suggReplay">
                        <?php echo language("REPLAY", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['sugg_delete'] == 1) {echo 'checked';} ?> value="1" name="suggDelete" id="suggDelete">
                    <label class="form-check-label" for="suggDelete">
                        <?php echo language("DELETE", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['sugg_show'] == 1) {echo 'checked';} ?> value="1" name="suggShow" id="suggShow">
                    <label class="form-check-label" for="suggShow">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('MOTIVATION POINTS', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['points_add'] == 1) {echo 'checked';} ?> value="1" name="pointsAdd" id="pointsAdd">
                    <label class="form-check-label" for="pointsAdd">
                        <?php echo language("ADD", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['points_delete'] == 1) {echo 'checked';} ?> value="1" name="pointsDelete" id="pointsDelete">
                    <label class="form-check-label" for="pointsDelete">
                        <?php echo language("DELETE", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['points_show'] == 1) {echo 'checked';} ?> value="1" name="pointsShow" id="pointsShow">
                    <label class="form-check-label" for="pointsShow">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('REPORTS', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['reports_show'] == 1) {echo 'checked';} ?> value="1" name="reportsShow" id="reportsShow">
                    <label class="form-check-label" for="reportsShow">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('ARCHIVE', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5 align-items-start g-sm-1 gx-md-5">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['archive_show'] == 1) {echo 'checked';} ?> value="1" name="archiveShow" id="archiveShow">
                    <label class="form-check-label" for="archiveShow">
                        <?php echo language("SHOW", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 row">
    <div class="col-sm-12 col-md-3"><?php echo language('BACKUP', $_SESSION['systemLang']) ?></div>
    <div class="col-sm-12 col-md-8">
        <div class="row row-cols-sm-1 row-cols-md-2 align-items-start g-sm-1 gx-md-5 align-item-center">
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['take_backup'] == 1) {echo 'checked';} ?> value="1" name="takeBackup" id="takeBackup">
                    <label class="form-check-label" for="takeBackup">
                        <?php echo language("TAKE BACKUP", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" <?php if ($_SESSION['user_update'] == 0) {echo 'disabled';} ?> <?php if ($permissions['restore_backup'] == 1) {echo 'checked';} ?> value="1" name="restoreBackup" id="restoreBackup">
                    <label class="form-check-label" for="restoreBackup">
                        <?php echo language("RESTORE BACKUP", $_SESSION['systemLang']) ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>