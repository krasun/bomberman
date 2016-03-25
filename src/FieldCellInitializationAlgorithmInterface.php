<?php

namespace Bomberman;

use Bomberman\FieldObject\AbstractFieldObject;

/**
 * Responsible for field cell initialization algorithm.
 */
interface FieldCellInitializationAlgorithmInterface
{
    /**
     * @param int $rowIndex
     * @param int $columnIndex
     *
     * @return AbstractFieldObject
     */
    public function initialize($rowIndex, $columnIndex);
}