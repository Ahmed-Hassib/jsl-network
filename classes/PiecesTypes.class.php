<?php
/**
 * PiecesTypes class
 */
class PiecesTypes extends Database {
    // properties
    public $con;

    // constructor
    public function __construct() {
        // create an object of Database class
        $db_obj = new Database();
        $this->con = $db_obj->con;
    }
    
    // get all types
    public function get_all_types($company) {
        // get all pieces types
        $typesQuery = "SELECT *FROM `types` WHERE `company_id` = ?";
        $stmt = $this->con->prepare($typesQuery);
        $stmt->execute(array($company));
        $typesRows = $stmt->fetchAll();
        $typesCount =  $stmt->rowCount();
        // return result
        return $typesCount > 0 ? [$typesCount, $typesRows] : [0, null];
    }

    // insert a new piece type
    public function insert_new_type($name, $note, $company) {
        // insert query
        $insertQuery = "INSERT INTO `types` (`type_name`, `type_note`, `company_id`) VALUES (?, ?, ?);";
        $stmt = $this->con->prepare($insertQuery);
        $stmt->execute(array($name, $note, $company));
        $typesCount =  $stmt->rowCount();       // count effected rows
        // return result
        return $typesCount > 0 ? true : false;
    }

    // update type
    public function update_type($name, $note, $id) {
        // update query
        $updateQuery = "UPDATE `types` SET `type_name` = ?, `type_note` = ? WHERE `type_id` = ?";
        $stmt = $this->con->prepare($updateQuery);
        $stmt->execute(array($name, $note, $id));
        $typesCount =  $stmt->rowCount();       // count effected rows
        // return result
        return $typesCount > 0 ? true : false;
    }

    // delete type
    public function delete_type($id) {
        // delete query
        $q = "DELETE FROM `types` WHERE `type_id` = ?";
        $stmt = $this->con->prepare($q);
        $stmt->execute(array($id));
        $typesCount =  $stmt->rowCount();       // count effected rows
        // return result
        return $typesCount > 0 ? true : false;
    }
}
