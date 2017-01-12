<?php

namespace OpsWay\ZohoBooks\Api;

class InvoiceItems extends BaseApi
{
    const API_PATH = 'items';
    const API_KEY = 'invoiceItems';

    public function markAsActive($itemId)
    {
        $this->client->post(static::API_PATH.'/'.$itemId.'/active', $this->organizationId);

        return true;
    }

    public function markAsInactive($itemId)
    {
        $this->client->post(static::API_PATH.'/'.$itemId.'/inactive', $this->organizationId);

        return true;
    }
}
