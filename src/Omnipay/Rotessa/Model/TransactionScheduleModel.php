<?php
namespace Omnipay\Rotessa\Model;

use JsonSerializable;
use Omnipay\Rotessa\Model\BaseModel;
use Omnipay\Rotessa\Model\ModelInterface;

class TransactionScheduleModel extends BaseModel implements ModelInterface {

    protected $properties;

    protected $attributes = [
                    "id" => "string", 
                    "amount" => "string", 
                    "comment" => "string", 
                    "created_at" => "string", 
                    "financial_transactions" => "array", 
                    "frequency" => "string", 
                    "installments" => "int", 
                    "next_process_date" => "string", 
                    "process_date" => "string", 
                    "updated_at" => "string", 
            ];
	
    public const DATE_FORMAT = 'Y-m-d H:i:s';

	private $_is_error = false;

	protected $defaults = ["amount" =>'0',"comment" =>'0',"created_at" =>'0',"financial_transactions" =>0,"frequency" =>'0',"installments" =>0,"next_process_date" =>'0',"process_date" =>'0',"updated_at" =>'0',];

    protected $required = ["amount","comment","created_at","financial_transactions","frequency","installments","next_process_date","process_date","updated_at",];
}
