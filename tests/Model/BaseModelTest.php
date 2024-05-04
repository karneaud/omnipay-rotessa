<?php

namespace Omnipay\Rotessa\Tests\Model;

use Omnipay\Rotessa\Model\BaseModel;
use Omnipay\Tests\TestCase;

class BaseModelTest extends TestCase
{
    /** @var BaseModel */
    private $basedModel;

    protected function setUp(): void
    {
        $this->basedModel = new BaseModel();
    }

    public function testGetParameter()
    {
        // Populate the model with random parameters
        $parameters = [
            'id' => '123456',
            // Add more parameters as needed...
        ];
        $this->basedModel->initialize($parameters);

        // Assert that the 'getParameter' method exists
        $this->assertTrue(method_exists($this->basedModel, 'getParameter'));

        // Assert that the 'id' parameter equals '123456'
        $this->assertEquals('123456', $this->basedModel->id);

        $this->assertStringContainsString('123456', json_encode($this->basedModel, true));
    }
}
