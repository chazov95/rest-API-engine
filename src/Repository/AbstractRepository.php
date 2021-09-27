<?php

namespace App\Component\Repository;

use App\Core\Orm\QueryBuilder;
use ModelInterface;
use RepositoryInterface;

class AbstractRepository implements RepositoryInterface
{
    /**
     * @param \App\Core\Orm\QueryBuilder $queryBuilder
     */
    public function __construct(
        public QueryBuilder $queryBuilder
    ) {}

    public function create(ModelInterface $model): ModelInterface
    {
        // TODO: Implement create() method.
    }

    public function read(int $modelId): ModelInterface
    {
        // TODO: Implement read() method.
    }

    public function update(ModelInterface $model): ModelInterface
    {
        // TODO: Implement update() method.
    }

    public function delete(int $modelId): bool
    {
        // TODO: Implement delete() method.
    }
}