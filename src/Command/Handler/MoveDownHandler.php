<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\MoveDownCommand;
use Bomberman\FieldObject\Player;
use Bomberman\FieldRepository\FieldRepository;
use Bomberman\FieldTransition\MovePlayerDownTransition;

/**
 * Responsible for moving player down.
 */
class MoveDownHandler
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
     * @param MoveDownCommand $command
     */
    public function handle(MoveDownCommand $command)
    {
        $field = $this->fieldRepository->find($command->fieldId);

        $field = $field->apply(new MovePlayerDownTransition());

        $this->fieldRepository->store($field);

        return $field;
    }
}