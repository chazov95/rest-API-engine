<?php

namespace App\Core\Abstractions;

use App\Core\Interfaces\ControllerInterface;
use App\Core\Interfaces\Psr\LoggerInterface;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @var \App\Core\Interfaces\Psr\LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}