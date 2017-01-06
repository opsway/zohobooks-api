<?php

namespace OpsWay\ZohoBooks\Api;

class VendorCredits extends BaseApi
{
    const API_PATH = 'vendorcredits';
    const API_KEY = 'vendor_credit';

    public function applyToBill($vendorCreditId, $data)
    {
        $this->client->post(static::API_PATH.'/'.$vendorCreditId.'/bills', $this->organizationId, $data);

        return true;
    }

    public function markAsVoid($vendorCreditId)
    {
        $this->client->post(static::API_PATH.'/'.$vendorCreditId.'/status/void', $this->organizationId);

        return true;
    }
}
