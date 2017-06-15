<?php

namespace OpsWay\ZohoBooks\Api;

/**
 * This class is required in order to add pagination support to zoho books list endpoints
 *
 * @see https://www.zoho.com/books/api/v3/#pagination
 */
class ItemList implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    private $pageContext = [];

    /**
     * @param array $items
     * @param array $pageContext
     */
    public function __construct(array $items, array $pageContext)
    {
        $this->items = $items;
        $this->pageContext = $pageContext;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @return array
     */
    public function getPageContext()
    {
        return $this->pageContext;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return (is_numeric($offset) && isset($this->items[$offset])) || isset($this->{$offset});
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        if (is_numeric($offset) && isset($this->items[$offset])) {
            return $this->items[$offset];
        }

        return isset($this->{$offset}) ? $this->{$offset} : [];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (is_numeric($offset) && isset($this->items[$offset])) {
            $this->items[$offset] = $value;
        } elseif (isset($this->{$offset})) {
            $this->{$offset} = $value;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        if (is_numeric($offset) && isset($this->items[$offset])) {
            $this->items[$offset] = [];
        } elseif (isset($this->{$offset})) {
            $this->{$offset} = [];
        }

        return $this;
    }
}
