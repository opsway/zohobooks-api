<?php

namespace OpsWay\ZohoBooks\Api;

class Invoices extends BaseApi
{
    const API_URL = 'invoices';
    const API_KEY = 'invoice';

    public function applyCredits($invoiceId, $data)
    {
        $response = $this->client->post(static::API_URL.'/'.$invoiceId.'/credits', $this->organizationId, $data);

        return true;
    }

    public function markAsSent($invoiceId)
    {
        $response = $this->client->post(static::API_URL.'/'.$invoiceId.'/status/sent', $this->organizationId);

        return true;
    }

    public function markAsVoid($invoiceId)
    {
        $response = $this->client->post(static::API_URL.'/'.$invoiceId.'/status/void', $this->organizationId);

        return true;
    }
}
