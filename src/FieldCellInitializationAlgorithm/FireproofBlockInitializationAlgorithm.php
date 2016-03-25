<?php

namespace Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldCellInitializationAlgorithmInterface;
use Bomberman\FieldObject\FireproofBlock;

/**
 * Simple abstraction for using closures for algorithm description.
 */
class FireproofBlockInitializationAlgorithm implements FieldCellInitializationAlgorithmInterface
{
    /**
     * {@inheritdoc}
     */
    public function initialize($rowIndex, $columnIndex)
    {
        return (($rowIndex % 2 !== 0) && ($columnIndex % 2 !== 0))
            ? new FireproofBlock()
            : null
        ;
    }
}