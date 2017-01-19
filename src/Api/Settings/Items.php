<?php

namespace OpsWay\ZohoBooks\Api\Settings;

class Items extends BaseApi
{
    const API_PATH = 'items';
    const API_KEY = 'item';

    /**
     * @see https://www.zoho.com/books/api/v3/settings/items/#mark-item-as-active.
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
     * @see https://www.zoho.com/books/api/v3/settings/items/#mark-item-as-inactive
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
