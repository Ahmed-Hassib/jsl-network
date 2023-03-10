<!-- Modal -->
<div class="modal fade" id="deletePieceConnTypeModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-type-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-auto modal-title h5 " id="staticBackdropLabel"><?php echo language("DELETE CONNECTION TYPE", $_SESSION['systemLang']) ?></h5>
            </div>
            <div class="modal-body">
                <form action="?do=showConnectionTypes&action=deletePieceConnType" method="POST" id="deletePieceConnType">
                    <!-- type id -->
                    <input type="hidden" name="deleted-conn-type-id" id="deleted-conn-type-id">
                    <!-- start type name -->
                    <div class="mb-sm-2 mb-md-3 row">
                        <label for="deleted-conn-type-name" class="col-sm-12 col-md-4 col-form-label text-capitalize"><?php echo language('THE TYPE', $_SESSION['systemLang']) ?></label>
                        <div class="col-sm-12 col-md-8">
                            <?php 
                            // create an object of PieceConn class
                            $conn_obj = new PiecesConn();
                            // get all connections data
                            $connections = $conn_obj->get_all_conn_types($_SESSION['company_id']);
                            $typesRows = $connections[1]; 
                            ?>
                            <select class="form-select" id="deleted-conn-type-name" name="deleted-conn-type-name" onchange="document.getElementById('deleted-conn-type-id').value = this.value;" required>
                                <option value="default" disabled selected><?php echo language('SELECT', $_SESSION['systemLang'])." ".language('THE TYPE', $_SESSION['systemLang']) ?></option>
                                <!-- loop on pieces types -->
                                <?php foreach ($typesRows as $type) { ?>
                                    <option value="<?php echo $type['id'] ?>" data-note="<?php echo $type['notes'] ?>"><?php echo $type['conn_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- end type name -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger py-1 fs-12" form="deletePieceConnType" onclick="validateForm(this.form)"><i class="bi bi-trash"></i>&nbsp;<?php echo language("DELETE", $_SESSION['systemLang']) ?></button>
                <button type="button" class="btn btn-outline-secondary py-1 px-3 fs-12" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>