<?php

namespace Bomberman\FieldObject;

/**
 * Represents object located at field.
 */
abstract class FieldObject implements \JsonSerializable
{
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'type' => (new \ReflectionClass($this))->getShortName(),
        ];
    }
}