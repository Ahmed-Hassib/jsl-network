<!-- Modal -->
<div class="modal fade" id="editPieceConnTypeModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-type-dialog" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-auto modal-title h5 " id="staticBackdropLabel"><?php echo language("EDIT CONNECTION TYPES", $_SESSION['systemLang']) ?></h5>
            </div>
            <div class="modal-body">
                <form action="?do=showConnectionTypes&action=updatePieceConnType" method="POST" id="editPieceConnType">
                    <!-- type id -->
                    <input type="hidden" name="conn-type-id" id="conn-type-id">
                    <!-- start type name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="old-conn-type-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE OLD NAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <?php $typesRows = selectSpecificColumn("*", "`conn_types`", ""); ?>
                            <select class="form-select" id="old-conn-type-name" name="old-conn-type-name" onchange="document.getElementById('conn-type-id').value = this.value; document.getElementById('new-conn-type-note').value = this[this.selectedIndex].dataset.note;" required>
                                <option value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ".language('THE TYPE', $_SESSION['systemLang']) ?></option>
                                <!-- loop on pieces types -->
                                <?php foreach ($typesRows as $type) { ?>
                                    <option value="<?php echo $type['id'] ?>" data-note="<?php echo $type['notes'] ?>"><?php echo $type['conn_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- end type name -->
                    <!-- start type name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="new-conn-type-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE NEW NAME', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="new-conn-type-name" name="new-conn-type-name" autocomplete="off" required />
                        </div>
                    </div>
                    <!-- end type name -->
                    <!-- start type note -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="new-conn-type-note" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE NOTES', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <textarea class="form-control" style="resize: none" id="new-conn-type-note" name="new-conn-type-note"  placeholder="<?php echo language('PUT YOUR NOTES HERE', $_SESSION['systemLang']) ?>" rows="5" cols="5"></textarea>
                        </div>
                    </div>
                    <!-- end type note -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary py-1 fs-12" form="editPieceConnType" onclick="validateForm(this.form)"><?php echo language("SAVE CHANGES", $_SESSION['systemLang']) ?></button>
                <button type="button" class="btn btn-outline-secondary py-1 px-3 fs-12" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>