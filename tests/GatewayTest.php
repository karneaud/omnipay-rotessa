<?php
namespace Omnipay\Rotessa\Tests;

use Omnipay\Rotessa\Gateway;
use Omnipay\Tests\TestCase;
use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\Rotessa\Message\RequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class GatewayTest extends TestCase
{
    /** @var Gateway */
    private $gateway;

    protected function setUp(): void
    {
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testGetName()
    {
        $this->assertEquals('Rotessa', $this->gateway->getName());
    }

    public function testImplementsGatewayInterface()
    {
        $this->assertInstanceOf(GatewayInterface::class, $this->gateway);
    }
}
