<?php

namespace Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldCellInitializationAlgorithmInterface;
use Bomberman\FieldObject\Bot;

/**
 * Places bot at specified position.
 */
class BotInitializationAlgorithm implements FieldCellInitializationAlgorithmInterface
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
     * @var Bot
     */
    private $bot;

    /**
     * @param int $targetRowIndex
     * @param int $targetColumnIndex
     * @param Bot $bot
     */
    public function __construct($targetRowIndex, $targetColumnIndex, Bot $bot)
    {
        $this->targetRowIndex = $targetRowIndex;
        $this->targetColumnIndex = $targetColumnIndex;
        $this->bot = $bot;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize($rowIndex, $columnIndex)
    {
        return (($rowIndex == $this->targetRowIndex) && ($columnIndex == $this->targetColumnIndex))
            ? $this->bot
            : null;
    }
}