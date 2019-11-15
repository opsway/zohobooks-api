<?php

namespace OpsWay\ZohoBooks\Api;

class CreditNotes extends BaseApi
{
    const API_PATH = 'creditnotes';
    const API_KEY = 'creditnote';
    const API_REFUND_KEY = 'creditnote_refund';

    public function refund($creditNoteId, $data)
    {
        $response = $this->client->post(static::API_PATH.'/'.$creditNoteId.'/refunds', $this->organizationId, $data);

        return $response[static::API_REFUND_KEY];
    }
}
