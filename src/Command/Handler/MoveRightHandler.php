<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\MoveRightCommand;
use Bomberman\Field;
use Bomberman\FieldRepository\FieldRepository;
use Bomberman\FieldTransition\MovePlayerRightTransition;

/**
 * Responsible for moving player right.
 */
class MoveRightHandler
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
     * @param MoveRightCommand $command
     *
     * @return Field
     */
    public function handle(MoveRightCommand $command)
    {
        $field = $this->fieldRepository->find($command->fieldId);

        $field = $field->apply(new MovePlayerRightTransition());

        $this->fieldRepository->store($field);

        return $field;
    }
}