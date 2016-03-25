<?php

namespace Bomberman;

use Bomberman\Field;

/**
 * Represents field transition from one state to another.
 */
interface FieldTransitionInterface
{
    /**
     * Can apply transition to specified field?
     *
     * @param Field $field
     *
     * @return bool
     */
    public function canApplyTo(Field $field);

    /**
     * Applies transition for specified field.
     *
     * @param Field $field
     *
     * @return Field
     */
    public function apply(Field $field);
}