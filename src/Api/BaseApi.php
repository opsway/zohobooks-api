<?php

namespace OpsWay\ZohoBooks\Api;

use OpsWay\ZohoBooks\Client;

class BaseApi
{
    const API_PATH = '';
    const API_KEY = '';

    /**
     * @var Client
     */
    protected $client;
    /**
     * @var string
     */
    protected $organizationId;

    /**
     * BaseApi constructor.
     *
     * @param Client $client
     * @param string $organizationId
     */
    public function __construct(Client $client, $organizationId)
    {
        $this->client = $client;
        $this->organizationId = $organizationId;
    }

    /**
     * @param array $filters
     *
     * @return array
     */
    public function getList(array $filters = [])
    {
        $response = $this->client->getList(static::API_PATH, $this->organizationId, $filters);

        return new ItemList($response[static::API_KEY.'s'], $response['page_context']);
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function get($id)
    {
        $response = $this->client->get(static::API_PATH, $this->organizationId, $id);

        return $response[static::API_KEY];
    }

    /**
     * @param array $data
     * @param array $params
     *
     * @return array
     */
    public function create(array $data, array $params = [])
    {
        $response = $this->client->post(static::API_PATH, $this->organizationId, $data, $params);

        return $response[static::API_KEY];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function update(array $data)
    {
        $id = $data[static::API_KEY.'_id'];
        unset($data[static::API_KEY.'_id']);
        $response = $this->client->put(static::API_PATH, $this->organizationId, $id, $data);

        return $response[static::API_KEY];
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $this->client->delete(static::API_PATH, $this->organizationId, $id);

        return true;
    }
}
