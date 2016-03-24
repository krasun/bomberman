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

        /** @var FieldPosition[] $botPositions */
        $botConfigurations = [
            [new Bot(), new FieldPosition(0, $columnCount - 1)],
            [new Bot(), new FieldPosition($rowCount - 1, 0)],
            [new Bot(), new FieldPosition($rowCount - 1, $columnCount - 1)],
        ];
        $botInitializationAlgorithms = array_map(function ($botConfiguration) {
            /** @var Bot $bot */
            /** @var FieldPosition $botPosition */
            list($bot, $botPosition) = $botConfiguration;

            return new BotInitializationAlgorithm($botPosition->getRowIndex(), $botPosition->getColumnIndex(), $bot);
        }, $botConfigurations);

        return new Field(
            new ChainInitializationAlgorithm(
                array_merge(
                    [
                        new FireproofBlockInitializationAlgorithm(),
                        new PlayerInitializationAlgorithm(
                            $playerStartPosition->getRowIndex(),
                            $playerStartPosition->getColumnIndex(),
                            $player
                        ),
                    ],
                    $botInitializationAlgorithms,
                    [
                        new FlammableBlockInitializationAlgorithm(
                            array_merge([$playerStartPosition], array_map(function ($botConfiguration) {
                                /** @var Bot $bot */
                                /** @var FieldPosition $botPosition */
                                list($bot, $botPosition) = $botConfiguration;

                                return $botPosition;
                            }, $botConfigurations)),
                            $restrictedRadius
                        ),
                    ]
                )
            )
        );
    }
}