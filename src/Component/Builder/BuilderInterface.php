<?php
/**
 * PHP version 7.1
 *
 * @category Integration
 * @package  Intaro\Component\Builder
 */

namespace Component\Builder;

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
     * @return \Component\Builder\BuilderInterface
     * @throws \Component\Builder\Exception\BuilderException
     */
    public function build(): BuilderInterface;

    /**
     * Resets builder
     *
     * @return \Component\Builder\BuilderInterface
     */
    public function reset(): BuilderInterface;

    /**
     * Returns builder result
     *
     * @return mixed
     */
    public function getResult();
}
