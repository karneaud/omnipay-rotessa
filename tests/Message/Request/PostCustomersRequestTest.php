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

    protected function setUp(): void
    {
         $this->postCustomers = new PostCustomers($this->getHttpClient(), $this->getHttpRequest(), ['test_mode' => true ] );
    }

    public function testEndpoint()
    {
        $this->assertSame('https://sandbox-api.rotessa.com/v1/customers', $this->postCustomers->getEndpointUrl());
    }


    public function testSendOK()
    {
        
        $this->setMockHttpResponse('../../../Mock/Customers/post/200.txt');
        $response_array = json_decode(($this->getMockHttpResponse('../../../Mock/Customers/post/200.txt'))->getBody()->getContents() , true);
        $this->postCustomers->initialize(array_merge($response_array, ['address' => (object) $response_array['address']]));
        $response = $this->postCustomers->send();
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response_array, $response->getData());
    }
}
