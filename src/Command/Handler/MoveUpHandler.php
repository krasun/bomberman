<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\MoveUpCommand;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use Bomberman\FieldTransition\MovePlayerUpTransition;

/**
 * Responsible for moving player up.
 */
class MoveUpHandler
{
    /**
     * @var FieldRepositoryInterface
     */
    private $fieldRepository;

    /**
     * @param FieldRepositoryInterface $fieldRepository
     */
    public function __construct(FieldRepositoryInterface $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }

    /**
     * @param MoveUpCommand $command
     *
     * @return Field
     */
    public function handle(MoveUpCommand $command)
    {
        $field = $this->fieldRepository->find($command->fieldId);

        $field = $field->apply(new MovePlayerUpTransition());

        $this->fieldRepository->store($field);

        return $field;
    }
}