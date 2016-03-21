<?php

namespace spec\Bomberman;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\FieldPosition;

class FieldPositionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(FieldPosition::class);
    }

    function it_should_be_correctly_constructed()
    {
        $this->beConstructedWith(2, 3);

        $this->getRowIndex()->shouldBe(2);
        $this->getColumnIndex()->shouldBe(3);
    }

    function it_should_be_equal_to_the_same_position(FieldPosition $another)
    {
        $this->beConstructedWith(1, 2);

        $another->getRowIndex()->willReturn(1);
        $another->getColumnIndex()->willReturn(2);

        $this->equals($another)->shouldBe(true);
    }

    function it_should_not_be_equal_to_the_different_position(FieldPosition $another)
    {
        $this->beConstructedWith(0, 0);

        $another->getRowIndex()->willReturn(0);
        $another->getColumnIndex()->willReturn(1);

        $this->equals($another)->shouldBe(false);
    }
}
