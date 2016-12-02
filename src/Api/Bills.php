<?php

namespace OpsWay\ZohoBooks\Api;

class Bills extends BaseApi
{
    const API_URL = 'bills';
    const API_KEY = 'bill';

    public function markAsVoid($billId)
    {
        $response = $this->client->post(static::API_URL.'/'.$billId.'/status/void', $this->organizationId);
        return true;
    }
}
