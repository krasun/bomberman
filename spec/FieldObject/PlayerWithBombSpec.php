<?php

namespace spec\Bomberman\FieldObject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\FieldObject\PlayerWithBomb;

class PlayerWithBombSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(PlayerWithBomb::class);
    }

    function it_should_json_serializable()
    {
        $this->shouldImplement(\JsonSerializable::class);
    }

    function it_should_be_correctly_serialized()
    {
        $this->jsonSerialize([
            'className' => 'PlayerWithBomb'
        ]);
    }
}
