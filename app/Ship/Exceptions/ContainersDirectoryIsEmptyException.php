<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;

final class ContainersDirectoryIsEmptyException extends Exception
{
    public $message = 'Containers directory is empty';
}
