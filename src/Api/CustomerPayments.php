<?php

namespace OpsWay\ZohoBooks\Api;

class CustomerPayments extends BaseApi
{
    const API_PATH = 'customerpayments';
    const API_KEY = 'payment';

    public function getList(array $filters = [])
    {
        $response = $this->client->getList(static::API_PATH, $this->organizationId, $filters);

        return $response['customerpayments'];
    }
}
