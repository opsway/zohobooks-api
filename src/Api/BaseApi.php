<?php

namespace OpsWay\ZohoBooks\Api;

use OpsWay\ZohoBooks\Client;

class BaseApi
{
    const API_URL = '';
    const API_KEY = '';
    /**
     * @var Client
     */
    protected $client;
    protected $organizationId;

    /**
     * BaseApi constructor.
     *
     * @param Client $client
     * @param        $organizationId
     */
    public function __construct(Client $client, $organizationId)
    {
        $this->client = $client;
        $this->organizationId = $organizationId;
    }

    public function list(array $filters = [])
    {
        $response = $this->client->getList(static::API_URL, $this->organizationId, $filters);

        return $response[static::API_KEY.'s'];
    }

    public function get($id)
    {
        $response = $this->client->get(static::API_URL, $this->organizationId, $id);

        return $response[static::API_KEY];
    }

    public function create(array $data)
    {
        $response = $this->client->post(static::API_URL, $this->organizationId, $data);

        return $response[static::API_KEY];
    }

    public function update(array $data)
    {
        $id = $data[static::API_KEY.'_id'];
        unset($data[static::API_KEY.'_id']);
        $response = $this->client->put(static::API_URL, $this->organizationId, $id, $data);

        return $response[static::API_KEY];
    }

    public function delete($id)
    {
        $this->client->delete(static::API_URL, $this->organizationId, $id);

        return true;
    }
}
