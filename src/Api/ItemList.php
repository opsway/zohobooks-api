<?php

namespace OpsWay\ZohoBooks\Api;


class ItemList implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var iterable
     */
    private $items = [];

    /**
     * @var iterable
     */
    private $pageContext = [];

    function __construct(iterable $items,iterable $pageContext)
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
     * @return iterable
     */
    public function getPageContext(): iterable
    {
        return $this->pageContext;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->{$offset} ?? null;
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
