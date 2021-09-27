<?php
/**
 * PHP version 8.0
 *
 * @package  App\Core\Interfaces
 */

namespace App\Core\Interfaces;

/**
 * Interface BuilderInterface
 *
 * @package App\Core\Interfaces
 */
interface BuilderInterface
{
    /**
     * Builds result
     *
     * @return \App\Core\Interfaces\BuilderInterface
     * @throws \App\Core\Interfaces\Exception\BuilderException
     */
    public function build(): BuilderInterface;

    /**
     * Resets builder
     *
     * @return \App\Core\Interfaces\BuilderInterface
     */
    public function reset(): BuilderInterface;

    /**
     * Returns builder result
     *
     * @return mixed
     */
    public function getResult(): mixed;
}
