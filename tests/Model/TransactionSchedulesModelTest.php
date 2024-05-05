<?php

namespace Omnipay\Tests\Model;

use Omnipay\Rotessa\Model\TransactionScheduleModel;
use Omnipay\Rotessa\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class TransactionScheduleModelTest extends TestCase
{
    /** @var TransactionScheduleModel */
    private $TransactionScheduleModel;
    private $parameters;
    protected function setUp(): void
    {
        $this->parameters = json_decode(file_get_contents(__DIR__ . '/../Mock/Transactions/post/parameters.json'), true);
        $this->TransactionScheduleModel = new TransactionScheduleModel($this->parameters);
    }

    public function testParameters()
    {
        $this->assertEquals($this->parameters['comment'], $this->TransactionScheduleModel->comment);
        $this->assertEquals($this->parameters['customer_id'], $this->TransactionScheduleModel->customer_id);
    }

    public function testJsonSerialize()
    {
        $this->assertStringContainsString('custom_id', json_encode($this->TransactionScheduleModel));
        $this->assertArrayHasKey('custom_identifier', $this->TransactionScheduleModel->jsonSerialize());
    }

    public function testValidateSuccessful()
    {
        // Set the parameters
        $this->assertTrue($this->TransactionScheduleModel->validate());
    }

    public function testValidateThrowsException()
    {
        // Set the 'bank_account_type' parameter to an invalid value
        $this->TransactionScheduleModel->comment = null;
        // Assert that the 'validate' method throws a 'ValidationException'
        $this->expectException(ValidationException::class);
        $this->TransactionScheduleModel->validate();
    }
}
