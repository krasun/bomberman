<?php

namespace Bomberman;

use Bomberman\FieldObject\FieldObject;

/**
 * Represents game field with different field objects.
 */
class Field
{
    /**
     * Row count in classical game implementation.
     */
    const DEFAULT_ROW_COUNT = 11;

    /**
     * Column count in classical game implementation.
     */
    const DEFAULT_COLUMN_COUNT = 13;

    /**
     * Two-dimensional array with field objects. Empty cell represented with null.
     *
     * @var array
     */
    private $cells = [];

    /**
     * @var int
     */
    private $rowCount = self::DEFAULT_ROW_COUNT;

    /**
     * @var int
     */
    private $columnCount = self::DEFAULT_COLUMN_COUNT;

    /**
     * @param FieldCellInitializationAlgorithmInterface|null $fieldCellInitializationAlgorithm
     * @param int $rowCount
     * @param int $columnCount
     */
    public function __construct(
        FieldCellInitializationAlgorithmInterface $fieldCellInitializationAlgorithm = null,
        $rowCount = self::DEFAULT_ROW_COUNT,
        $columnCount = self::DEFAULT_COLUMN_COUNT
    )
    {
        $this->rowCount = $rowCount;
        $this->columnCount = $columnCount;

        for ($rowIndex = 0; $rowIndex < $this->rowCount; $rowIndex++) {
            $this->cells[$rowIndex] = [];
            for ($columnIndex = 0; $columnIndex < $this->columnCount; $columnIndex++) {
                $fieldObject = $fieldCellInitializationAlgorithm
                    ? $fieldCellInitializationAlgorithm->initialize($rowIndex, $columnIndex)
                    : null
                ;
                $this->cells[$rowIndex][$columnIndex] = new FieldCell($this, $rowIndex, $columnIndex, $fieldObject);
            }
        }

    }

    /**
     * @param int $rowIndex
     * @param int $columnIndex
     *
     * @return FieldObject|null
     */
    public function getObjectAt($rowIndex, $columnIndex)
    {
        if ($rowIndex < 0 || $rowIndex >= $this->getRowCount()) {
            throw new \InvalidArgumentException('Row index is out of range');
        }

        if ($columnIndex < 0 || $columnIndex  >= $this->getColumnCount()) {
            throw new \InvalidArgumentException('Column index is out of range');
        }

        return $this->cells[$rowIndex][$columnIndex]->getFieldObject();
    }

    /**
     * @return int
     */
    public function getColumnCount()
    {
        return $this->columnCount;
    }

    /**
     * @return int
     */
    public function getRowCount()
    {
        return $this->rowCount;
    }

    /** @deprecated */
    public function getCells()
    {
        return $this->cells;
    }
}