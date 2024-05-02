<?php
namespace Omnipay\Rotessa\Model;

use JsonSerializable;
use Omnipay\Rotessa\Model\BaseModel;
use Omnipay\Rotessa\Model\ModelInterface;

class CustomerModel extends BaseModel implements ModelInterface {

    protected $properties;

    protected $attributes = [
                    "id" => "string", 
                    "custom_identifier" => "string", 
                    "name" => "string", 
                    "email" => "string", 
                    "customer_type" => "string", 
                    "home_phone" => "string", 
                    "phone" => "string", 
                    "bank_name" => "string", 
                    "institution_number" => "string", 
                    "transit_number" => "string", 
                    "bank_account_type" => "string", 
                    "authorization_type" => "string", 
                    "routing_number" => "string", 
                    "account_number" => "string", 
                    "address" => "object", 
                    "transaction_schedules" => "array", 
                    "financial_transactions" => "array", 
            ];
	
    public const DATE_FORMAT = 'Y-m-d H:i:s';

	private $_is_error = false;

	protected $defaults = ["custom_identifier" =>'0',"name" =>'0',"email" =>'0',"customer_type" =>'0',"home_phone" =>'0',"phone" =>'0',"bank_name" =>'0',"institution_number" =>'0',"transit_number" =>'0',"bank_account_type" =>'0',"authorization_type" =>'0',"routing_number" =>'0',"account_number" =>'0',"address" =>0,"transaction_schedules" =>0,"financial_transactions" =>0,];

    protected $required = ["custom_identifier","name","email","customer_type","home_phone","phone","bank_name","institution_number","transit_number","bank_account_type","authorization_type","routing_number","account_number","transaction_schedules","financial_transactions",];
}
