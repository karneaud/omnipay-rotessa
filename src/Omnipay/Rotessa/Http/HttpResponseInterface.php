<?php
namespace Omnipay\Rotessa\Http;

interface HttpResponseInterface
{
    public function getStatusCode() : int;
    public function getReasonPhrase(): string;
}