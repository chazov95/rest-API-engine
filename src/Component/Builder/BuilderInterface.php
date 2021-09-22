<?php
/**
 * PHP version 7.1
 *
 * @category Integration
 * @package  Intaro\Component\Builder
 */

namespace Intaro\Component\Builder;

/**
 * Interface BuilderInterface
 *
 * @package Intaro\Component\Builder
 */
interface BuilderInterface
{
    /**
     * Builds result
     *
     * @return \Intaro\Component\Builder\BuilderInterface
     * @throws \Intaro\Component\Builder\Exception\BuilderException
     */
    public function build(): BuilderInterface;

    /**
     * Resets builder
     *
     * @return \Intaro\Component\Builder\BuilderInterface
     */
    public function reset(): BuilderInterface;

    /**
     * Returns builder result
     *
     * @return mixed
     */
    public function getResult();
}
