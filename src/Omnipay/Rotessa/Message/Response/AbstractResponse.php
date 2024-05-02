<?php
namespace Omnipay\Rotessa\Message\Response;

use Omnipay\Rotessa\Http\HttpResponseInterface;

abstract class AbstractResponse implements ResponseInterface
{
    protected $http_response;

    public function getData(): mixed {
       return $this->getParameters(); 
    }

    public function getHttpResponse(): HttpResponseInterface {
        return $this->http_response;
    }
    
    public function getCode() : int {
        return (int) $this->getHttpResponse()->getStatusCode();
    }

    public function getMessage(): string {
        return $this->getHttpResponse()->getReasonPhrase();
    }

    abstract public function getParameters() : array;

    abstract public function getParameter(string $key): mixed ;
}