<?php

namespace spec\Bomberman;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\FieldSize;

class FieldSizeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(FieldSize::class);
    }

    function it_should_be_correctly_constructed()
    {
        $this->beConstructedWith(12, 3);

        $this->getRowCount()->shouldBe(12);
        $this->getColumnCount()->shouldBe(3);
    }
}
