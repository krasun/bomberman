<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\MoveLeftCommand;
use Bomberman\Field;
use Bomberman\FieldRepository\FieldRepository;
use Bomberman\FieldTransition\MovePlayerLeftTransition;

/**
 * Responsible for moving player left.
 */
class MoveLeftHandler
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
     * @param MoveLeftCommand $command
     *
     * @return Field
     */
    public function handle(MoveLeftCommand $command)
    {
        $field = $this->fieldRepository->find($command->fieldId);

        $field = $field->apply(new MovePlayerLeftTransition());

        $this->fieldRepository->store($field);

        return $field;
    }
}