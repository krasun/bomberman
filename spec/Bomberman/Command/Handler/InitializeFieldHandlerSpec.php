<?php

namespace spec\Bomberman\Command\Handler;

use Bomberman\Command\Handler\InitializeFieldHandler;
use Bomberman\Command\InitializeFieldCommand;
use Bomberman\Field;
use Bomberman\FieldFactoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InitializeFieldHandlerSpec extends ObjectBehavior
{
    function let(FieldFactoryInterface $fieldFactory)
    {
        $this->beAnInstanceOf(InitializeFieldHandler::class);
        $this->beConstructedWith($fieldFactory);
    }

    function it_should_create_and_return_field_factory(
        FieldFactoryInterface $fieldFactory,
        Field $field
    )
    {
        $fieldFactory->create()->willReturn($field);

        $this->handle(new InitializeFieldCommand())->shouldBe($field);
    }
}
