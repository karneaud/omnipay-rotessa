<?php
namespace Omnipay\Rotessa\Model;

use JsonSerializable;
use Omnipay\Rotessa\Model\BaseModel;
use Omnipay\Rotessa\Model\ModelInterface;

class ErrorsModel extends BaseModel implements ModelInterface {

    protected $properties;

    protected $attributes = [
                    "errors" => "array", 
            ];
	
    public const DATE_FORMAT = 'Y-m-d H:i:s';

	private $_is_error = false;

	protected $defaults = ["errors" =>0,];

    protected $required = ["errors",];
}
