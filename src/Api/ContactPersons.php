<?php

namespace OpsWay\ZohoBooks\Api;

use GuzzleHttp\Psr7\Stream;

class ContactPersons extends BaseApi
{
    const API_PATH = 'contacts/contactpersons';
    const GET_API_PATH = 'contacts/{:contact_id}/contactpersons';
    const API_KEY = 'contact_person';

    /**
     * {@inheritdoc}
     *
     * @param int|null $contactId This parameter is required. The null value is allowed only to avoid warning message
     *
     * @throws \InvalidArgumentException when `$contactId` is null
     */
    public function getList(array $filters = [], $contactId = null)
    {
        if (null === $contactId) {
            throw new \InvalidArgumentException(sprintf('Argument 2 passed to `%s()` must be an integer, `null` given', __METHOD__));
        }

        $response = $this->client->getList(strtr(self::GET_API_PATH, ['{:contact_id}' => $contactId]), $this->organizationId, $filters);

        return new ItemList($response[static::API_KEY.'s'], $response['page_context']);
    }

    /**
     * {@inheritdoc}
     *
     * @param int|null $contactId This parameter is required. The null value is allowed only to avoid warning message
     *
     * @throws \InvalidArgumentException when `$contactId` is null
     */
    public function get($id, array $params = [], $contactId = null)
    {
        if (null === $contactId) {
            throw new \InvalidArgumentException(sprintf('Argument 3 passed to `%s()` must be an integer, `null` given', __METHOD__));
        }

        $response = $this->client->get(strtr(self::GET_API_PATH, ['{:contact_id}' => $contactId]), $this->organizationId, $id, $params);
        if ($response instanceof Stream) {
            return $response;
        }

        return $response[static::API_KEY];
    }

    /**
     * @param int $contactPersonId
     *
     * @return bool
     */
    public function markAsPrimary($contactPersonId)
    {
        $this->client->post(static::API_PATH.'/'.$contactPersonId.'/primary', $this->organizationId);

        return true;
    }
}
