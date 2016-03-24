<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\InitializeFieldCommand;
use Bomberman\FieldFactoryInterface;
use Bomberman\Field;

/**
 * Initializes and returns field.
 */
class InitializeFieldHandler
{
    /**
     * @var FieldFactoryInterface
     */
    private $fieldFactory;

    /**
     * @param FieldFactoryInterface $fieldFactory
     */
    public function __construct(FieldFactoryInterface $fieldFactory)
    {
        $this->fieldFactory = $fieldFactory;
    }

    /**
     * @param InitializeFieldCommand $command
     *
     * @return Field
     */
    public function handle(InitializeFieldCommand $command)
    {
        $field = $this->fieldFactory->create();

        return $field;
    }
}