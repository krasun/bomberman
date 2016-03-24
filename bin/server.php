<?php

use Bomberman\Application;
use Bomberman\Command\Handler\InitializeFieldHandler;
use Bomberman\Command\InitializeFieldCommand;
use Bomberman\DefaultFieldFactory;
use League\Tactician\Setup\QuickStart;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require_once __DIR__.'/../vendor/autoload.php';

$commandBus = QuickStart::create([
    InitializeFieldCommand::class => new InitializeFieldHandler(new DefaultFieldFactory()),
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
