<?php
namespace Omnipay\Rotessa\Model;

use JsonSerializable;
use Omnipay\Rotessa\Model\BaseModel;
use Omnipay\Rotessa\Model\ModelInterface;

class ErrorModel extends BaseModel implements ModelInterface {

    protected $properties;

    protected $attributes = [
                    "error_code" => "string", 
                    "error_message" => "string", 
            ];
	
    public const DATE_FORMAT = 'Y-m-d H:i:s';

	private $_is_error = false;

	protected $defaults = ["error_code" =>'0',"error_message" =>'0',];

    protected $required = ["error_code","error_message",];
}
