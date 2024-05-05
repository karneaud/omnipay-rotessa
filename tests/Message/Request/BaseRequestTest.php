<?php

namespace Omnipay\Rotessa\Tests\Message\Request;

use Omnipay\Tests\TestCase;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Rotessa\Message\Request\BaseRequest;
use Omnipay\Rotessa\Message\Response\ResponseInterface;

class BaseRequestTest extends TestCase
{
    /** @var BaseRequest */
    private $baseRequest;
    private $api_key = 1234567890;

    protected function setUp(): void
    {
        parent::setUp();
        $this->baseRequest = new BaseRequest($this->getHttpClient(), $this->getHttpRequest(), ['data'=>'bar', 'test_mode' => true, 'api_key' => $this->api_key ]);
    }

    public function testImplementsRequestInterface()
    {
        $this->assertInstanceOf(RequestInterface::class, $this->baseRequest);
    }

    public function testGetEndpointUrl()
    {
        $this->assertEquals('https://sandbox-api.rotessa.com/v1', $this->baseRequest->getEndpointUrl());
    }

    public function testSendDataHeaders()
    {
        $response = $this->createMock(ResponseInterface::class);
        $request = $this->getMockBuilder(BaseRequest::class)
        ->setConstructorArgs([ $this->getHttpClient(), $this->getHttpRequest(), ['data'=>'bar', 'test_mode' => true ]])
        ->setMethods(['sendData', 'getData'])  // Only replace 'sendData' method
        ->getMock();
        $request->expects($this->once())
        ->method('sendData')
        ->willReturn($response);
        $response = $request->send();

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testSendDataReturnsResponseInterface()
    {
        $this->setMockHttpResponse('../../../Mock/404.txt');
        $response = $this->baseRequest->send();
        $request = $this->getMockedRequests()[0];
        $this->assertTrue($request->hasHeader('Authorization'));
        $header =  $request->getHeader('Authorization');
        $this->assertStringContainsString($this->api_key,  array_shift( $header));
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
    
}
