<?php

namespace yonyon\EloquentSchemaQuery;

interface SchemaInterface
{
    function attrs();

    function nests();

    function hasAs();

    function functions();

    function isEmptySchema();
}