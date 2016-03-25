<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\InitializeFieldCommand;
use Bomberman\FieldFactoryInterface;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;

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
     * @var FieldRepositoryInterface
     */
    private $fieldRepository;

    /**
     * @param FieldFactoryInterface $fieldFactory
     * @param FieldRepositoryInterface $fieldRepository
     */
    public function __construct(FieldFactoryInterface $fieldFactory, FieldRepositoryInterface $fieldRepository)
    {
        $this->fieldFactory = $fieldFactory;
        $this->fieldRepository = $fieldRepository;
    }

    /**
     * @param InitializeFieldCommand $command
     *
     * @return Field
     */
    public function handle(InitializeFieldCommand $command)
    {
        if ($command->fieldId && ($field = $this->fieldRepository->find($command->fieldId))) {
            return $field;
        }

        $field = $this->fieldFactory->create();
        $this->fieldRepository->store($field);

        return $field;
    }
}