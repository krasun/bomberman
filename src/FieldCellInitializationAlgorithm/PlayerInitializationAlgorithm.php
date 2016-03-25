<?php

namespace Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldCellInitializationAlgorithmInterface;
use Bomberman\FieldObject\Player;

/**
 * Places player at specified position.
 */
class PlayerInitializationAlgorithm implements FieldCellInitializationAlgorithmInterface
{
    /**
     * @var int
     */
    private $targetRowIndex;

    /**
     * @var int
     */
    private $targetColumnIndex;

    /**
     * @var Player
     */
    private $player;

    /**
     * @param int $targetRowIndex
     * @param int $targetColumnIndex
     * @param Player $player
     */
    public function __construct($targetRowIndex, $targetColumnIndex, Player $player)
    {
        $this->targetRowIndex = $targetRowIndex;
        $this->targetColumnIndex = $targetColumnIndex;
        $this->player = $player;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize($rowIndex, $columnIndex)
    {
        return (($rowIndex == $this->targetRowIndex) && ($columnIndex == $this->targetColumnIndex))
            ? $this->player
            : null
        ;
    }
}