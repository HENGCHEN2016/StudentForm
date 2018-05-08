<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 9:25 AM
 */

namespace studentform\model;

use studentform\constant\Constant;
//use StudentForm\exception\ConfirmException;

class StudentModel extends Model
{
    /*
     *
     */
    private  $_id;
    /*
     *
     */
    private  $_name;
    /*
     *
     */
    private  $_paper;

    public function __construct($_name)
    {
        parent::_construct();
        $this->_name=$_name;
    }

    public function getId()
    {
        return $this->_id;
    }
    public function getPaper()
    {
        return $this->_paper;
    }
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param $name string
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    public function createNew()
    {
        $result = $this->loadUser($this->_name);
        if (!$result) {
            $values = "(NULL,'" . $this->_name . "')";
            $this->insertRow(Constant::Table_Student, $values);
            $this->loadUser($this->_name);
        } else {
            throw new ConfirmException("Student name already exsits");
        }
        return $this;
    }

    /**
     * (tested)
     * delete User information from database
     * @return $this UserModel
     */
    public function delete()
    {
        $where = "name = '$this->_name'";
        $this->deleteRow(Constant::Table_Student, $where);
        return $this;
    }

    /**
     * (tested)
     * load User information from database
     * @param $name string
     * @return $this|bool UserModel , if failed return false
     */
    private function loadUser($name)
    {
        $strQuery = "SELECT * FROM " . Constant::Table_Student . " WHERE `name` = '$name';";
        $result = $this->db->query($strQuery);
        if (!$result) {
//            echo "Failed in load Data: Bad Query<br>";
            return false;
        } else {
            $result = $result->fetch_assoc();
            if ($result['sid'] <= 0) {
//                echo "Failed load User: Not Exsits<br>";
                return false;
            }
            // set uid
            $this->_id = $result['sid'];
            return new StudentModel($name);
        }
    }
    private function checkUserInfo($name)
    {
        if (strcmp($name, $this->_name) == 0 ) {
            return true;
        }
//        echo "Failed load User: Wrong Password<br>";
        return false;
    }

}