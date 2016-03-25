<?php

namespace spec\Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldCellInitializationAlgorithm\FlammableBlockInitializationAlgorithm;
use Bomberman\FieldCellInitializationAlgorithm\PlayerInitializationAlgorithm;
use Bomberman\FieldObject\FlammableBlock;
use Bomberman\FieldPosition;
use Bomberman\RandomBooleanAnswerer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlammableBlockInitializationAlgorithmSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(FlammableBlockInitializationAlgorithm::class);
    }

    public function it_should_not_put_flammable_blocks_in_restricted_positions_with_specified_radius(
        RandomBooleanAnswerer $randomBooleanAnswerer
    )
    {
        $randomBooleanAnswerer->generate()->willReturn(true)->shouldBeCalled();

        $this->beConstructedWith([new FieldPosition(0, 0), new FieldPosition(10, 10)], 2, $randomBooleanAnswerer);

        $this->initialize(0, 1)->shouldReturn(null);
        $this->initialize(1, 1)->shouldReturn(null);
        $this->initialize(1, 2)->shouldBeLike(new FlammableBlock());
        $this->initialize(3, 3)->shouldBeLike(new FlammableBlock());
        $this->initialize(8, 9)->shouldBeLike(new FlammableBlock());
        $this->initialize(9, 9)->shouldReturn(null);
        $this->initialize(9, 10)->shouldReturn(null);
    }

    public function it_should_not_put_flammable_block(
        RandomBooleanAnswerer $randomBooleanAnswerer
    )
    {
        $randomBooleanAnswerer->generate()->willReturn(false)->shouldBeCalled();

        $this->beConstructedWith([], 0, $randomBooleanAnswerer);

        $this->initialize(0, 1)->shouldReturn(null);
        $this->initialize(1, 1)->shouldReturn(null);
    }

    public function it_should_put_flammable_block(
        RandomBooleanAnswerer $randomBooleanAnswerer
    )
    {
        $randomBooleanAnswerer->generate()->willReturn(true)->shouldBeCalled();

        $this->beConstructedWith([], 0, $randomBooleanAnswerer);

        $this->initialize(0, 1)->shouldBeLike(new FlammableBlock());
        $this->initialize(1, 1)->shouldBeLike(new FlammableBlock());
    }
}
