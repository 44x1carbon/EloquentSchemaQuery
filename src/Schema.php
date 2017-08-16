<?php

namespace yonyon\EloquentSchemaQuery;

class Schema implements SchemaInterface
{
    use SchemaTrait;

    function __construct(array $schema = [], $as = null)
    {
        $this->schema = $schema;
        $this->as = $as;
        if($this->checkAsType()) throw new \Exception('$as type is not string or null');
    }
}