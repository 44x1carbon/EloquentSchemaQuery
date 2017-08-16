<?php

namespace yonyon\EloquentSchemaQuery\Exceptions;

use Throwable;

class TypeError extends \Exception
{
        public function __construct($key, $message = "", $code = 0, Throwable $previous = null)
        {
            $message = $key . ' arrow function ' . $message;
            parent::__construct($message, $code, $previous);
        }
}