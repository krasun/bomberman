<?php

namespace Bomberman;

use Bomberman\FieldCellInitializationAlgorithm\BotInitializationAlgorithm;
use Bomberman\FieldCellInitializationAlgorithm\ChainInitializationAlgorithm;
use Bomberman\FieldCellInitializationAlgorithm\FireproofBlockInitializationAlgorithm;
use Bomberman\FieldCellInitializationAlgorithm\FlammableBlockInitializationAlgorithm;
use Bomberman\FieldCellInitializationAlgorithm\PlayerInitializationAlgorithm;
use Bomberman\FieldObject\Bot;
use Bomberman\FieldObject\Player;

/**
 * Responds for classical field initialization.
 */
class DefaultFieldFactory implements FieldFactoryInterface
{
    /**
     * Creates and returns classical field configuration.
     *
     * @return Field
     */
    public function create()
    {
        $rowCount = Field::DEFAULT_ROW_COUNT;
        $columnCount = Field::DEFAULT_COLUMN_COUNT;
        $restrictedRadius = 3;
        $playerStartPosition = new FieldPosition(0, 0);
        $player = new Player();
        $bots = [new Bot(), new Bot(), new Bot()];

        /** @var FieldPosition[] $botPositions */
        $botPositions = [
            new FieldPosition(0, $columnCount - 1),
            new FieldPosition($rowCount - 1, 0),
            new FieldPosition($rowCount - 1, $columnCount - 1),
        ];
        $botInitializationAlgorithms = [];
        for ($botIndex = 0; $botIndex < count($bots); $botIndex++) {
            $botPosition = $botPositions[$botIndex];
            $bot = $bots[$botIndex];
            $botInitializationAlgorithms[] = new BotInitializationAlgorithm($botPosition->getRowIndex(), $botPosition->getColumnIndex(), $bot);
        }

        return new Field(
            new ChainInitializationAlgorithm(
                array_merge(
                    [
                        new FireproofBlockInitializationAlgorithm(),
                        new FlammableBlockInitializationAlgorithm(
                            array_merge([$playerStartPosition], $botPositions),
                            $restrictedRadius
                        ),
                        new PlayerInitializationAlgorithm(
                            $playerStartPosition->getRowIndex(),
                            $playerStartPosition->getColumnIndex(),
                            $player
                        ),
                    ],
                    $botInitializationAlgorithms
                )
            )
        );
    }
}