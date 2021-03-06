<?php

namespace Bomberman\FieldObject;

/**
 * Represents object located at field.
 */
abstract class AbstractFieldObject implements \JsonSerializable
{
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'className' => (new \ReflectionClass($this))->getShortName(),
        ];
    }
}