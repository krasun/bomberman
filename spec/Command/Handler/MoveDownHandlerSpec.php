<?php

namespace spec\Bomberman\Command\Handler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\Command\Handler\MoveDownHandler;
use Bomberman\Command\MoveDownCommand;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use Bomberman\FieldTransition\MovePlayerDownTransition;

class MoveDownHandlerSpec extends ObjectBehavior
{
    function let(FieldRepositoryInterface $fieldRepository)
    {
        $this->beAnInstanceOf(MoveDownHandler::class);
        $this->beConstructedWith($fieldRepository);
    }

    function it_should_apply_move_down_player_transition_to_field(
        FieldRepositoryInterface $fieldRepository,
        Field $field,
        Field $transformedField
    )
    {
        $fieldRepository->find('42')->willReturn($field);
        $field->apply(new MovePlayerDownTransition())->willReturn($transformedField);

        $fieldRepository->store($transformedField)->shouldBeCalled();

        $command = new MoveDownCommand();
        $command->fieldId = '42';
        $this->handle($command)->shouldBeLike($transformedField);
    }
}
