<?php

namespace Omnipay\Rotessa\Tests\Message\Request;

use Omnipay\Rotessa\Message\Request\PostCustomers;
use Omnipay\Rotessa\Message\Request\RequestInterface;
use Omnipay\Rotessa\Message\Response\ResponseInterface;
use Omnipay\Tests\TestCase;

class PostCustomersRequestTest extends TestCase
{
    /** @var PostCustomers */
    private $postCustomers;
    private $api_key = 1234567890;
    private $parameters;

    protected function setUp(): void
    {
         $this->parameters = json_decode(file_get_contents(__DIR__ . '/../../Mock/Customers/post/parameters.json'), true);
         $this->postCustomers = new PostCustomers($this->getHttpClient(), $this->getHttpRequest(), ['test_mode' => true, 'api_key' => $this->api_key ]);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://sandbox-api.rotessa.com/v1/customers', $this->postCustomers->getEndpointUrl());
    }

    public function testSendOK()
    {
        
        $this->setMockHttpResponse('../../../Mock/Customers/post/200.txt');
        $this->postCustomers->initialize(array_merge( $this->parameters, $this->postCustomers->getParameters(), ['address' => (object) $this->parameters['address']]));
        $response = $this->postCustomers->send();
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals((array) json_decode($this->getMockHttpResponse('../../../Mock/Customers/post/200.txt')->getBody()->getContents(), true), $response->getData());
    }

    public function testSendFail()
    {
        $this->setMockHttpResponse('../../../Mock/404.txt');
        $this->postCustomers->initialize(array_merge( $this->parameters, $this->postCustomers->getParameters(),['address' => (object) $this->parameters['address']]));
        $response = $this->postCustomers->send();
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertFalse($response->isSuccessful());
    }
}
