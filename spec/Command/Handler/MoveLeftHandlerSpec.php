<?php

namespace spec\Bomberman\Command\Handler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\Command\Handler\MoveLeftHandler;
use Bomberman\Command\MoveLeftCommand;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use Bomberman\FieldTransition\MovePlayerLeftTransition;

class MoveLeftHandlerSpec extends ObjectBehavior
{
    function let(FieldRepositoryInterface $fieldRepository)
    {
        $this->beAnInstanceOf(MoveLeftHandler::class);
        $this->beConstructedWith($fieldRepository);
    }

    function it_should_apply_move_player_to_left_transition_to_field(
        FieldRepositoryInterface $fieldRepository,
        Field $field,
        Field $transformedField
    )
    {
        $fieldRepository->find('42')->willReturn($field);
        $field->apply(new MovePlayerLeftTransition())->willReturn($transformedField);

        $fieldRepository->store($transformedField)->shouldBeCalled();

        $command = new MoveLeftCommand();
        $command->fieldId = '42';
        $this->handle($command)->shouldBeLike($transformedField);
    }
}
