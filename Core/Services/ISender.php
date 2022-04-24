<?

namespace Core\Services; 
use Core\Services\Client\IClient;

interface ISender
{
    public function __construct(IClient $smsClient = null, IClient $whatsAppClient = null, IClient $viberClient = null);
    public function send(string $msg, string $number);
}