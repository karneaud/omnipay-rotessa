<?php
namespace Omnipay\Rotessa\Model;

use JsonSerializable;
use Omnipay\Rotessa\Model\BaseModel;
use Omnipay\Rotessa\Model\ModelInterface;

class TransactionSchedulesCreateWithCustomIdentifierBodyModel extends BaseModel implements ModelInterface {

    protected $properties;

    protected $attributes = [
                    "customer_identifier" => "string", 
                    "amount" => "string", 
                    "process_date" => "string", 
                    "frequency" => "string", 
                    "installments" => "int", 
                    "comment" => "string", 
            ];
	
    public const DATE_FORMAT = 'Y-m-d H:i:s';

	private $_is_error = false;

	protected $defaults = ["customer_identifier" =>'0',"amount" =>'0',"process_date" =>'0',"frequency" =>'0',"installments" =>0,"comment" =>'0',];

    protected $required = ["customer_identifier","amount","process_date","frequency","installments","comment",];
}
