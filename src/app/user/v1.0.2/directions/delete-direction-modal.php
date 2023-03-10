<!-- Modal -->
<div class="modal fade" id="deleteDirectionModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-type-dialog" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-auto modal-title h5 " id="staticBackdropLabel"><?php echo language("DELETE DIRECTION", $_SESSION['systemLang']) ?></h5>
            </div>
            <div class="modal-body">
                <form action="directions.php?do=deleteDir" method="POST" id="deleteDirection">
                    <!-- type id -->
                    <input type="hidden" name="deleted-dir-id" id="deleted-dir-id">
                    <!-- start old direction name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="deleted-dir-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE DIRECTION', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <?php $dirRows = selectSpecificColumn("*", "`direction`", ""); ?>
                            <select class="form-select" id="deleted-dir-name" name="deleted-dir-name" onchange="document.getElementById('deleted-dir-id').value = this.value;" required>
                                <option value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ".language('THE DIRECTION', $_SESSION['systemLang']) ?></option>
                                <!-- loop on pieces types -->
                                <?php foreach ($dirRows as $type) { ?>
                                    <option value="<?php echo $type['direction_id'] ?>"><?php echo $type['direction_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- end old direction name -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger py-1 fs-12" form="deleteDirection" onclick="validateForm(this.form)"><i class="bi bi-trash"></i>&nbsp;<?php echo language("DELETE", $_SESSION['systemLang']) ?></button>
                <button type="button" class="btn btn-outline-secondary py-1 px-3 fs-12" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>