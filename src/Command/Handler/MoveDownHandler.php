<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\MoveDownCommand;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use Bomberman\FieldTransition\MovePlayerDownTransition;

/**
 * Responsible for moving player down.
 */
class MoveDownHandler
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
     * @param MoveDownCommand $command
     *
     * @return Field
     */
    public function handle(MoveDownCommand $command)
    {
        $field = $this->fieldRepository->find($command->fieldId);

        $field = $field->apply(new MovePlayerDownTransition());

        $this->fieldRepository->store($field);

        return $field;
    }
}