<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\PutBombCommand;
use Bomberman\Field;
use Bomberman\FieldRepository\FieldRepository;

/**
 * Responsible for putting bomb.
 */
class PutBombHandler
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
     * @param PutBombCommand $command
     *
     * @return Field
     */
    public function handle(PutBombCommand $command)
    {
        $field = $this->fieldRepository->find($command->fieldId);

        $field = $field->apply(new PutBombTransition());

        $this->fieldRepository->store($field);

        return $field;

    }
}