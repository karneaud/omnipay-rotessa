<?php
namespace Omnipay\Rotessa\Tests;

use Omnipay\Rotessa\Gateway;
use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\Rotessa\Message\RequestInterface;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class GatewayTest extends TestCase
{
    /** @var Gateway */
    protected $gateway;

    protected function setUp(): void
    {
        parent:: setUp();

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

    public function supportsFeatures() {
        $this->assertTrue($this->gateway->supportsAuthorize());
        $this->assertTrue($this->gateway->supportsCapture());
        $this->assertTrue($this->gateway->supportsFetchTransaction());
        $this->assertFalse($this->gateway->supportsCompleteAuthorize());
    }
}
