<?php

namespace OpsWay\ZohoBooks;

use Psr\Http\Message\ResponseInterface;

class Client
{
    const ENDPOINT = 'https://books.zoho.com/api/v3/';
    protected $httpClient;
    protected $authToken;

    /**
     * Client constructor.
     *
     * @param      $authToken
     * @param null $email
     * @param null $password
     */
    public function __construct($authToken, $email = null, $password = null)
    {
        $this->httpClient = new \GuzzleHttp\Client(['base_uri' => self::ENDPOINT, 'http_errors' => false]);
        if (!$authToken) {
            $authToken = $this->auth($email, $password);
        }
        $this->authToken = $authToken;
    }

    private function auth($email, $password)
    {
        if (is_null($email) || is_null($password)) {
            throw new Exception('Please provide authToken OR Email & Password for auto authentication.');
        }
        $response = $this->httpClient->post(
            'https://accounts.zoho.com/apiauthtoken/nb/create',
            [
                'form_params' => [
                    'SCOPE'    => 'ZohoBooks/booksapi',
                    'EMAIL_ID' => $email,
                    'PASSWORD' => $password,
                ],
            ]
        );
        $authToken = '';
        if (preg_match('/AUTHTOKEN=(?<token>[a-z0-9]+)/', (string)$response->getBody(), $matches)) {
            $authToken = $matches['token'];
        }

        return $authToken;
    }

    public function getList($url, $organizationId, $filters)
    {
        return $this->processResult(
            $this->httpClient->get($url, ['query' => array_merge($this->getParams($organizationId), $filters)])
        );
    }

    public function get($url, $organizationId, $id)
    {
        return $this->processResult(
            $this->httpClient->get($url . '/' . $id, ['query' => $this->getParams($organizationId)])
        );
    }

    public function post($url, $organizationId, $data = [])
    {
        return $this->processResult($this->httpClient->post(
            $url,
            [
                'query' => $this->getParams($organizationId, $data)
            ]
        ));
    }

    public function put($url, $organizationId, $id, $data)
    {
        return $this->processResult($this->httpClient->put(
            $url . '/' . $id,
            [
                'query' => $this->getParams($organizationId, $data)
            ]
        ));
    }

    public function delete($url, $organizationId, $id)
    {
        return $this->processResult(
            $this->httpClient->delete($url . '/' . $id, ['query' => $this->getParams($organizationId)])
        );
    }

    protected function getParams($organizationId, array $data = [])
    {
        $params = [
            'authtoken'       => $this->authToken,
            'organization_id' => $organizationId,
        ];
        if (!empty($data)) {
            $params['JSONString'] = json_encode($data);
        }
        return $params;
    }

    protected function processResult(ResponseInterface $response)
    {
        try {
            $result = \GuzzleHttp\json_decode($response->getBody(), true);
        } catch (\InvalidArgumentException $e) {
            $result = [
                'message' => 'Internal API error: ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase()
            ];
        }
        if (isset($result['code']) && $result['code'] == 0) {
            return $result;
        }
        throw new Exception('Response from Zoho is not success. Message: ' . $result['message']);
    }
}
