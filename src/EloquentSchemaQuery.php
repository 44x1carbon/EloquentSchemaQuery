<?php

namespace yonyon\EloquentSchemaQuery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use yonyon\EloquentSchemaQuery\Exceptions\TypeError;

class EloquentSchemaQuery
{
    public function get($data, Schema $schema)
    {
        if($data instanceof Model) {
            return $this->mappingModel($data, $schema);
        } else if($data instanceof Collection) {
            return $this->mappingCollection($data, $schema);
        } else {
            throw new \Exception('$data type is not Model or Collection');
        }
    }

    private function mappingModel(Model $model, Schema $schema)
    {
        $result = [];
        foreach ($schema->attrs() as $key) {
            if($this->has($key, $model)) {
                $result[$key] = $model->{$key};
            } else {
                throw new \Exception(class_basename($model) . ' do not have ' . $key);
            }
        }

        foreach ($schema->nests() as $key => $_schema) {
            if($_schema->isEmptySchema()) throw new \Exception($key . ' arrow schema empty');            
            $_data = $model->{$key};
            $key = $_schema->hasAs() ? $_schema->as : $key;
            $result[$key] = $this->get($_data, $_schema);            
        }

        foreach ($schema->functions() as $key => $functionSchema)
        {
            try {
                $_data = $functionSchema->exec($model);
            } catch (\TypeError $exception) {
                throw new TypeError($key, $exception->getMessage());
            }
            $key = $functionSchema->hasAs()? $functionSchema->as : $key;
            $_schema = $functionSchema->schema;
            if($_data instanceof Model) {
                if($_schema->isEmptySchema()) throw new \Exception($key . ' arrow schema empty');
                $result[$key] = $this->mappingModel($_data, $_schema);
            } else if($_data instanceof Collection) {
                if($_schema->isEmptySchema()) throw new \Exception($key . ' arrow schema empty');
                $result[$key] = $this->mappingCollection($_data, $_schema);
            } else {
                $result[$key] = $_data;
            }
        }

        return $result;
    }

    private function mappingCollection(Collection $collection, Schema $schema)
    {
        $result = [];
        foreach ($collection as $model) {
            if(!$model instanceof Model) throw new \Exception('collection item is not ' . Model::class);
            $result[] = $this->mappingModel($model, $schema);
        }

        return $result;
    }

    private function has($key, Model $model)
    {
        return $model->hasGetMutator($key)
            || !is_null($model->getAttributeValue($key));            
    }
}