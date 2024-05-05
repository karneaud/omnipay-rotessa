<?php

namespace Omnipay\Rotessa\Tests\Functional;

use Omnipay\Rotessa\Gateway;
use Omnipay\Rotessa\Message\Request\RequestInterface;
use Omnipay\Rotessa\Message\Response\ResponseInterface;
use Omnipay\Tests\TestCase;

class RotessaGatewayTest extends TestCase
{
    /** @var \Omnipay\Rotessa\Gateway */
    protected $gateway;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setApiKey('abc123');
    }

    public function testIsInstanceof() {
        $this->assertInstanceOf(Gateway::class, $this->gateway);
    }

    public function testAuthorize()
    {
        $this->setMockHttpResponse('Customers/post/200.txt');
        $options = json_decode(file_get_contents(__DIR__ . '/../Mock/Customers/post/parameters.json'), true);
        $options['address'] = (object) $options['address'];
        $request = $this->gateway->authorize($options);

        $this->assertInstanceOf(RequestInterface::class, $request);

        $response = $request->send();

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertTrue($response->isSuccessful());
    }

    public function testCapture()
    {
        $this->setMockHttpResponse('Transactions/post/200.txt');
        $options = json_decode(file_get_contents(__DIR__ . '/../Mock/Transactions/post/parameters.json'), true);
        $request = $this->gateway->capture($options);

        $this->assertInstanceOf(RequestInterface::class, $request);

        $response = $request->send();

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertTrue($response->isSuccessful());
    }

    public function testFetchTransaction()
    {
        $this->setMockHttpResponse('Transactions/post/200.txt');
        $options = (array) json_decode($this->getMockHttpResponse('../../Mock/Transactions/post/200.txt')->getBody()->getContents(), true);
        $request = $this->gateway->fetchTransaction($options['id']);

        $this->assertInstanceOf(RequestInterface::class, $request);

        $response = $request->send();

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertTrue($response->isSuccessful());
    }
}
