<?php

namespace Bomberman\FieldTransition;

use Bomberman\Field;
use Bomberman\FieldCellInitializationAlgorithm\MoveObjectInitializationAlgorithm;
use Bomberman\FieldObject\Player;
use Bomberman\FieldTransitionInterface;

/**
 * Moves player down if it is possible.
 */
class MovePlayerDownTransition implements FieldTransitionInterface
{
    /**
     * {@inheritdoc}
     */
    public function canApplyTo(Field $field)
    {
        return $field->getCell(
            $field->findOneCellByObjectType(Player::class)->getPosition()->toDown()
        )->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Field $field)
    {
        $playerFieldCell = $field->findOneCellByObjectType(Player::class);

        return new Field(
            new MoveObjectInitializationAlgorithm($field, $playerFieldCell->getPosition(), $playerFieldCell->getPosition()->toDown()),
            $field->getRowCount(),
            $field->getColumnCount()
        );
    }
}