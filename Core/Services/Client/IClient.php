<?
namespace MobileNotify\Core\Services\Client;
use Lib\Response\SendAttempt;
interface IClient
{
    public function getTypeMethod() : string;
    public function send(string $msg, string $number) : SendAttempt;
}