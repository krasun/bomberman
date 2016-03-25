<?php

namespace Bomberman\FieldRepository;

use Bomberman\Field;
use Bomberman\FieldRepositoryInterface;
use Doctrine\Common\Cache\Cache;

/**
 * Responsible for storing and retrieving field.
 *
 * Cache used for simplicity of database storage implementation.
 */
class FieldRepository implements FieldRepositoryInterface
{
    /**
     * Pattern for cache key.
     */
    const CACHE_KEY_PATTERN = 'field_%s';

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return $this->cache->fetch(sprintf(static::CACHE_KEY_PATTERN, $id));
    }

    /**
     * {@inheritdoc}
     */
    public function store(Field $field)
    {
        $this->cache->save(sprintf(static::CACHE_KEY_PATTERN, $field->getId()), $field);
    }
}