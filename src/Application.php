<?php

namespace Bomberman;

use Bomberman\Command\InitializeFieldCommand;
use Bomberman\FieldRepository\FieldRepository;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
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
            if (isset($commandData->data)) {
                foreach ($commandData->data as $key => $value) {
                    $command->$key = $value;
                }
            }

            var_dump($command);

            $field = $this->commandBus->handle($command);

            if ($field) {
                $this->clients[$connection] = $field;
             } else {
                $field = $this->clients[$connection];
            }

            $connection->send(json_encode($field));
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