<?php

namespace yonyon\EloquentSchemaQuery\Provider;

use Illuminate\Support\ServiceProvider;
use yonyon\EloquentSchemaQuery\EloquentSchemaQuery;

class EloquentSchemaQueryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('EloquentSchemaQuery', EloquentSchemaQuery::class);
    }
}