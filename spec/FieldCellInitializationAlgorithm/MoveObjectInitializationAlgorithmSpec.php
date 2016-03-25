<?php

namespace spec\Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\Field;
use Bomberman\FieldCellInitializationAlgorithm\MoveObjectInitializationAlgorithm;
use Bomberman\FieldCellInitializationAlgorithmInterface;
use Bomberman\FieldObject\AbstractFieldObject;
use Bomberman\FieldPosition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoveObjectInitializationAlgorithmSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(MoveObjectInitializationAlgorithm::class);
    }

    function it_should_replace_source_to_target(
        FieldCellInitializationAlgorithmInterface $fieldCellInitializationAlgorithm,
        AbstractFieldObject $fieldObject
    )
    {
        $fieldCellInitializationAlgorithm->initialize(0, 0)->willReturn(null);
        $fieldCellInitializationAlgorithm->initialize(0, 1)->willReturn(null);
        $fieldCellInitializationAlgorithm->initialize(1, 0)->willReturn(null);
        $fieldCellInitializationAlgorithm->initialize(1, 1)->willReturn($fieldObject);

        $this->beConstructedWith(
            new Field($fieldCellInitializationAlgorithm->getWrappedObject(), 2, 2),
            new FieldPosition(1, 1),
            new FieldPosition(1, 0)
        );

        $this->initialize(1, 1)->shouldBe(null);
        $this->initialize(1, 0)->shouldBe($fieldObject);
    }
}
