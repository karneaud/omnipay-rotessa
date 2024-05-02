<?php
namespace Omnipay\Rotessa\Message\Request;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\Rotessa\Message\Request\RequestInterface;
use Omnipay\Rotessa\Message\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class BaseRequest extends AbstractRequest implements RequestInterface
{
    protected $base_url = 'rotessa.com';
    protected $api_version = 1;
    protected $endpoint = '';
    
    const ENVIRONMENT_SANDBOX = 'sandbox-api'; 
    const ENVIRONMENT_LIVE = 'api';

    function __construct($model, ClientInterface $http_client = null, HttpRequest $http_request ) {
        parent::__construct($http_client, $http_request );
        $this->initialize($model);
    }

    protected function sendRequest(string $method, string $endpoint, array $headers = [], array $data = [])
    {
        $request = $this->httpClient->createRequest($method, $endpoint);

        foreach ($headers as $header => $value) {
            $request = $request->withHeader($header, $value);
        }

        $request = $method == 'GET' ? $request : $request->withBody($streamFactory->createStream(json_encode($data)));
        
        $this->response = $this->httpClient->sendRequest($request);
    }


    protected function createResponse(array $data): ResponseInterface {
       return new BaseResponse($data);
    }


    protected function replacePlaceholder($string, $array) {
        $pattern = "/\{([^}]+)\}/";
        $replacement = function($matches) use($array) {
          $key = $matches[1];
          if (array_key_exists($key, $array)) {
            return $array[$key];
          } else {
            return $matches[0];
          }
        };
      
        return preg_replace_callback($pattern, $replacement, $string);
    }

    public function sendData($data) :ResponseInterface {
        $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
        ];

        print_r(['ok', $data]);

       $this->sendRequest(
                    $this->method,
                    $this->getEndpointUrl(),
                    $headers,
                    $data);

        return $this->createResponse($this->getResponse()->getBody()->getContents());
    }
      
    public function getEndpoint() : string {
        return $this->replacePlaceholder($this->endpoint, $this->getParameters());
    }

    public function getEndpointUrl() : string {
        return sprintf('https://%s.%s/v%d%s',$this->test_mode ? self::ENVIRONMENT_SANDBOX : self::ENVIRONMENT_LIVE ,$this->base_url, $this->api_version, $this->getEndpoint());
    }

    public static function hasModel() : bool {
        return (bool) static::$model;
    }

    public static function getModel($parameters = []) {
        $class_name = static::$model;
        $class_name = "Omnipay\\Rotessa\\Model\\{$class_name}Model";
        return new $class_name($parameters);
    }
}