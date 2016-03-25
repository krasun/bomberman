<?php

namespace spec\Bomberman\FieldRepository;

use Bomberman\Field;
use Bomberman\FieldRepository\FieldRepository;
use Doctrine\Common\Cache\Cache;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FieldRepositorySpec extends ObjectBehavior
{
    function let(Cache $cache)
    {
        $this->beAnInstanceOf(FieldRepository::class);
        $this->beConstructedWith($cache);
    }

    function it_should_return_field_from_cache_by_id(Cache $cache, Field $field)
    {
        $cache->fetch('field_42')->willReturn($field);

        $this->find('42')->shouldBe($field);
    }

    function it_should_cache_field_by_id(Cache $cache, Field $field)
    {
        $field->getId()->willReturn('42');

        $cache->save('field_42', $field)->shouldBeCalled();

        $this->store($field)->shouldReturn(null);
    }
}
