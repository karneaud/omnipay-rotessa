<?php

namespace Omnipay\Tests\Model;

use Omnipay\Rotessa\Model\CustomerModel;
use Omnipay\Rotessa\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class CustomerModelTest extends TestCase
{
    /** @var CustomerModel */
    private $customerModel;
    private $parameters;
    protected function setUp(): void
    {
        $this->parameters = json_decode(file_get_contents(__DIR__ . '/../Mock/Customers/post/parameters.json'), true);
        $this->customerModel = new CustomerModel($this->parameters);
    }

    public function testParameters()
    {
        $this->assertEquals($this->parameters['email'], $this->customerModel->email);
        $this->assertEquals($this->parameters['account_number'], $this->customerModel->account_number);
    }

    public function testValidateSuccessful()
    {
        // Set the parameters
        $this->assertTrue($this->customerModel->validate());
    }

    public function testValidateThrowsException()
    {
        // Set the 'bank_account_type' parameter to an invalid value
        $this->customerModel->bank_account_type = 'Invalid';
        // Assert that the 'validate' method throws a 'ValidationException'
        $this->expectException(ValidationException::class);
        $this->customerModel->validate();
    }
}
