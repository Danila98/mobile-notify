<?php
namespace MobileNotify\Core\Services\Client;
use MobileNotify\Lib\Response\SendAttempt;
interface IClient
{
    public function getTypeMethod() ;
    public function send(string $msg, string $number) ;
}