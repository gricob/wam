<?php 

namespace App\Exception;

class UnsupportedFormatException extends \Exception
{
    public function __construct($format)
    {
        parent::__construct("Unsupported format [$format]");
    }
}