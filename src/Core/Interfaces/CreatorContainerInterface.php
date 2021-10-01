<?php

namespace App\Core\Interfaces;

interface CreatorContainerInterface
{
    public function bindCreator(string $key, callable $function): void;
}