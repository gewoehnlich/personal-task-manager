<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;

class ContainersDirectoryIsEmptyException extends Exception
{
    public $message = 'Containers directory is empty';
}
