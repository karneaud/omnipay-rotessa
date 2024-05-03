<?php

namespace Omnipay\Rotessa\Tests\Message\Response;

use Omnipay\Tests\TestCase;
use Omnipay\Rotessa\Message\Response\BaseResponse;
use Omnipay\Rotessa\Message\Request\RequestInterface;

class BaseResponseTest extends TestCase
{
    /** @var BaseResponse */
    private $baseResponse;

    protected function setUp(): void
    {
        $request = $this->createMock(RequestInterface::class);
        $this->baseResponse = new BaseResponse($request, ['param1' => 'value1'], 200, 'OK');
    }

    public function testGetData()
    {
        $this->assertEquals(['param1' => 'value1'], $this->baseResponse->getData());
    }

    public function testGetCode()
    {
        $this->assertEquals(200, $this->baseResponse->getCode());
    }

    public function testIsSuccessful()
    {
        $this->assertTrue($this->baseResponse->isSuccessful());
    }

    public function testGetMessage()
    {
        $this->assertEquals('OK', $this->baseResponse->getMessage());
    }

    public function testGetParameter()
    {
        $this->assertEquals('value1', $this->baseResponse->getParameter('param1'));
    }
}
