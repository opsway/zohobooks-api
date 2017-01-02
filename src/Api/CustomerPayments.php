<?php

namespace OpsWay\ZohoBooks\Api;

class CustomerPayments extends BaseApi
{
    const API_URL = 'customerpayments';
    const API_KEY = 'payment';

    public function list(array $filters = [])
    {
        $response = $this->client->getList(static::API_URL, $this->organizationId, $filters);

        return $response['customerpayments'];
    }
}
