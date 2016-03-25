<?php

namespace Bomberman;

use Bomberman\FieldObject\AbstractFieldObject;

/**
 * Represents field cell with field object.
 */
class FieldCell implements \JsonSerializable
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
     * @var AbstractFieldObject|null
     */
    private $fieldObject;

    /**
     * @param Field $field
     * @param int $rowIndex
     * @param int $columnIndex
     * @param AbstractFieldObject|null $fieldObject
     */
    public function __construct(Field $field, $rowIndex, $columnIndex, AbstractFieldObject $fieldObject = null)
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
     * @return AbstractFieldObject
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

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'rowIndex' => $this->getRowIndex(),
            'columnIndex' => $this->getColumnIndex(),
            'fieldObject' => $this->getFieldObject()
        ];
    }
}