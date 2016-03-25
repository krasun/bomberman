<?php

namespace spec\Bomberman\FieldObject;

use Bomberman\FieldObject\FireproofBlock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FireproofBlockSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(FireproofBlock::class);
    }

    function it_should_json_serializable()
    {
        $this->shouldImplement(\JsonSerializable::class);
    }

    function it_should_be_correctly_serialized()
    {
        $this->jsonSerialize([
            'className' => 'FireproofBlock'
        ]);
    }
}
