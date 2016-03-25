<?php

namespace Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldCellInitializationAlgorithmInterface;
use Bomberman\FieldObject\FlammableBlock;
use Bomberman\FieldPosition;
use Bomberman\RandomBooleanAnswerer;

/**
 * Initializes cells with flammable blocks.
 */
class FlammableBlockInitializationAlgorithm implements FieldCellInitializationAlgorithmInterface
{
    /**
     * @var FieldPosition[]
     */
    private $restrictedPositions;

    /**
     * @var int
     */
    private $restrictedRadius;

    /**
     * @var RandomBooleanAnswerer
     */
    private $randomNumberGenerator;

    /**
     * @param FieldPosition[] $restrictedPositions
     * @param int $restrictedRadius
     * @param RandomBooleanAnswerer|null $randomNumberGenerator
     */
    public function __construct($restrictedPositions, $restrictedRadius, RandomBooleanAnswerer $randomNumberGenerator = null)
    {
        $this->restrictedPositions = $restrictedPositions;
        $this->restrictedRadius = $restrictedRadius;
        $this->randomNumberGenerator = $randomNumberGenerator ?: new RandomBooleanAnswerer();
    }

    /**
     * {@inheritdoc}
     */
    public function initialize($rowIndex, $columnIndex)
    {
        foreach ($this->restrictedPositions as $restrictedPosition) {
            $rowIndexInRestrictedArea = (
                ($restrictedPosition->getRowIndex() - $this->restrictedRadius) < $rowIndex
                && $rowIndex < ($restrictedPosition->getRowIndex() + $this->restrictedRadius)
            );
            $columnIndexIndexInRestrictedArea = (
                ($restrictedPosition->getColumnIndex() - $this->restrictedRadius) < $columnIndex
                && $columnIndex < ($restrictedPosition->getColumnIndex() + $this->restrictedRadius)
            );

            if ($rowIndexInRestrictedArea && $columnIndexIndexInRestrictedArea) {
                return null;
            }
        }

        return ($this->randomNumberGenerator->generate())
            ? new FlammableBlock()
            : null;
    }
}