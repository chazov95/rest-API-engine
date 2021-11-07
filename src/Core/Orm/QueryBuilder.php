<?php

namespace App\Core\Orm;

use App\Core\Interfaces\BuilderInterface;

class QueryBuilder implements BuilderInterface
{
    public const INSERT_METHOD    = 'insert';
    public const UPDATE_METHOD    = 'update';
    public const DELETE_METHOD    = 'delete';
    public const SELECT_METHOD    = 'select';
    public const FULL_OUTER_JOIN  = 'FULL OUTER JOIN';
    public const INNER_JOIN       = 'INNER JOIN';
    public const RIGHT_OUTER_JOIN = 'RIGHT OUTER JOIN';
    public const LEFT_OUTER_JOIN  = 'LEFT OUTER JOIN';

    private ?Query $query;
    private string $method;
    private string $tableName;
    private array  $orderBy        = [];
    private array  $where          = [];
    private array  $select         = [];
    private array  $whereIsNull    = [];
    private array  $whereIsNotNull = [];
    private array  $groupBy        = [];
    private bool   $distinctStatus = false;
    private array  $likesWhere     = [];
    private array  $whereIn        = [];
    private array  $whereNotIn     = [];
    private string $condition      = '';
    private array  $insertValues   = [];

    public function setTable(string $tableName): static
    {
        $this->tableName = $tableName;

        return $this;
    }

    public function setLike(string $columnName, string $pattern): static
    {
        $this->likesWhere[$columnName] = $pattern;

        return $this;
    }

    public function setHaving(string $condition): static
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @throws \App\Core\Orm\QueryBuilderException
     */
    public function build(): QueryBuilder
    {
        $queryBody = match ($this->method) {
            self::DELETE_METHOD => $this->buildDeleteQuery(),
            self::INSERT_METHOD => $this->buildInsertQuery(),
            self::SELECT_METHOD => $this->buildSelectQuery(),
            self::UPDATE_METHOD => $this->buildUpdateQuery(),
            default => throw new QueryBuilderException('Can not build query for DB. Unknown method.'),
        };

        $this->query = (new Query())->setQuery($queryBody);

        return $this;
    }

    public function reset(): BuilderInterface
    {
        $this->query = null;

        return $this;
    }

    public function getResult(): Query
    {
        $query = $this->query;

        $this->reset();

        return $query;
    }

    public function setMethod(string $method): static
    {
        $this->method = $method;

        return $this;
    }

    public function setJoin(string $joinType, string $tableName, array $condition): static
    {

        return $this;
    }

    public function setOrderBy(string $field, string $by): static
    {
        $this->orderBy[$field] = $by;

        return $this;
    }

    public function setDistinct(bool $distinctStatus): static
    {
        $this->distinctStatus = $distinctStatus;

        return $this;
    }

    public function setWhere(string $column1, string $sign, string $column2): static
    {
        $this->where[] = [$column1, $sign, $column2];

        return $this;
    }

    public function setSelect(array $newSelects): static
    {
        $this->select = array_merge($this->select, $newSelects);

        return $this;
    }

    public function setWhereIsNull(string $columnName): static
    {
        $this->whereIsNull[] = $columnName;

        return $this;
    }

    public function setWhereIsNotNull(string $columnName): static
    {
        $this->whereIsNotNull[] = $columnName;

        return $this;
    }

    public function setGroupBy(string $groupBy): static
    {
        $this->groupBy[] = $groupBy;

        return $this;
    }

    public function setWhereIn(string $columnName, array $values): static
    {
        $this->whereIn[$columnName] = $values;

        return $this;
    }

    public function setInsertValue(array $values): static
    {
        $this->insertValues[] = $values;

        return $this;
    }

    public function setWhereNotIn(string $columnName, array $values): static
    {
        $this->whereNotIn[$columnName] = $values;

        return $this;
    }

    public function setLimit(int $limit): static
    {
        return $this;
    }

    private function buildDeleteQuery(): string
    {
        $queryParts = [
            sprintf('DELETE FROM %s', $this->tableName),
            $this->addWhere()
        ];

        return implode(' ', $queryParts) . ';';
    }

    private function buildInsertQuery(): string
    {
    }

    private function buildSelectQuery(): string
    {
    }

    private function buildUpdateQuery(): string
    {
    }
}