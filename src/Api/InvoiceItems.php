<?php

namespace OpsWay\ZohoBooks\Api;

class InvoiceItems extends BaseApi
{
    const API_PATH = 'items';
    const API_KEY = 'item';

    /**
     * @link https://www.zoho.com/books/api/v3/settings/items/#mark-item-as-active.
     * @param string $itemId
     *
     * @return boolean
     */
    public function markAsActive($itemId)
    {
        $this->client->post(static::API_PATH.'/'.$itemId.'/active', $this->organizationId);

        return true;
    }

    /**
     * @link https://www.zoho.com/books/api/v3/settings/items/#mark-item-as-inactive
     * @param string $itemId
     *
     * @return boolean
     */
    public function markAsInactive($itemId)
    {
        $this->client->post(static::API_PATH.'/'.$itemId.'/inactive', $this->organizationId);

        return true;
    }
}
