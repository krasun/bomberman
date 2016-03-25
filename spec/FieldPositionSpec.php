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

    function it_should_be_convertable_to_up()
    {
        $this->beConstructedWith(2, 3);

        $this->toUp()->shouldBeLike(new FieldPosition(1, 3));
    }

    function it_should_be_convertable_to_down()
    {
        $this->beConstructedWith(2, 3);

        $this->toDown()->shouldBeLike(new FieldPosition(3, 3));
    }

    function it_should_be_convertable_to_left()
    {
        $this->beConstructedWith(2, 3);

        $this->toLeft()->shouldBeLike(new FieldPosition(2, 2));
    }

    function it_should_be_convertable_to_right()
    {
        $this->beConstructedWith(2, 3);

        $this->toRight()->shouldBeLike(new FieldPosition(2, 4));
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
