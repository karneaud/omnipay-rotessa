<?php
namespace Omnipay\Rotessa\Model;

use JsonSerializable;
use Omnipay\Rotessa\Model\BaseModel;
use Omnipay\Rotessa\Model\ModelInterface;

class CustomersShowWithCustomIdentifierBodyModel extends BaseModel implements ModelInterface {

    protected $properties;

    protected $attributes = [
                    "custom_identifier" => "string", 
            ];
	
    public const DATE_FORMAT = 'Y-m-d H:i:s';

	private $_is_error = false;

	protected $defaults = ["custom_identifier" =>'0',];

    protected $required = ["custom_identifier",];
}
