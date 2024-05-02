<?php
namespace Omnipay\Rotessa;

use Omnipay\Rotessa\Message\Response\ResponseInterface;

trait ApiTrait
{
      public function getCustomers() : ResponseInterface {
    return $this->createRequest('GetCustomers', null )->send();  
  }
    public function postCustomers(array $params) : ResponseInterface {
    return $this->createRequest('PostCustomers', $params )->send();  
  }
        public function getCustomersId(array $params) : ResponseInterface {
    return $this->createRequest('GetCustomersId', $params )->send();  
  }
    public function patchCustomersId(array $params) : ResponseInterface {
    return $this->createRequest('PatchCustomersId', $params )->send();  
  }
        public function postCustomersShowWithCustomIdentifier(array $params) : ResponseInterface {
    return $this->createRequest('PostCustomersShowWithCustomIdentifier', $params )->send();  
  }
        public function getTransactionSchedulesId(array $params) : ResponseInterface {
    return $this->createRequest('GetTransactionSchedulesId', $params )->send();  
  }
    public function deleteTransactionSchedulesId(array $params) : ResponseInterface {
    return $this->createRequest('DeleteTransactionSchedulesId', $params )->send();  
  }
    public function patchTransactionSchedulesId(array $params) : ResponseInterface {
    return $this->createRequest('PatchTransactionSchedulesId', $params )->send();  
  }
        public function postTransactionSchedules(array $params) : ResponseInterface {
    return $this->createRequest('PostTransactionSchedules', $params )->send();  
  }
        public function postTransactionSchedulesCreateWithCustomIdentifier(array $params) : ResponseInterface {
    return $this->createRequest('PostTransactionSchedulesCreateWithCustomIdentifier', $params )->send();  
  }
        public function postTransactionSchedulesUpdateViaPost(array $params) : ResponseInterface {
    return $this->createRequest('PostTransactionSchedulesUpdateViaPost', $params )->send();  
  }
     }
