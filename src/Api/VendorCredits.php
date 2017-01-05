<?php

namespace OpsWay\ZohoBooks\Api;

class VendorCredits extends BaseApi
{
    const API_URL = 'vendorcredits';
    const API_KEY = 'vendor_credit';

    public function applyToBill($vendorCreditId, $data)
    {
        $response = $this->client->post(static::API_URL.'/'.$vendorCreditId.'/bills', $this->organizationId, $data);

        return true;
    }

    public function getList(array $filters = [])
    {
        $response = $this->client->getList(static::API_URL, $this->organizationId, $filters);
        return $response['vendorcredits'];
    }

    public function markAsVoid($vendorCreditId)
    {
        $response = $this->client->post(static::API_URL.'/'.$vendorCreditId.'/status/void', $this->organizationId);

        return true;
    }
}
