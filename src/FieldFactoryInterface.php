<?php

namespace Bomberman;

/**
 * Responsible for field construction and configuration.
 */
interface FieldFactoryInterface
{
    /**
     * @return Field
     */
    public function create();
}