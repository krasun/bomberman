<?php

namespace spec\Bomberman\Command\Handler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\Command\Handler\MoveUpHandler;
use Bomberman\Command\MoveUpCommand;
use Bomberman\FieldTransition\MovePlayerUpTransition;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;

class MoveUpHandlerSpec extends ObjectBehavior
{
    function let(FieldRepositoryInterface $fieldRepository)
    {
        $this->beAnInstanceOf(MoveUpHandler::class);
        $this->beConstructedWith($fieldRepository);
    }

    function it_should_apply_right_player_transition_to_field(
        FieldRepositoryInterface $fieldRepository,
        Field $field,
        Field $transformedField
    )
    {
        $fieldRepository->find('42')->willReturn($field);
        $field->apply(new MovePlayerUpTransition())->willReturn($transformedField);

        $fieldRepository->store($transformedField)->shouldBeCalled();

        $command = new MoveUpCommand();
        $command->fieldId = '42';
        $this->handle($command)->shouldBeLike($transformedField);
    }
}
