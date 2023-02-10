<?php
/**
 * Pieces class
 */
class Pieces extends Database {
    // properties
    public $con;

    // constructor
    public function __construct() {
        // create an object of Database class
        $db_obj = new Database();
        $this->con = $db_obj->con;
    }

    // get specific piece
    public function get_spec_piece($id) {
        // get user info from database
        $select_query = 'SELECT 
            `pieces`.*, 
            `pieces_addr`.`address`, 
            `pieces_phone`.`phone`,
            `pieces_additional`.`ssid`,
            `pieces_additional`.`pass_connection`,
            `pieces_additional`.`frequency`,
            `pieces_additional`.`device_type`
        FROM 
            `pieces`
        LEFT JOIN `pieces_addr` ON `pieces_addr`.`piece_id` = `pieces`.`piece_id` 
        LEFT JOIN `pieces_phone` ON `pieces_phone`.`piece_id` = `pieces`.`piece_id`
        LEFT JOIN `pieces_additional` ON `pieces_additional`.`piece_id` = `pieces`.`piece_id`
        WHERE 
            `pieces`.`piece_id` = ?
        ORDER BY 
            `pieces`.`direction_id` ASC, 
            `pieces`.`direct` DESC, 
            `pieces`.`type_id` ASC';
            
        // prepare the query
        $stmt = $this->con->prepare($select_query);
        $stmt->execute(array($id)); // execute query
        $row = $stmt->fetch(); // fetch data
        $pcs_count =  $stmt->rowCount();       // count effected rows
        // return result
        return $pcs_count > 0 ? [true, $row] : [false, null];
    }

    // insert a new Piece
    public function inser_new_piece($info) {
        // INSERT INTO basic info
        $insert_query = "INSERT INTO `pieces` (`piece_id`, `piece_name`, `mac_add`, `piece_ip`, `username`, `piece_pass`, `direction_id`, `source_id`, `alt_source_id`, `type_id`, `direct`, `conn_type`, `added_by`, `added_date`, `notes`, `ssid`, `pass_connection`, `frequency`, `device_type`, `company_id`, `is_client`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_DATE(), ?, ?, ?, ?, ?, ?, ?);";
        // INSERT INTO pieces_addr
        $insert_query .= "INSERT INTO `pieces_addr` VALUES (?, ?);";
        // INSERT INTO piece phone ..
        $insert_query .= "INSERT INTO `pieces_phone` VALUES (?, ?);";
        // insert user info in database
        $insert_query .= "INSERT INTO `pieces_additional` (`piece_id`, `ssid`, `pass_connection`, `frequency`, `device_type`) VALUES (?, ?, ?, ?, ?);";
        // insert user info in database
        $stmt = $this->con->prepare($insert_query);
        $stmt->execute($info);
        $pcs_count =  $stmt->rowCount();       // count effected rows
        // return result
        return $pcs_count > 0 ? true : false;
    }

    // delete piece
    public function delete_piece($id) {
        // delete query
        $delete_query  = "DELETE FROM `pieces` WHERE `pieces`.`piece_id` = ? ; ";
        $delete_query .= "DELETE FROM `pieces_phone` WHERE `pieces_phone`.`piece_id` = ?; ";
        $delete_query .= "DELETE FROM `pieces_addr` WHERE `pieces_addr`.`piece_id` = ?; ";
        $delete_query .= "DELETE FROM `pieces_additional` WHERE `pieces_additional`.`piece_id` = ?; ";
        // prepare query
        $stmt = $this->con->prepare($delete_query);
        $stmt->execute(array($id, $id, $id, $id));
        $pcs_count =  $stmt->rowCount();       // count effected rows
        // return result
        return $pcs_count > 0 ? true : false;
    }


}   
