<?php

namespace OpsWay\ZohoBooks\Api;

class Items extends BaseApi
{
    const API_PATH = 'items';
    const API_KEY = 'item';

    /**
     * @see https://www.zoho.com/books/api/v3/#Items_Mark_as_active
     * @param string $itemId
     *
     * @return bool
     */
    public function markAsActive($itemId)
    {
        $this->client->post(static::API_PATH.'/'.$itemId.'/active', $this->organizationId);

        return true;
    }

    /**
     * @see https://www.zoho.com/books/api/v3/#Items_Mark_as_inactive
     * @param string $itemId
     *
     * @return bool
     */
    public function markAsInactive($itemId)
    {
        $this->client->post(static::API_PATH.'/'.$itemId.'/inactive', $this->organizationId);

        return true;
    }
}
