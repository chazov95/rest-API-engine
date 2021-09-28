<?php

namespace App\Component\Repository;

use App\Constants;
use App\Core\Interfaces\RepositoryInterface;
use App\Core\Orm\QueryBuilder;
use ModelInterface;

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
        /*$this->queryBuilder->setIsTransaction(true);

        $subQueries =[];

        while ($submodel = $model->getSubmodel) {
            $subQueries[] = QueryBuilder::simpleQueryFactory(
                QueryBuilder::INSERT_METHOD,
                $submodel->getTable(),
                $model->getSimpleFields
            );
        }

        $this->queryBuilder->setTransaction(true)->setSubQueries($subQueries);

        $this->getModels($this->submodels($model));



        return $this->queryBuilder
            ->setTable($model->getTable)
            ->setAction(QueryBuilder::INSERT_METHOD)
            ->setFields($this->clearModel(Serializer::toArray($model, false)))
            ->build()
            ->execute()
            ->getResult();*/
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

    /**
     * очищает массив от подмоделей
     *
     * @param $toArray
     */
    private function clearModel($toArray)
    {
    }
}