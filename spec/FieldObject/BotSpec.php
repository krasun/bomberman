<?php

namespace spec\Bomberman\FieldObject;

use Bomberman\FieldObject\Bot;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BotSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(Bot::class);
    }

    function it_should_json_serializable()
    {
        $this->shouldImplement(\JsonSerializable::class);
    }

    function it_should_be_correctly_serialized()
    {
        $this->jsonSerialize([
            'className' => 'Bot'
        ]);
    }
}
