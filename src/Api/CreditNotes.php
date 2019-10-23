<?php

namespace OpsWay\ZohoBooks\Api;

class CreditNotes extends BaseApi
{
    const API_PATH = 'creditnotes';
    const API_KEY = 'creditnote';

    public function refund($creditNoteId, $data)
    {
        $this->client->post(static::API_PATH.'/'.$creditNoteId.'/refunds', $this->organizationId, $data);

        return true;
    }
}
