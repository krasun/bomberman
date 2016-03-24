<?php

namespace Bomberman;

use League\Tactician\CommandBus;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

/**
 * Application facade.
 */
class Application implements MessageComponentInterface
{
    /**
     * @var \SplObjectStorage
     */
    protected $clients;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * Constructor.
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->clients = new \SplObjectStorage();
        $this->commandBus = $commandBus;
    }

    /**
     * @param ConnectionInterface $connection
     */
    public function onOpen(ConnectionInterface $connection)
    {
        $this->clients->attach($connection);
    }

    /**
     * @param ConnectionInterface $connection
     * @param string $message
     */
    public function onMessage(ConnectionInterface $connection, $message)
    {
        try {
            $commandData = json_decode($message);
            $commandClass = 'Bomberman\\Command\\'.ucfirst($commandData->name).'Command';

            $command = new $commandClass();
            if (isset($command->data)) {
                foreach ($commandData->data as $key => $value) {
                    $command->$key = $value;
                }
            }

            // @todo validation/checks etc.

            $result = $this->commandBus->handle($command);

            $connection->send(json_encode($result));
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    /**
     * @param ConnectionInterface $connection
     */
    public function onClose(ConnectionInterface $connection)
    {
        $this->clients->detach($connection);
    }

    /**
     * @param ConnectionInterface $connection
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        $connection->close();
    }
}