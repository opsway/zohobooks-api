<?php

namespace OpsWay\ZohoBooks\Api;

class PurchaseOrder extends BaseApi
{
    const API_PATH = 'purchaseorders';
    const API_KEY = 'purchaseorder';

    public function markAsOpen($id)
    {
        $this->client->post(self::API_PATH."/$id/status/open", $this->organizationId);
    }
}
