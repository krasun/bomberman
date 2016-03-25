<?php

namespace spec\Bomberman\Command\Handler;

use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\Command\Handler\InitializeFieldHandler;
use Bomberman\Command\InitializeFieldCommand;
use Bomberman\FieldFactoryInterface;

class InitializeFieldHandlerSpec extends ObjectBehavior
{
    function let(FieldFactoryInterface $fieldFactory, FieldRepositoryInterface $fieldRepository)
    {
        $this->beAnInstanceOf(InitializeFieldHandler::class);
        $this->beConstructedWith($fieldFactory, $fieldRepository);
    }

    function it_should_create_and_return_field_if_field_id_is_not_specified(
        FieldFactoryInterface $fieldFactory,
        Field $field
    )
    {
        $fieldFactory->create()->willReturn($field);

        $this->handle(new InitializeFieldCommand())->shouldBe($field);
    }

    function it_should_return_existent_field_if_id_specified_and_field_exists(
        FieldRepositoryInterface $fieldRepository,
        FieldFactoryInterface $fieldFactory,
        Field $field
    )
    {
        $fieldRepository->find('42')->willReturn($field);

        $fieldFactory->create()->shouldNotBeCalled();

        $command = new InitializeFieldCommand();
        $command->fieldId = '42';

        $this->handle($command)->shouldBe($field);
    }

    function it_should_return_new_field_if_id_specified_and_field_does_not_exist(
        FieldRepositoryInterface $fieldRepository,
        FieldFactoryInterface $fieldFactory,
        Field $field
    )
    {
        $fieldRepository->find('42')->willReturn(null);

        $fieldFactory->create()->willReturn($field)->shouldBeCalled();

        $fieldRepository->store($field)->shouldBeCalled();

        $command = new InitializeFieldCommand();
        $command->fieldId = '42';

        $this->handle($command)->shouldBe($field);
    }
}
