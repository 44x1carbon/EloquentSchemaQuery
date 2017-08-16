<?php

namespace yonyon\EloquentSchemaQuery;

trait SchemaTrait
{
    public $schema;
    public $as;

    function attrs()
    {
        return array_filter($this->schema, function($v, $k) {
            return is_numeric($k);
        }, ARRAY_FILTER_USE_BOTH);
    }

    function nests()
    {
        return array_filter($this->schema, function($v, $k) {
            return $v instanceof Schema;
        }, ARRAY_FILTER_USE_BOTH);
    }

    function functions()
    {
        return array_filter($this->schema, function($v, $k) {
            return $v instanceof FunctionSchema;
        }, ARRAY_FILTER_USE_BOTH);
    }

    function hasAs(): bool
    {
        return !is_null($this->as);
    }

    function isEmptySchema(){
        return count($this->schema) == 0;
    }
}