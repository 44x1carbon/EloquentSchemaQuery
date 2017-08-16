<?php

namespace yonyon\EloquentSchemaQuery;

class FunctionSchema implements SchemaInterface
{
    use SchemaTrait;
    private $func;

    function __construct(callable $func, Schema $schema = null, $as = null)
    {        
        $this->func = $func;
        $this->schema = is_null($schema)? new Schema([]) : $schema;
        $this->as = $as;
        if($this->checkAsType()) throw new \Exception('$as type is not string or null');
    }

    function exec($data)
    {
        $func = $this->func;
        return $func($data);
    }
}