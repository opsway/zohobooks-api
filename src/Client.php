<?php

namespace OpsWay\ZohoBooks;

use GuzzleHttp\Client as BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const ENDPOINT = 'https://books.zoho.com/api/v3/';

    /**
     * @var BaseClient
     */
    protected $httpClient;
    /**
     * @var string
     */
    protected $authToken;

    /**
     * Client constructor.
     *
     * @param string $authToken
     * @param string|null $email
     * @param string|null $password
     */
    public function __construct($authToken, $email = null, $password = null)
    {
        $this->httpClient = new BaseClient(['base_uri' => self::ENDPOINT, 'http_errors' => false]);
        if (!$authToken) {
            $authToken = $this->auth($email, $password);
        }
        $this->authToken = $authToken;
    }

    /**
     * @param string $url
     * @param string $organizationId
     * @param array $filters
     *
     * @return array
     */
    public function getList($url, $organizationId, array $filters)
    {
        return $this->processResult(
            $this->httpClient->get($url, ['query' => array_merge($this->getParams($organizationId), $filters)])
        );
    }

    /**
     * @param string $url
     * @param string $organizationId
     * @param string $id
     * @param array $params Additional query params
     *
     * @return array
     */
    public function get($url, $organizationId, $id, array $params = [])
    {
        return $this->processResult(
            $this->httpClient->get($url.'/'.$id, ['query' => $params + $this->getParams($organizationId)])
        );
    }

    /**
     * @param string $url
     * @param string $organizationId
     * @param array $data
     * @param array $params Additional query params
     *
     * @return array
     */
    public function post($url, $organizationId, array $data = [], array $params = [])
    {
        $body = [
            'query' => $params + $this->getParams($organizationId),
        ];
        if ($data) {
            $body['form_params'] = ['JSONString' => \GuzzleHttp\json_encode($data)];
        }
        return $this->processResult($this->httpClient->post($url, $body));
    }

    /**
     * @param string $url
     * @param string $organizationId
     * @param mixed $id
     * @param array $data
     * @param array $params Additional query params
     *
     * @return array
     */
    public function put($url, $organizationId, $id, array $data = [], array $params = [])
    {
        return $this->processResult($this->httpClient->put(
            $url.'/'.$id,
            [
                'query' => $params + $this->getParams($organizationId),
                'form_params' => ['JSONString' => \GuzzleHttp\json_encode($data)],
            ]
        ));
    }

    /**
     * @param string $url
     * @param string $organizationId
     * @param string $id
     *
     * @return array
     */
    public function delete($url, $organizationId, $id)
    {
        return $this->processResult(
            $this->httpClient->delete($url.'/'.$id, ['query' => $this->getParams($organizationId)])
        );
    }

    /**
     * @param string $organizationId
     * @param array $data
     *
     * @return array
     */
    protected function getParams($organizationId, array $data = [])
    {
        $params = [
            'authtoken' => $this->authToken,
            'organization_id' => $organizationId,
        ];
        if ($data) {
            $params['JSONString'] = \GuzzleHttp\json_encode($data);
        }

        return $params;
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws Exception
     *
     * @return array
     */
    protected function processResult(ResponseInterface $response)
    {
        try {
            if (preg_grep('/json/', $response->getHeader('Content-Type'))) {
                $result = \GuzzleHttp\json_decode($response->getBody(), true);
            } else {
                return $response->getBody();
            }
        } catch (\InvalidArgumentException $e) {
            $result = [
                'message' => 'Internal API error: '.$response->getStatusCode().' '.$response->getReasonPhrase(),
            ];
        }
        if (isset($result['code']) && 0 == $result['code']) {
            return $result;
        }
        throw new Exception('Response from Zoho is not success. Message: '.$result['message']);
    }

    /**
     * @param string|null $email
     * @param string|null $password
     *
     * @throws Exception
     *
     * @return string
     */
    private function auth($email, $password)
    {
        if (null === $email || null === $password) {
            throw new Exception('Please provide authToken OR Email & Password for auto authentication.');
        }
        $response = $this->httpClient->post(
            'https://accounts.zoho.com/apiauthtoken/nb/create',
            [
                'form_params' => [
                    'SCOPE' => 'ZohoBooks/booksapi',
                    'EMAIL_ID' => $email,
                    'PASSWORD' => $password,
                ],
            ]
        );
        $authToken = '';
        if (preg_match('/AUTHTOKEN=(?<token>[a-z0-9]+)/', (string) $response->getBody(), $matches)) {
            $authToken = $matches['token'];
        }

        return $authToken;
    }
}
