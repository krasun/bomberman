<?php

namespace spec\Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldObject\Player;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\FieldCellInitializationAlgorithm\PlayerInitializationAlgorithm;

class PlayerInitializationAlgorithmSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(PlayerInitializationAlgorithm::class);
    }

    function it_should_return_player_at_specified_row_and_column_index(Player $player)
    {
        $this->beConstructedWith(0, 1, $player);

        $this->initialize(0, 0)->shouldBeNull();
        $this->initialize(0, 1)->shouldBe($player);
        $this->initialize(0, 2)->shouldBeNull();
    }
}
