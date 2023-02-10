<?php
/**
 * Direction class
 */
class Direction extends Database {
    // properties
    public $con;

    // constructor
    public function __construct() {
        // create an object of Database class
        $db_obj = new Database();
        $this->con = $db_obj->con;
    }

    // get all directions
    public function get_all_directions($company) {
        // prepare query
        $dirQuery = "SELECT *From `direction` WHERE `company_id` = ?";
        $stmt = $this->con->prepare($dirQuery); // select all users
        $stmt->execute(array($company)); // execute data
        $rows = $stmt->fetchAll(); // assign all data to variable
        $count = $stmt->rowCount(); // assign all data to variable
        // return result
        return [$count, $rows];
    }

    // insert a new direction
    public function insert_new_direction($name, $added_by, $company) {
        // insert query
        $insertDirQuery = "INSERT INTO `direction` (`direction_name`, `added_date`, `added_by`, `company_id`) VALUES (?, CURRENT_DATE, ?, ?);";
        $stmt = $this->con->prepare($insertDirQuery);
        $stmt->execute(array($name, $added_by, $company));
        $count = $stmt->rowCount(); // assign all data to variable
        // return result
        return $count > 0 ? true : false;
    }

    // update direction info
    public function update_direction($name, $id) {
        // insert query
        $updateDirQuery = "UPDATE `direction` SET `direction_name` = ? WHERE `direction_id` = ?;";
        $stmt = $this->con->prepare($updateDirQuery);
        $stmt->execute(array($name, $id));
        $count = $stmt->rowCount(); // assign all data to variable
        // return result
        return $count > 0 ? true : false;
    }

    // delete direction info
    public function delete_direction($id) {
        // insert query
        $deleteQuery = "DELETE FROM `direction` WHERE `direction_id` = ?";
        $stmt = $this->con->prepare($deleteQuery);
        $stmt->execute(array($id));
        $count = $stmt->rowCount(); // assign all data to variable
        // return result
        return $count > 0 ? true : false;
    }
}
