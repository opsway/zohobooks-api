<?php

namespace OpsWay\ZohoBooks\Api;

class Invoices extends BaseApi
{
    const API_PATH = 'invoices';
    const API_KEY = 'invoice';

    public function applyCredits($invoiceId, $data)
    {
        $this->client->post(static::API_PATH.'/'.$invoiceId.'/credits', $this->organizationId, $data);

        return true;
    }

    public function markAsSent($invoiceId)
    {
        $this->client->post(static::API_PATH.'/'.$invoiceId.'/status/sent', $this->organizationId);

        return true;
    }

    public function markAsVoid($invoiceId)
    {
        $this->client->post(static::API_PATH.'/'.$invoiceId.'/status/void', $this->organizationId);

        return true;
    }
}
