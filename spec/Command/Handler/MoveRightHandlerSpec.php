<?php

namespace spec\Bomberman\Command\Handler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\Command\Handler\MoveRightHandler;
use Bomberman\Command\MoveRightCommand;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use Bomberman\FieldTransition\MovePlayerRightTransition;

class MoveRightHandlerSpec extends ObjectBehavior
{
    function let(FieldRepositoryInterface $fieldRepository)
    {
        $this->beAnInstanceOf(MoveRightHandler::class);
        $this->beConstructedWith($fieldRepository);
    }

    function it_should_apply_left_down_player_transition_to_field(
        FieldRepositoryInterface $fieldRepository,
        Field $field,
        Field $transformedField
    )
    {
        $fieldRepository->find('42')->willReturn($field);
        $field->apply(new MovePlayerRightTransition())->willReturn($transformedField);

        $fieldRepository->store($transformedField)->shouldBeCalled();

        $command = new MoveRightCommand();
        $command->fieldId = '42';
        $this->handle($command)->shouldBeLike($transformedField);
    }
}
