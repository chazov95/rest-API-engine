<?php

interface RepositoryInterface
{
    public function create(ModelInterface $model): ModelInterface;
}