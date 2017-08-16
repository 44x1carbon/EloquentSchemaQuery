<?php

namespace yonyon\EloquentSchemaQuery;

class Schema implements SchemaInterface
{
    use SchemaTrait;

    function __construct(array $schema = [], $as = null)
    {
        if(is_string($as) && is_null($as)) throw new \Exception('$as type is not string or null');
        $this->schema = $schema;
        $this->as = $as;
    }
}