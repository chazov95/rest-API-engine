<?php

namespace App\Core\Orm;

class Query
{
    private string $query;

    public function execute()
    {
    }

    /**
     * @param string $query
     *
     * @return Query
     */
    public function setQuery(string $query): Query
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
}