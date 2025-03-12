<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct("not found", 404, $previous);
    }
}