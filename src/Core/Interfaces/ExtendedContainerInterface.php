<?php

namespace App\Core\Interfaces;

interface ExtendedContainerInterface
{
    public function bind(string $key, callable $function): void;

    public function add(string $key, object $object): void;
}