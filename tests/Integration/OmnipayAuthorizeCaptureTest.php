<?php

namespace Omnipay\Rotessa\Tests\Integration;

use Omnipay\Omnipay;
use Omnipay\Tests\TestCase;
use Omnipay\Rotessa\Gateway;
use Omnipay\Common\Http\Client;
use GuzzleHttp\Client as HttpClient;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\Rotessa\Message\Request\PostCustomers;
use Omnipay\Rotessa\Message\Response\ResponseInterface;
use Omnipay\Rotessa\Message\Request\PostTransactionSchedules;

class OmnipayAuthorizeCaptureTest extends TestCase
{
    /** @var \Omnipay\Rotessa\Gateway */
    protected $gateway;
    protected $customer;
    protected $transact;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gateway = Omnipay::create('Rotessa', new Client(new HttpClient ));
        $this->gateway->setApiKey($_ENV['ROTESSA_API_KEY']);
        $this->gateway->setTestMode(true);
        $this->customer = json_decode(file_get_contents(__DIR__ . '/../Mock/Customers/post/parameters.json'), true);
        $this->customer['address'] = (object) $this->customer['address'];
        $this->customer['custom_identifier'] = 'TEST' . substr(uniqid('',false),3,4);
        $this->transact = json_decode(file_get_contents(__DIR__ . '/../Mock/Transactions/post/parameters.json'), true);
    }

    public function testIsInstanceof() {
        $this->assertInstanceOf(Gateway::class, $this->gateway);
    }

    public function testHasApiKey() {
        $this->assertNotNull($this->gateway->getApiKey());
        $this->assertEquals($_ENV['ROTESSA_API_KEY'], $this->gateway->getApiKey());
    }

    public function testInTestMode() {
        $this->assertTrue( $this->gateway->getTestMode());
    }

    public function testAuthorizeCaptureCA() {
        $request = $this->gateway->authorize($this->customer);
        $response = $request->send();
        $data = $response->getData();
        $transaction = ['customer_id' => null, 'custom_identifier' => $data['custom_identifier'], 'process_date' => 'November 20, 2024' ] + $this->transact;
        $request = $this->gateway->capture($transaction);
        $t_response = $request->send();
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertNotNull($data);
        $this->assertArrayHasKey('id', $data);
        $this->assertNotNull($data['id']);
        $this->assertNotNull($data = $t_response->getData());
        $this->assertArrayHasKey('id', $data);
        $this->assertNotNull($data['id']);
        $this->assertEquals($transaction['amount'], $data['amount'] );
    }
}
