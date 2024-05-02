<?php
namespace Omnipay\Rotessa\Message\Request;
// You will need to create this BaseRequest class as abstracted from the AbstractRequest; 
use Omnipay\Rotessa\Message\Request\BaseRequest;
use Omnipay\Rotessa\Message\Request\RequestInterface;

class PostTransactionSchedulesUpdateViaPost extends BaseRequest implements RequestInterface
{
  
  protected $endpoint = '/transaction_schedules/update_via_post';
  protected $method = 'POST';
  protected static $model = 'TransactionSchedulesUpdateViaPostBody';


  
    public function setId(int $value) {
    $this->setParameter('id',$value);  
  }
    public function setAmount(int $value) {
    $this->setParameter('amount',$value);  
  }
    public function setComment(string $value) {
    $this->setParameter('comment',$value);  
  }
  }
