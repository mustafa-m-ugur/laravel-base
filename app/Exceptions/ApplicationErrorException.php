<?php

namespace App\Exceptions;

use Exception;

class ApplicationErrorException extends Exception
{
    protected $message;
    protected $messageArr;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $this->message = $message;
        $this->messageArr = $message;
        $message = is_array($message) ? implode(" -- ", $message) : $message;
        parent::__construct($message, $code, $previous);
    }

    public function getMessageArr()
    {
        return is_array($this->messageArr) ? $this->messageArr : [$this->messageArr];
    }


}
