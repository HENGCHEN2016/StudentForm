<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 8:33 AM
 */

namespace studentform\model;

use studentform\constant\Constant;
use studentform\exception\ConfirmException;
use mysqli;

class Model
{
//    Validate username format and length(minimum 2 chars)
//    public function usernameCheck($field) {
//        if(preg_match('/^[a-zA-Z0-9 .\-]{2,}+$/i', $field)){
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Validate password format and length (between 5 and 15 chars)
     */
//    public function passwordCheck($field) {
//        if(preg_match('~^[a-zA-Z0-9]{5,15}$~', $field)){
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Confirm password match
     */
//    function passwordConfirmCheck($field1, $field2) {
//        if($field1 == $field2) {
//            return true;
//        } else {
//            return false;
//        }
//    }
    /**
     * @var mysqli
     */
    protected $db;

    /**
     * (tested)
     * Model constructor
     */
    public function __construct()
    {
        $this->db = new mysqli(
            Constant::DB_HOST,
            Constant::DB_USER,
            Constant::DB_PASS);

        $this->db->query("CREATE DATABASE IF NOT EXISTS " . Constant::DB_NAME . ";");

        if (!$this->db->select_db(Constant::DB_NAME)) {
            // somethings not right.. handle it
            error_log("Mysql database not available!", 0);
        }
    }

    /**
     * (tested)
     * create tables
     */
    public function createTables()
    {
        // create User table ----------------------
        $result = $this->db->query(
            "CREATE TABLE IF NOT EXISTS Users (
                                          `sid` int(8) unsigned NOT NULL AUTO_INCREMENT,
                                          `name` varchar(50) UNIQUE,
                                          `paper` int(6) NOT NULL,
                                          'dt'    TIMESTAMP, 
                                          PRIMARY KEY (`sid`));"
        );
        if (!$result) {
            // echo "Failed creating Table " . Constant::Table_User . "<br>";
            error_log("Failed creating table " . Constant::Table_Student, 0);
        } else {
            // echo "Succeed creating Table " . Constant::Table_User . "<br>";
        }
    }
    /**
     * (tested)
     * print every table in the database
     */
    public function printTables()
    {
        $result = $this->db->query("SHOW TABLES;");
        if ($result->num_rows != 0) {
            $num = 0;
            while ($row = $result->fetch_assoc()) {
                $num++;
                // echo "---Table $num = " . $row['Tables_in_internet_a2'] . "---<br>";
            }
        } else {
            // echo "Empty database<br>";
        }
    }
    /**
     * (tested)
     * drop table
     * @param $tableName  string
     */
    public function dropTable($tableName)
    {
        $result = $this->db->query("DROP TABLE IF EXISTS $tableName;");
        if (!$result) {
            // echo "Failed in dropping Table $tableName <br>";
            error_log("Failed dropping Table $tableName", 0);
        } else {
            // echo "Succeed in dropping Table $tableName <br>";
        }
    }
    /**/
    public function insertStudents($studentID,$name,$paper)
    {
        $user = new studentModel($studentID, $name,$paper);
        $user->createNew();
    }

    protected function insertRow($table, $values)
    {
        $result = $this->db->query(
            "INSERT INTO $table VALUES " . $values . ";");
        if (!$result) {
//             echo "Failed insert value into $table<br>";
            return false;
        } else {
//             echo "Succeed in insert value into $table <br>";
            return true;
        }
    }

    protected function updateRow($table, $values, $where)
    {
        $result = $this->db->query(
            "UPDATE $table SET $values WHERE $where;");
        if (!$result) {
            // echo "Failed update value into $table<br>";
            return false;
        } else {
            // echo "Succeed in update value into $table <br>";
            return true;
        }
    }

    protected function deleteRow($table, $where)
    {
        $result = $this->db->query(
            "DELETE FROM $table WHERE $where;");
        if (!$result) {
            // echo "Failed delete value from $table<br>";
            return false;
        } else {
            // echo "Succeed in delete value from $table <br>";
            return true;
        }
    }

    public function insertData()
    {
      $this->insertStudents(11111111,"P.O",100100);
      $this->insertStudents(11111112,"O.I",100100);
      $this->insertStudents(11111113,"I.U",100101);
      $this->insertStudents(11111114,"U.Y",100102);
      $this->insertStudents(11111115,"Y.T",100103);
      $this->insertStudents(11111116,"T.R",100104);
    }
//    ----------For debug--------------------------------------------------------------
}