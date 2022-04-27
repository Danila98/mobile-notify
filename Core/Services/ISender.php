<?php
namespace MobileNotify\Core\Services;
use MobileNotify\Core\Services\Client\SmsRuClient;
use MobileNotify\Core\Services\Client\ViberClient;
use MobileNotify\Core\Services\Client\WhatsAppClient;

interface ISender
{
    public function __construct(ViberClient $viberClient = null, WhatsAppClient $whatsAppClient = null, SmsRuClient $smsClient = null);
    public function send(string $msg, string $number);
}