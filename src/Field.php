<?php

namespace Bomberman;

use Bomberman\FieldObject\AbstractFieldObject;
use Bomberman\FieldObject\Bot;
use Bomberman\FieldObject\Player;
use Ramsey\Uuid\Uuid;

/**
 * Represents game field with different field objects.
 */
class Field implements \JsonSerializable
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
     * Unique field identifier.
     *
     * @var string
     */
    private $id;

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
     * @var Player
     */
    private $player;

    /**
     * @var Bot[]
     */
    private $bots;

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

        $this->id = Uuid::uuid4();
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
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $rowIndex
     * @param int $columnIndex
     *
     * @return AbstractFieldObject|null
     */
    public function getObjectAt($rowIndex, $columnIndex)
    {
        if ($rowIndex < 0 || $rowIndex >= $this->getRowCount()) {
            throw new \InvalidArgumentException('Row index is out of range');
        }

        if ($columnIndex < 0 || $columnIndex  >= $this->getColumnCount()) {
            throw new \InvalidArgumentException('Column index is out of range');
        }

        /** @var FieldCell $fieldCell */
        $fieldCell = $this->cells[$rowIndex][$columnIndex];

        return $fieldCell->getFieldObject();
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

    /**
     * @return array
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'cells' => $this->getCells(),
        ];
    }
}