<?php

namespace spec\Bomberman\Command\Handler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\Command\Handler\PutBombHandler;
use Bomberman\Command\PutBombCommand;
use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use Bomberman\FieldTransition\PutBombTransition;

class PutBombHandlerSpec extends ObjectBehavior
{
    function let(FieldRepositoryInterface $fieldRepository)
    {
        $this->beAnInstanceOf(PutBombHandler::class);
        $this->beConstructedWith($fieldRepository);
    }

    function it_should_apply_put_bomb_transition_to_field(
        FieldRepositoryInterface $fieldRepository,
        Field $field,
        Field $transformedField
    )
    {
        $fieldRepository->find('42')->willReturn($field);
        $field->apply(new PutBombTransition())->willReturn($transformedField);

        $fieldRepository->store($transformedField)->shouldBeCalled();

        $command = new PutBombCommand();
        $command->fieldId = '42';
        $this->handle($command)->shouldBeLike($transformedField);
    }
}
