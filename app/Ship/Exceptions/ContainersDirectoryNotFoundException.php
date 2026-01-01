<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;

final class ContainersDirectoryNotFoundException extends Exception
{
    public $message = 'Containers directory not found';
}
