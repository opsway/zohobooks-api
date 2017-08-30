<?php

namespace OpsWay\ZohoBooks\Api;

class Taxes extends BaseApi
{
    const API_PATH = 'settings/taxes';
    const API_KEY = 'tax';

    /**
     * @param array $filters
     *
     * @return ItemList
     */
    public function getList(array $filters = [])
    {
        $response = $this->client->getList(static::API_PATH, $this->organizationId, $filters);

        return new ItemList($response[static::API_KEY.'es'], $response['page_context']);
    }
}
