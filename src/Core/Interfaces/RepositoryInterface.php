<?php

namespace App\Core\Interfaces;

interface RepositoryInterface
{
    public function create(ModelInterface $model): ModelInterface;
    public function read(int $modelId): ModelInterface;
    public function update(ModelInterface $model): ModelInterface;
    public function delete(int $modelId): bool;
}