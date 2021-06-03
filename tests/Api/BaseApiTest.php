<?php

namespace OpsWay\ZohoBooks\Tests\Api;

use OpsWay\ZohoBooks\Api\BaseApi;
use OpsWay\ZohoBooks\Client;
use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BaseApiTest extends TestCase
{
    const ORG_ID = 1;
    /**
     * @var Client&MockObject
     */
    private $client;
    /**
     * @var BaseApi
     */
    private $baseApi;
    /**
     * @var ClientInterface
     */
    private $customHttpClient;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = $this->createMock(Client::class);
        $this->baseApi = new BaseApi($this->client, self::ORG_ID);
        $this->customHttpClient = $this->createMock(BaseClient::class);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testCustomHttpClient()
    {
        $this->customHttpClient->expects($this->any())
            ->method('getConfig')
            ->with('http_errors')
            ->willReturn(false)
        ;

        new Client('authToken', null, null, $this->customHttpClient);
    }

    public function testCustomHttpClientWithWrongHttpErrorsConfig()
    {
        $this->customHttpClient->expects($this->once())
            ->method('getConfig')
            ->with('http_errors')
            ->willReturn(true)
        ;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/Request option "http_errors" must be set to `false` at HTTP client/');

        new Client('authToken', null, null, $this->customHttpClient);
    }

    public function testCustomHttpClientWithRequestOptions()
    {
        $this->customHttpClient->expects($this->never())
            ->method('getConfig')
            ->with('http_errors')
            ->willReturn(true)
        ;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/If argument 4 is provided, argument 5 must be omitted or passed with an empty array as value/');

        new Client('authToken', null, null, $this->customHttpClient, ['verify' => true]);
    }

    public function testGetList()
    {
        $filter = ['test' => '123'];
        $this->client->expects($this->once())
            ->method('getList')
            ->with('base_path', self::ORG_ID, $filter)
            ->willReturn([
                'base_keys' => [ // List of item
                    ['id' => 1],
                    ['id' => 2],
                    ['id' => 3]
                ],
                'page_context' => [
                    'page' => 1,
                ]
            ]);
        $list = $this->baseApi->getList($filter);
        // Test iterable list
        $this->assertTrue(is_array($list) || $list instanceof \Traversable);
        // Test foreach list
        foreach ($list as $key => $item) {
            $this->assertEquals($key+1, $item['id']);
        }
        // Test directly access list by key
        $this->assertEquals(1, $list[0]['id']);
    }

    public function testGet()
    {
        $this->client->expects($this->once())
            ->method('get')
            ->with('base_path', self::ORG_ID, 1, ['test' => 'test'])
            ->willReturn([
                'base_key' => [ // List of item
                    'id' => 1,
                ],
            ]);
        $result = $this->baseApi->get(1, ['test' => 'test']);
        $this->assertEquals(['id' => 1], $result);
    }

    public function testCreate()
    {
        $data = ['number' => '123'];
        $this->client->expects($this->once())
            ->method('post')
            ->with('base_path', self::ORG_ID, $data, [])
            ->willReturn([
                'base_key' => [ // List of item
                    'id' => 1,
                ],
            ]);
        $result = $this->baseApi->create($data);
        $this->assertEquals(['id' => 1], $result);
    }

    public function testUpdate()
    {
        $data = ['base_key_id' => 123, 'number' => '123'];
        $this->client->expects($this->once())
            ->method('put')
            ->with('base_path', self::ORG_ID, 123, ['number' => '123'])
            ->willReturn([
                'base_key' => [ // List of item
                    'id' => 1,
                ],
            ]);
        $result = $this->baseApi->update($data);
        $this->assertEquals(['id' => 1], $result);
    }

    public function testDelete()
    {
        $id = 1;
        $this->client->expects($this->once())
            ->method('delete')
            ->with('base_path', self::ORG_ID, $id)
            ->willReturn([
                'base_key' => [],
            ]);
        $result = $this->baseApi->delete($id);
        $this->assertTrue($result);
    }
}
