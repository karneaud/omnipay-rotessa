<?php
namespace Omnipay\Rotessa\Message\Request;
// You will need to create this BaseRequest class as abstracted from the AbstractRequest; 
use Omnipay\Rotessa\Message\Request\BaseRequest;
use Omnipay\Rotessa\Message\Request\RequestInterface;

class PostCustomers extends BaseRequest implements RequestInterface
{
  
  protected $endpoint = '/customers';
  protected $method = 'POST';
  protected static $model = 'Customer';

  
    public function setId(string $value) {
    $this->setParameter('id',$value);  
  }
    public function setCustom_identifier(string $value) {
    $this->setParameter('custom_identifier',$value);  
  }
    public function setName(string $value) {
    $this->setParameter('name',$value);  
  }
    public function setEmail(string $value) {
    $this->setParameter('email',$value);  
  }
    public function setCustomer_type(string $value) {
    $this->setParameter('customer_type',$value);  
  }
    public function setHome_phone(string $value) {
    $this->setParameter('home_phone',$value);  
  }
    public function setPhone(string $value) {
    $this->setParameter('phone',$value);  
  }
    public function setBank_name(string $value) {
    $this->setParameter('bank_name',$value);  
  }
    public function setInstitution_number(string $value) {
    $this->setParameter('institution_number',$value);  
  }
    public function setTransit_number(string $value) {
    $this->setParameter('transit_number',$value);  
  }
    public function setBank_account_type(string $value) {
    $this->setParameter('bank_account_type',$value);  
  }
    public function setAuthorization_type(string $value) {
    $this->setParameter('authorization_type',$value);  
  }
    public function setRouting_number(string $value) {
    $this->setParameter('routing_number',$value);  
  }
    public function setAccount_number(string $value) {
    $this->setParameter('account_number',$value);  
  }
    public function setAddress(object $value) {
    $this->setParameter('address',$value);  
  }
    public function setTransaction_schedules(array $value) {
    $this->setParameter('transaction_schedules',$value);  
  }
    public function setFinancial_transactions(array $value) {
    $this->setParameter('financial_transactions',$value);  
  }
  }
