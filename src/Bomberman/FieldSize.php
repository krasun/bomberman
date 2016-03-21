<?php

namespace Bomberman;

/**
 * Represents size.
 */
class FieldSize
{
    /**
     * @var int
     */
    private $rowCount;

    /**
     * @var int
     *
     */
    private $columnCount;

    /**
     * @param int $rowCount
     * @param int $columnCount
     */
    public function __construct($rowCount, $columnCount)
    {
        $this->rowCount = $rowCount;
        $this->columnCount = $columnCount;
    }

    /**
     * @return int
     */
    public function getRowCount()
    {
        return $this->rowCount;
    }

    /**
     * @return int
     */
    public function getColumnCount()
    {
        return $this->columnCount;
    }
}