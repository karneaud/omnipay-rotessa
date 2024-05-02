<?php
namespace Omnipay\Rotessa\Message\Response;

use Omnipay\Rotessa\Http\HttpResponseInterface;

interface ResponseInterface
{
    public function getData(): mixed;
    public function getHttpResponse(): HttpResponseInterface;
    public function getCode() : int;
    public function getMessage(): string;
    public function getParameter(string $key): mixed ;
 }