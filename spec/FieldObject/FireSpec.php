<?php

namespace spec\Bomberman\FieldObject;

use Bomberman\FieldObject\Fire;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FireSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(Fire::class);
    }

    function it_should_json_serializable()
    {
        $this->shouldImplement(\JsonSerializable::class);
    }

    function it_should_be_correctly_serialized()
    {
        $this->jsonSerialize([
            'className' => 'Fire'
        ]);
    }
}
