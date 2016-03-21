<?php

namespace spec\Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldCellInitializationAlgorithmInterface;
use Bomberman\FieldObject\FieldObject;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\FieldCellInitializationAlgorithm\ChainInitializationAlgorithm;

class ChainInitializationAlgorithmSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(ChainInitializationAlgorithm::class);
    }

    public function it_should_chain_responsibility(
        FieldCellInitializationAlgorithmInterface $algorithmWithSkippedInitialization1,
        FieldCellInitializationAlgorithmInterface $algorithmWithInitialization2,
        FieldCellInitializationAlgorithmInterface $algorithmWithSkippedInitialization3,
        FieldObject $fieldObject
    )
    {
        $algorithmWithSkippedInitialization1->initialize(1, 1)->willReturn(null);
        $algorithmWithInitialization2->initialize(1, 1)->willReturn($fieldObject);
        $algorithmWithSkippedInitialization3->initialize(1, 1)->shouldNotBeCalled();

        $this->beConstructedWith([
            $algorithmWithSkippedInitialization1,
            $algorithmWithInitialization2,
            $algorithmWithSkippedInitialization3
        ]);

        $this->initialize(1, 1)->shouldBe($fieldObject);
    }
}
