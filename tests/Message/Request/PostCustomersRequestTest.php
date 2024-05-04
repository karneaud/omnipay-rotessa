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

    protected function setUp(): void
    {
         $this->postCustomers = new PostCustomers($this->getHttpClient(), $this->getHttpRequest(), ['test_mode' => true, 'api_key' => $this->api_key, 'customer_type' => 'Business',
         "name" => "Test Name","home_phone" => "0000000","phone" =>" 0000000","bank_name" => "Test Bank Name","institution_number" =>"128931198" ,"transit_number" => "09129012901","bank_account_type" => 'Savings',"authorization_type" => "Online","routing_number" => "109210129" ] );
    }

    public function testEndpoint()
    {
        $this->assertSame('https://sandbox-api.rotessa.com/v1/customers', $this->postCustomers->getEndpointUrl());
    }

    public function testSendOK()
    {
        
        $this->setMockHttpResponse('../../../Mock/Customers/post/200.txt');
        $response_array = json_decode(($this->getMockHttpResponse('../../../Mock/Customers/post/200.txt'))->getBody()->getContents() , true);
        $this->postCustomers->initialize(array_merge( $response_array, $this->postCustomers->getParameters(), ['address' => (object) $response_array['address']]));
        $response = $this->postCustomers->send();
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response_array, $response->getData());
    }

    public function testSendFail()
    {
        
        $this->setMockHttpResponse('../../../Mock/404.txt');
        $response_array = json_decode(($this->getMockHttpResponse('../../../Mock/Customers/post/200.txt'))->getBody()->getContents() , true);
        $this->postCustomers->initialize(array_merge( $response_array, $this->postCustomers->getParameters(),['address' => (object) $response_array['address']]));
        $response = $this->postCustomers->send();
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertFalse($response->isSuccessful());
    }
}
