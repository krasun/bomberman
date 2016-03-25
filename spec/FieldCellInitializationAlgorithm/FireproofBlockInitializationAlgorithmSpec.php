<?php

namespace spec\Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldObject\FireproofBlock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\FieldCellInitializationAlgorithm\FireproofBlockInitializationAlgorithm;

class FireproofBlockInitializationAlgorithmSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(FireproofBlockInitializationAlgorithm::class);
    }

    function it_should_create_fireproof_blocks_for_paired_odd_indexes()
    {
        $this->initialize(1, 1)->shouldBeLike(new FireproofBlock());
        $this->initialize(1, 3)->shouldBeLike(new FireproofBlock());
        $this->initialize(3, 1)->shouldBeLike(new FireproofBlock());
        $this->initialize(3, 3)->shouldBeLike(new FireproofBlock());
    }

    function it_should_return_null_for_not_paired_odd_indexes()
    {
        $this->initialize(0, 1)->shouldBeNull();
        $this->initialize(0, 2)->shouldBeNull();
        $this->initialize(1, 2)->shouldBeNull();
        $this->initialize(2, 2)->shouldBeNull();
    }
}
