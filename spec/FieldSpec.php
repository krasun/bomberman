<?php

namespace spec\Bomberman;

use Bomberman\FieldCell;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\Field;
use Bomberman\FieldCellInitializationAlgorithmInterface;
use Bomberman\FieldObject\AbstractFieldObject;
use Ramsey\Uuid\Uuid;

class FieldSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(Field::class);
    }

    public function it_should_have_uuid_as_id()
    {
        $this->beConstructedWith();

        $this->getId()->shouldBeUuid();
    }

    public function it_should_be_created_with_unique_id()
    {
        $this->beConstructedWith();

        $this->getId()->shouldNotBeLike((new Field())->getId());
    }

    function it_should_be_constructed_by_default_with_eleven_rows_and_thirteen_columns()
    {
        $this->beConstructedWith();

        $this->getRowCount()->shouldBe(11);
        $this->getColumnCount()->shouldBe(13);
    }

    function it_should_be_constructed_with_specified_number_of_rows_and_columns()
    {
        $this->beConstructedWith(null, 5, 7);

        $this->getRowCount()->shouldBe(5);
        $this->getColumnCount()->shouldBe(7);
    }

    function it_should_be_constructed_with_empty_fields()
    {
        $this->beConstructedWith(null, 1, 1);

        $this->getObjectAt(0, 0)->shouldBeNull();
    }

    function it_should_validate_row_index()
    {
        $this->beConstructedWith(null, 1, 1);

        $this->shouldThrow(\InvalidArgumentException::class)->duringGetObjectAt(5, 0);
    }

    function it_should_validate_column_index()
    {
        $this->beConstructedWith(null, 1, 1);

        $this->shouldThrow(\InvalidArgumentException::class)->duringGetObjectAt(0, 5);
    }

    function it_should_be_constructed_using_initializer(
        AbstractFieldObject $fieldObject,
        FieldCellInitializationAlgorithmInterface $fieldCellInitializationAlgorithm
    )
    {
        $fieldCellInitializationAlgorithm->initialize(0, 0)->willReturn(null)->shouldBeCalled();
        $fieldCellInitializationAlgorithm->initialize(0, 1)->willReturn(null)->shouldBeCalled();
        $fieldCellInitializationAlgorithm->initialize(1, 0)->willReturn($fieldObject)->shouldBeCalled();
        $fieldCellInitializationAlgorithm->initialize(1, 1)->willReturn(null)->shouldBeCalled();

        $this->beConstructedWith($fieldCellInitializationAlgorithm, 2, 2);

        $this->getObjectAt(0, 0)->shouldBeNull();
        $this->getObjectAt(0, 0)->shouldBeNull();
        $this->getObjectAt(1, 0)->shouldBe($fieldObject);
        $this->getObjectAt(1, 1)->shouldBeNull();
    }

    function it_should_return_cells(
        AbstractFieldObject $fieldObject,
        FieldCellInitializationAlgorithmInterface $fieldCellInitializationAlgorithm
    )
    {
        $fieldCellInitializationAlgorithm->initialize(0, 0)->willReturn(null)->shouldBeCalled();
        $fieldCellInitializationAlgorithm->initialize(0, 1)->willReturn(null)->shouldBeCalled();
        $fieldCellInitializationAlgorithm->initialize(1, 0)->willReturn($fieldObject)->shouldBeCalled();
        $fieldCellInitializationAlgorithm->initialize(1, 1)->willReturn(null)->shouldBeCalled();

        $this->beConstructedWith($fieldCellInitializationAlgorithm, 2, 2);

        $this->getCells()->shouldBeLike([
            [new FieldCell($this->getWrappedObject(), 0, 0), new FieldCell($this->getWrappedObject(), 0, 1)],
            [new FieldCell($this->getWrappedObject(), 1, 0, $fieldObject->getWrappedObject()), new FieldCell($this->getWrappedObject(), 1, 1)]
        ]);
    }

    public function getMatchers()
    {
        return [
            'beUuid' => function ($subject) {
                return Uuid::isValid($subject);
            }
        ];
    }
}