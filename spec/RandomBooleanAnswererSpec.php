<?php

namespace spec\Bomberman;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\RandomBooleanAnswerer;

class RandomBooleanAnswererSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(RandomBooleanAnswerer::class);
    }

    function it_should_generate_true()
    {
        $this->generate()->shouldBe(true);
    }
}

namespace Bomberman;

function mt_rand()
{
    return 1;
}
