<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\MoveUpCommand;
use Bomberman\Field;
use Bomberman\FieldRepository\FieldRepository;
use Bomberman\FieldTransition\MovePlayerUpTransition;

/**
 * Responsible for moving player up.
 */
class MoveUpHandler
{
    /**
     * @var FieldRepository
     */
    private $fieldRepository;

    /**
     * @param FieldRepository $fieldRepository
     */
    public function __construct(FieldRepository $fieldRepository)
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