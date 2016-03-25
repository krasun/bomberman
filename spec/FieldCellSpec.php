<?php

namespace spec\Bomberman;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bomberman\Field;
use Bomberman\FieldCell;
use Bomberman\FieldObject\AbstractFieldObject;

class FieldCellSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(FieldCell::class);
    }

    function it_should_be_correctly_constructed(AbstractFieldObject $fieldObject)
    {
        $field = new Field();

        $this->beConstructedWith($field, 2, 3, $fieldObject);

        $this->getField()->shouldBe($field);
        $this->getRowIndex()->shouldBe(2);
        $this->getColumnIndex()->shouldBe(3);
        $this->getFieldObject()->shouldBe($fieldObject);
    }

    function it_should_be_empty_if_it_does_not_contain_field_object()
    {
        $this->beConstructedWith(new Field(null, 2, 2), 1, 1);

        $this->isEmpty()->shouldBe(true);
    }

    function it_should_throw_error_for_invalid_row_index()
    {
        $this->beConstructedWith(new Field(null, 2, 2), 3, 1);

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    function it_should_throw_error_for_invalid_column_index()
    {
        $this->beConstructedWith(new Field(null, 2, 2), 1, 3);

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }
}
