<!-- Modal -->
<div class="modal fade" id="editDirectionModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-type-dialog" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-auto modal-title h5 " id="staticBackdropLabel"><?php echo language("EDIT DIRECTION", $_SESSION['systemLang']) ?></h5>
            </div>
            <div class="modal-body">
                <form action="directions.php?do=updateDir" method="POST" id="editDirection">
                    <!-- type id -->
                    <input type="hidden" name="updated-dir-id" id="updated-dir-id">
                    <!-- start old direction name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="updated-dir-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE DIRECTION', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <?php $dirRows = selectSpecificColumn("*", "`direction`", ""); ?>
                            <select class="form-select" id="updated-dir-name" name="updated-dir-name" onchange="document.getElementById('updated-dir-id').value = this.value; document.getElementById('new-direction-name').value = this[this.selectedIndex].textContent; document.getElementById('new-direction-ip').value = this[this.selectedIndex].dataset.ip;" required>
                                <option value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ".language('THE DIRECTION', $_SESSION['systemLang']) ?></option>
                                <!-- loop on pieces types -->
                                <?php foreach ($dirRows as $type) { ?>
                                    <option value="<?php echo $type['direction_id'] ?>" data-ip="<?php echo $type['direction_ip'] ?>"><?php echo $type['direction_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- end old direction name -->
                    <!-- start direction name field -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="new-direction-name" class="col-sm-12 col-md-4 col-form-label text-capitalize" ><?php echo language('DIRECTION NAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" name="new-direction-name" id="new-direction-name" placeholder="<?php echo language('DIRECTION NAME', $_SESSION['systemLang']) ?>" required>
                            <div id="passHelp" class="form-text"><?php echo language('MAKE SURE YOU ENTER THE FULL NAME OF THE DIRECTION', $_SESSION['systemLang']) ?></div>
                        </div>
                    </div>
                    <!-- end direction name field -->
                    <!-- start direction ip field -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="new-direction-ip" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE DIRECTION', $_SESSION['systemLang']) ?>&nbsp;<span class="text-uppercase">ip</span></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" name="new-direction-ip" id="new-direction-ip" onkeyup="validateIPaddress(this)" placeholder="" autocomplete="off" required>
                            <div id="passHelp" class="form-text"><?php echo language('IP MUST BE IN FORMATE OF XXX.XXX.XXX.XXX', $_SESSION['systemLang']) ?></div>
                        </div>
                    </div>
                    <!-- end direction ip field -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary py-1 fs-12" form="editDirection" onclick="validateForm(this.form)"><?php echo language("SAVE CHANGES", $_SESSION['systemLang']) ?></button>
                <button type="button" class="btn btn-outline-secondary py-1 px-3 fs-12" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>