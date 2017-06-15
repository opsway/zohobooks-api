<?php

namespace OpsWay\ZohoBooks\Tests\Api;

use OpsWay\ZohoBooks\Api\BaseApi;
use OpsWay\ZohoBooks\Client;
use PHPUnit\Framework\TestCase;

class BaseApiTest extends TestCase
{
    const ORG_ID = 1;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $client;
    /**
     * @var BaseApi
     */
    private $baseApi;

    public function setUp()
    {
        $this->client = $this->createMock(Client::class);
        $this->baseApi = new BaseApi($this->client, self::ORG_ID);
    }

    public function testGetList()
    {
        $filter = ['test' => '123'];
        $this->client->expects($this->once())
            ->method('getList')
            ->with('', self::ORG_ID, $filter)
            ->willReturn([
                's' => [ // List of item
                    ['id' => 1],
                    ['id' => 2],
                    ['id' => 3]
                ],
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
}
