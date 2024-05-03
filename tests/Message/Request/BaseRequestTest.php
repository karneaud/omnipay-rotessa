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

    protected function setUp(): void
    {
        $this->baseRequest = new BaseRequest($this->getHttpClient(), $this->getHttpRequest(), ['data'=>'bar', 'test_mode' => true ]);
    }

    public function testImplementsRequestInterface()
    {
        $this->assertInstanceOf(RequestInterface::class, $this->baseRequest);
    }

    public function testGetEndpointUrl()
    {
        $this->assertEquals('https://sandbox-api.rotessa.com/v1', $this->baseRequest->getEndpointUrl());
    }

    public function testSendDataReturnsResponseInterface()
    {
        $response = $this->createMock(ResponseInterface::class);
        $request = $this->getMockBuilder(BaseRequest::class)
        ->setConstructorArgs([ $this->getHttpClient(), $this->getHttpRequest(), ['data'=>'bar', 'test_mode' => true ]])
        ->setMethods(['sendData'])  // Only replace 'sendData' method
        ->getMock();
        $request->expects($this->once())
        ->method('sendData')
        ->willReturn($response);
        $response = $request->send();

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}
