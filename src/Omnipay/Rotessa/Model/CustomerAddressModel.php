<?php
namespace Omnipay\Rotessa\Model;

use JsonSerializable;
use Omnipay\Rotessa\Model\BaseModel;
use Omnipay\Rotessa\Model\ModelInterface;

class CustomerAddressModel extends BaseModel implements ModelInterface {

    protected $properties;

    protected $attributes = [
                    "address_1" => "string", 
                    "address_2" => "string", 
                    "city" => "string", 
                    "id" => "int", 
                    "postal_code" => "string", 
                    "province_code" => "string", 
            ];
	
    public const DATE_FORMAT = 'Y-m-d H:i:s';

	private $_is_error = false;

	protected $defaults = ["address_1" =>'0',"address_2" =>'0',"city" =>'0',"postal_code" =>'0',"province_code" =>'0',];

    protected $required = ["address_1","address_2","city","postal_code","province_code",];
}
