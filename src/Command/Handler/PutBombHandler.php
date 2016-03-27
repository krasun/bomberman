<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\PutBombCommand;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use Bomberman\FieldTransition\PutBombTransition;

/**
 * Responsible for putting bomb.
 */
class PutBombHandler
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