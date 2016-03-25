<?php

namespace spec\Bomberman\FieldObject;

use Bomberman\FieldObject\FlammableBlock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlammableBlockSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(FlammableBlock::class);
    }

    function it_should_json_serializable()
    {
        $this->shouldImplement(\JsonSerializable::class);
    }

    function it_should_be_correctly_serialized()
    {
        $this->jsonSerialize([
            'className' => 'FlammableBlock'
        ]);
    }
}
