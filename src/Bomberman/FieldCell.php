<?php

namespace Bomberman;

use Bomberman\FieldObject\FieldObject;

/**
 * Represents field cell with field object.
 */
class FieldCell
{
    /**
     * @var Field
     */
    private $field;

    /**
     * @var int
     */
    private $rowIndex;

    /**
     * @var int
     */
    private $columnIndex;

    /**
     * @var FieldObject|null
     */
    private $fieldObject;

    /**
     * @param Field $field
     * @param int $rowIndex
     * @param int $columnIndex
     * @param FieldObject|null $fieldObject
     */
    public function __construct(Field $field, $rowIndex, $columnIndex, FieldObject $fieldObject = null)
    {
        if ($rowIndex < 0 || $rowIndex >= $field->getRowCount()) {
            throw new \InvalidArgumentException('Row index is out of range');
        }

        if ($columnIndex < 0 || $columnIndex  >= $field->getColumnCount()) {
            throw new \InvalidArgumentException('Column index is out of range');
        }

        $this->field = $field;
        $this->rowIndex = $rowIndex;
        $this->columnIndex = $columnIndex;
        $this->fieldObject = $fieldObject;
    }

    /**
     * @return Field
     */
    public function getField()
    {
        return $this->field;
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
     * @return FieldObject
     */
    public function getFieldObject()
    {
        return $this->fieldObject;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return (null == $this->getFieldObject());
    }
}