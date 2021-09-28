<?php

namespace App\Core\Orm;

use App\Core\Interfaces\BuilderInterface;

class QueryBuilder implements BuilderInterface
{
    public const INSERT_METHOD = 'insert';
    public const UPDATE_METHOD = 'update';
    public const DELETE_METHOD = 'delete';
    public const SELECT_METHOD  = 'select';

    public function setTable(string $getTable)
    {
    }

    public function build(): BuilderInterface
    {
        // TODO: Implement build() method.
    }

    public function reset(): BuilderInterface
    {
        // TODO: Implement reset() method.
    }

    public function getResult(): mixed
    {
        // TODO: Implement getResult() method.
    }
}