<?php

namespace Bomberman\Command\Handler;

use Bomberman\Command\MoveDownCommand;
use Bomberman\FieldObject\Player;
use Bomberman\FieldRepository\FieldRepository;

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

        $field->findCellWithObjectOfType(Player::class);

        $this->fieldRepository->store($field);
    }
}