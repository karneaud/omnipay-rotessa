<?php

namespace Omnipay\Tests\Model;

use Omnipay\Rotessa\Model\CustomerModel;
use Omnipay\Rotessa\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class CustomerModelTest extends TestCase
{
    /** @var CustomerModel */
    private $customerModel;

    protected function setUp(): void
    {
        $this->customerModel = new CustomerModel(['id' => '123456',
        'email' => 'test@example.com',
        'account_number' => '9876543210','address' => (object) [
            "address_1" => "Test Street", 
            "address_2" => "Test Suite", 
            "city" => "Miami",
            "postal_code" => "21312", 
            "province_code" => "NB 219", 
            "country" => "US"
        ]]);
    }

    public function testParameters()
    {
        // Assert that the 'id', 'email', and 'account_number' parameters have a value
        $this->assertEquals('123456', $this->customerModel->id);
        $this->assertEquals('test@example.com', $this->customerModel->email);
        $this->assertEquals('9876543210', $this->customerModel->account_number);
    }

    public function testValidateSuccessful()
    {
        // Set the parameters
        $this->customerModel->initialize([
            'customer_type' => 'Business',
            "name" => "Test Name","home_phone" => "0000000","phone" =>" 0000000","bank_name" => "Test Bank Name","institution_number" =>"128931198" ,"transit_number" => "09129012901","bank_account_type" => 'Savings',"authorization_type" => "Online","routing_number" => "109210129"
        ] + $this->customerModel->__toArray());

        // Assert that the 'validate' method returns true
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
