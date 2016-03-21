<?php

namespace Bomberman;

use Bomberman\FieldObject\FieldObject;

/**
 * Responsible for field cell initialization algorithm.
 */
interface FieldCellInitializationAlgorithmInterface
{
    /**
     * @param int $rowIndex
     * @param int $columnIndex
     *
     * @return FieldObject
     */
    public function initialize($rowIndex, $columnIndex);
}