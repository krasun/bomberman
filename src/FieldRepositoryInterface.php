<?php

namespace Bomberman;

/**
 * Responsible for storing and retrieving field.
 */
interface FieldRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return Field|null
     */
    public function find($id);

    /**
     * @param Field $field
     *
     * @return void
     */
    public function store(Field $field);
}