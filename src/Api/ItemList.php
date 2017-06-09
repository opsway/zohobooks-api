<?php

namespace OpsWay\ZohoBooks\Api;


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
        return isset($this->{$offset});
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset)? $this->{$offset}: [];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->{$offset} = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->{$offset} = [];

        return $this;
    }
}
