<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

require_once __DIR__.'/../vendor/autoload.php';

$rowCount = \Bomberman\Field::DEFAULT_ROW_COUNT;
$columnCount = \Bomberman\Field::DEFAULT_COLUMN_COUNT;
$restrictedRadius = 3;
$playerStartPosition = new \Bomberman\FieldPosition(0, 0);
$botPositions = [
    new \Bomberman\FieldPosition(0, $columnCount - 1),
    new \Bomberman\FieldPosition($rowCount - 1, 0),
    new \Bomberman\FieldPosition($rowCount - 1, $columnCount - 1),
];

$botInitializationAlgorithms = array_map(function (\Bomberman\FieldPosition $botPosition) {
    return new \Bomberman\FieldCellInitializationAlgorithm\BotInitializationAlgorithm(
        $botPosition->getRowIndex(),
        $botPosition->getColumnIndex(),
        new \Bomberman\FieldObject\Bot()
    );
}, $botPositions);

$field = new \Bomberman\Field(
    new \Bomberman\FieldCellInitializationAlgorithm\ChainInitializationAlgorithm(
        array_merge(
            [
                new \Bomberman\FieldCellInitializationAlgorithm\FireproofBlockInitializationAlgorithm(),
                new \Bomberman\FieldCellInitializationAlgorithm\FlammableBlockInitializationAlgorithm(
                    array_merge([$playerStartPosition], $botPositions),
                    $restrictedRadius
                ),
                new \Bomberman\FieldCellInitializationAlgorithm\PlayerInitializationAlgorithm(
                    $playerStartPosition->getRowIndex(),
                    $playerStartPosition->getColumnIndex(),
                    new \Bomberman\FieldObject\Player()
                ),
            ],
            $botInitializationAlgorithms
        )
    )
);

// http://php.net/manual/en/class.iterator.php
var_dump($field);

//
//$server = IoServer::factory(
//    new HttpServer(
//        new WsServer(
//            new Chat()
//        )
//    ),
//    8080
//);
//
//$server->run();
