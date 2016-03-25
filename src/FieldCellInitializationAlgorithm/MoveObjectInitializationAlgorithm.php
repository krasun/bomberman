<?php

namespace Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\Field;
use Bomberman\FieldCellInitializationAlgorithmInterface;
use Bomberman\FieldPosition;

/**
 * Responsible for field initialization based on specified field with object move.
 */
class MoveObjectInitializationAlgorithm implements FieldCellInitializationAlgorithmInterface
{
    /**
     * @var Field
     */
    private $field;

    /**
     * @var FieldPosition
     */
    private $sourcePosition;

    /**
     * @var FieldPosition
     */
    private $targetPosition;

    /**
     * @param Field $field
     * @param FieldPosition $sourcePosition
     * @param FieldPosition $targetPosition
     */
    public function __construct(Field $field, FieldPosition $sourcePosition, FieldPosition $targetPosition)
    {
        $this->field = $field;
        $this->sourcePosition = $sourcePosition;
        $this->targetPosition = $targetPosition;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize($rowIndex, $columnIndex)
    {
        $position = new FieldPosition($rowIndex, $columnIndex);

        if ($position->equals($this->sourcePosition)) {
            return null;
        }

        if ($position->equals($this->targetPosition)) {
            return $this->field->getObjectAt($this->sourcePosition->getRowIndex(), $this->sourcePosition->getColumnIndex());
        }

        return $this->field->getObjectAt($rowIndex, $columnIndex);
    }
}