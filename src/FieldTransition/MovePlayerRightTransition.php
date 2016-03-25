<?php

namespace Bomberman\FieldTransition;

use Bomberman\Field;
use Bomberman\FieldCellInitializationAlgorithm\MoveObjectInitializationAlgorithm;
use Bomberman\FieldObject\Player;
use Bomberman\FieldTransitionInterface;

/**
 * Moves player right if it is possible.
 */
class MovePlayerRightTransition implements FieldTransitionInterface
{
    /**
     * {@inheritdoc}
     */
    public function canApplyTo(Field $field)
    {
        return $field->getCell(
            $field->findOneCellByObjectType(Player::class)->getPosition()->toRight()
        )->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Field $field)
    {
        $playerFieldCell = $field->findOneCellByObjectType(Player::class);

        return new Field(
            new MoveObjectInitializationAlgorithm(
                $field,
                $playerFieldCell->getPosition(),
                $playerFieldCell->getPosition()->toRight()
            ),
            $field->getRowCount(),
            $field->getColumnCount()
        );
    }
}