<?php

namespace yonyon\EloquentSchemaQuery\Exceptions;

use Throwable;

class NotExistException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}