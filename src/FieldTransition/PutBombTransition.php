<?php

namespace Bomberman\FieldTransition;

use Bomberman\Field;
use Bomberman\FieldCellInitializationAlgorithm\MoveObjectInitializationAlgorithm;
use Bomberman\FieldObject\Player;
use Bomberman\FieldTransitionInterface;

/**
 * Puts bomb if it is possible.
 */
class PutBombTransition implements FieldTransitionInterface
{
    /**
     * {@inheritdoc}
     */
    public function canApplyTo(Field $field)
    {
        try {
            return $field->getCell(
                $field->findOneCellByObjectType(Player::class)->getPosition()
            )->isEmpty();
        } catch (\InvalidArgumentException $e) {
            return false;
        }
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
                $playerFieldCell->getPosition()->toDown()
            ),
            $field->getRowCount(),
            $field->getColumnCount()
        );
    }
}