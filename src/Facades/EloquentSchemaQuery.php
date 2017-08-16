<?php

namespace yonyon\EloquentSchemaQuery\Facades;

use Illuminate\Support\Facades\Facade;

class EloquentSchemaQuery extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'EloquentSchemaQuery';
    }
}