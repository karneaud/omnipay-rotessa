<?php

namespace Omnipay\Rotessa\Tests\Message\Request;

use Omnipay\Rotessa\Message\Request\PostTransactionSchedules;
use Omnipay\Rotessa\Message\Request\RequestInterface;
use Omnipay\Rotessa\Message\Response\ResponseInterface;
use Omnipay\Tests\TestCase;

class PostTransactionSchedulesRequestTest extends TestCase
{
    /** @var PostTransactionSchedules */
    private $postTransactionSchedules;
    private $api_key = 1234567890;
    private $parameters;

    protected function setUp(): void
    {
         $this->parameters = json_decode(file_get_contents(__DIR__ . '/../../Mock/Transactions/post/parameters.json'), true);
         $this->postTransactionSchedules = new PostTransactionSchedules($this->getHttpClient(), $this->getHttpRequest(), ['test_mode' => true, 'api_key' => $this->api_key ] + $this->parameters);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://sandbox-api.rotessa.com/v1/transaction_schedules', $this->postTransactionSchedules->getEndpointUrl());
    }



    public function testCustomerId() {
        $this->assertNotNull($this->postTransactionSchedules->getData()['customer_id']);
    }

    public function testSendOK()
    {
        
        $this->setMockHttpResponse('../../../Mock/Transactions/post/200.txt');
        $this->postTransactionSchedules->initialize(array_merge( $this->parameters, $this->postTransactionSchedules->getParameters()));
        $response = $this->postTransactionSchedules->send();
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals((array) json_decode($this->getMockHttpResponse('../../../Mock/Transactions/post/200.txt')->getBody()->getContents(), true), $response->getData());
    }

    public function testSendFail()
    {
        $this->setMockHttpResponse('../../../Mock/404.txt');
        $this->postTransactionSchedules->initialize(array_merge( $this->parameters, $this->postTransactionSchedules->getParameters()));
        $response = $this->postTransactionSchedules->send();
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertFalse($response->isSuccessful());
    }
}
