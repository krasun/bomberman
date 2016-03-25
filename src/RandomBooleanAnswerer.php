<?php

namespace Bomberman;

/**
 * Responds for random boolean answer generation.
 */
class RandomBooleanAnswerer
{
    /**
     * Generates random boolean answer.
     *
     * @return bool
     */
    public function generate()
    {
        return mt_rand(0, 1) == 1;
    }
}