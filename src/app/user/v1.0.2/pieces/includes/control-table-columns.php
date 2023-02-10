<!-- Modal -->
<div class="modal fade" id="controlTableColumn" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" dir="<?php echo $_SESSION['systemLang'] == 'ar' ? 'rtl' : 'ltr' ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-auto modal-title h5 " id="staticBackdropLabel"><?php echo language("CONTROL TABLE COLUMNS", $_SESSION['systemLang']) ?></h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form action="pieces.php?do=controlColumns" method="POST" id="controlColumns">
                    <?php $i = 0; ?>
                    <div class="row row-cols-sm-1 row-cols-md-3 g-3">
                        <?php foreach ($columns as $key => $col) { ?>
                            <div class="col">
                                <div class="row">
                                    <label for="<?php echo $key ?>" class="col-sm-6 col-form-label text-capitalize"><?php echo language($col, $_SESSION['systemLang']) ?></label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="<?php echo $key ?>" id="<?php echo $key ?>" class="form-check-input" value="1" <?php echo $_SESSION[$key] == 1 ? 'checked' : ''  ?> />
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php } ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary text-capitalize fs-12 py-1" form="controlColumns"><?php echo language("SAVE CHANGES", $_SESSION['systemLang']) ?></button>
                <button type="button" class="btn btn-outline-secondary text-capitalize fs-12 py-1" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>