<?php

namespace spec\Bomberman\FieldObject;

use Bomberman\FieldObject\Bomb;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BombSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(Bomb::class);
    }

    function it_should_json_serializable()
    {
        $this->shouldImplement(\JsonSerializable::class);
    }

    function it_should_be_correctly_serialized()
    {
        $this->jsonSerialize([
            'className' => 'Bomb'
        ]);
    }
}
