<?php

namespace spec\Bomberman\FieldCellInitializationAlgorithm;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\FieldCellInitializationAlgorithm\BotInitializationAlgorithm;
use Bomberman\FieldObject\Bot;

class BotInitializationAlgorithmSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(BotInitializationAlgorithm::class);
    }

    function it_should_return_bot_at_specified_row_and_column_index(Bot $bot)
    {
        $this->beConstructedWith(0, 1, $bot);

        $this->initialize(0, 0)->shouldBeNull();
        $this->initialize(0, 1)->shouldBe($bot);
        $this->initialize(0, 2)->shouldBeNull();
    }
}
