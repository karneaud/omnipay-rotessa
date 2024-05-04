<?php
namespace Omnipay\Rotessa\Message\Request;

use Omnipay\Rotessa\Message\Request\RequestInterface;

class PostTransactionSchedulesCreateWithCustomIdentifier extends PostTransactionSchedules implements RequestInterface
{
  
  protected $endpoint = '/transaction_schedules/create_with_custom_identifier';
  protected $method = 'POST';

    public function setCustomerId(string $value) {
      $this->setParameter('customer_identifier',$value);  
    }
    public function setAmount(string $value) {
    $this->setParameter('amount',$value);  
  }
    public function setProcess_date(string $value) {
    $this->setParameter('process_date',$value);  
  }
    public function setFrequency(string $value) {
    $this->setParameter('frequency',$value);  
  }
    public function setInstallments(int $value) {
    $this->setParameter('installments',$value);  
  }
    public function setComment(string $value) {
    $this->setParameter('comment',$value);  
  }
  }
