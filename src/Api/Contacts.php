<?php

namespace OpsWay\ZohoBooks\Api;

class Contacts extends BaseApi
{
    const API_PATH = 'contacts';
    const API_KEY = 'contact';

    public function getList(array $filters = [])
    {
        $response = $this->client->getList(static::API_PATH, $this->organizationId, $filters);

        return $response['contacts'];
    }
}
