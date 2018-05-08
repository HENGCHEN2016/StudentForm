<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 10:24 AM
 */

namespace studentform\exception;

use Exception;

class ConfirmException extends Exception
{
    private $errorMessage;
    public function __construct($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}