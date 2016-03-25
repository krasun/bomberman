<?php

use Bomberman\Application;
use Bomberman\Command\Handler\InitializeFieldHandler;
use Bomberman\Command\Handler\MoveDownHandler;
use Bomberman\Command\Handler\MoveLeftHandler;
use Bomberman\Command\Handler\MoveRightHandler;
use Bomberman\Command\Handler\MoveUpHandler;
use Bomberman\Command\Handler\PutBombHandler;
use Bomberman\Command\InitializeFieldCommand;
use Bomberman\Command\MoveDownCommand;
use Bomberman\Command\MoveLeftCommand;
use Bomberman\Command\MoveRightCommand;
use Bomberman\Command\MoveUpCommand;
use Bomberman\Command\PutBombCommand;
use Bomberman\DefaultFieldFactory;
use Bomberman\FieldRepository\FieldRepository;
use Doctrine\Common\Cache\ArrayCache;
use League\Tactician\Setup\QuickStart;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require_once __DIR__.'/../vendor/autoload.php';

$fieldRepository = new FieldRepository(new ArrayCache());

$commandBus = QuickStart::create([
    InitializeFieldCommand::class => new InitializeFieldHandler(
        new DefaultFieldFactory(),
        $fieldRepository
    ),
    MoveLeftCommand::class => new MoveLeftHandler($fieldRepository),
    MoveUpCommand::class => new MoveUpHandler($fieldRepository),
    MoveRightCommand::class => new MoveRightHandler($fieldRepository),
    MoveDownCommand::class => new MoveDownHandler($fieldRepository),
    PutBombCommand::class => new PutBombHandler()
]);

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Application($commandBus)
        )
    ),
    8080
);

$server->run();
