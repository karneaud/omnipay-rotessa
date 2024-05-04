<?php
namespace Omnipay\Rotessa;

use Omnipay\Rotessa\ApiTrait;
use Omnipay\Rotessa\AbstractClient;
use Omnipay\Rotessa\ClientInterface;

class Gateway extends AbstractClient implements ClientInterface {
    
    use ApiTrait;

    protected $default_parameters = ['api_key' => 1234567890 ];

    protected $test_mode = true;

    public function getName()
    {
        return 'Rotessa';
    }

    public function getDefaultParameters() : array
    {
        return array('api_key' => '1234567890', 'test_mode' => $this->test_mode );
    }

    public function setTestMode($value) {
          $this->test_mode = $value;
    }

    protected function createRequest($class_name, ?array $parameters = [] ) :RequestInterface {
        $class = null;
        $class_name = "Omnipay\\Rotessa\\Message\\Request\\$class_name";
        $parameters = array_merge($parameters, $this->getDefaultParameters());
        $parameters = $class_name::hasModel() ? (($parameters = ($class_name::getModel($parameters)))->validate() ? $parameters->__toArray() : null ) : $parameters;
     
        try {
          $class = new $class_name($this->httpClient, $this->httpRequest, $parameters);
        } catch (\Throwable $th) {
          throw $th;
        } 
      
        return $class;
    }

    function canAuthorize() {
        return true;
    }

    function canCapture() {
        return false;
    }

    function authorize() {

    }

}