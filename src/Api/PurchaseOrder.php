<?php

namespace OpsWay\ZohoBooks\Api;

class PurchaseOrder extends BaseApi
{
    const API_URL = 'purchaseorders';
    const API_KEY = 'purchaseorder';

    public function markAsOpen($id)
    {
        $this->client->post(self::API_URL."/$id/status/open", $this->organizationId);
    }
}
