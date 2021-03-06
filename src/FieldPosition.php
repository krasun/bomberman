<?php

namespace Bomberman;

/**
 * Represents field position.
 */
class FieldPosition
{
    /**
     * @var int
     */
    private $rowIndex;

    /**
     * @var int
     */
    private $columnIndex;

    /**
     * @param int $rowIndex
     * @param int $columnIndex
     */
    public function __construct($rowIndex, $columnIndex)
    {
        $this->rowIndex = $rowIndex;
        $this->columnIndex = $columnIndex;
    }

    /**
     * @return int
     */
    public function getRowIndex()
    {
        return $this->rowIndex;
    }

    /**
     * @return int
     */
    public function getColumnIndex()
    {
        return $this->columnIndex;
    }

    /**
     * @return FieldPosition
     */
    public function toUp()
    {
        return new FieldPosition($this->getRowIndex() - 1, $this->getColumnIndex());
    }

    /**
     * @return FieldPosition
     */
    public function toDown()
    {
        return new FieldPosition($this->getRowIndex() + 1, $this->getColumnIndex());
    }

    /**
     * @return FieldPosition
     */
    public function toLeft()
    {
        return new FieldPosition($this->getRowIndex(), $this->getColumnIndex() - 1);
    }

    /**
     * @return FieldPosition
     */
    public function toRight()
    {
        return new FieldPosition($this->getRowIndex(), $this->getColumnIndex() + 1);
    }

    /**
     * @param FieldPosition $another
     *
     * @return bool
     */
    public function equals(FieldPosition $another)
    {
        return (($this->getRowIndex() == $another->getRowIndex()) && ($this->getColumnIndex() == $another->getColumnIndex()));
    }
}