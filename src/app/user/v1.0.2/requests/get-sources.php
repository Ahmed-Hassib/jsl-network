<?php
    // get dir id
    $dir_id = isset($_GET['dir-id']) ? $_GET['dir-id'] : 0;
    // company id
    $company_id = isset($_GET['company']) ? $_GET['company'] : 0;

    // check if arr parameters are entered or not
    if (empty($dir_id) || empty($company_id)) {
        echo json_encode(false);
    } else {
        // create an object of pieces
        $pcs_obj = new Pieces();
        // condition
        $pcs_condition = "WHERE `is_client` = 0 AND `direction_id` = '".$dir_id."' AND `company_id` = '".$company_id."' ORDER BY `direction_id` ASC, `piece_id` ASC";
        // get specific columns from pieces table
        $data = $pcs_obj->select_specific_column("`piece_id`, `piece_ip`, `piece_name`", "`pieces`", $pcs_condition);

        // // return data in json encode
        echo json_decode($data);
        // print_r($data);
    }