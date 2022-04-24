<?
namespace Core\Services; 
use Core\Services\Client\ViberClient;
use Core\Services\Client\SmsRuClient;
use Core\Services\Client\WhatsAppClient;
use Lib\DataAdapter\SendResponseAdapter;
use Lib\Response\SendResponse;

class Sender extends ISender
{
    protected $smsClient;
    protected $whatsAppClient;
    protected $viberClient;

    public function __construct(ViberClient $viberClient = null, WhatsAppClient $whatsAppClient = null, SmsRuClient $smsClient = null)
    {
        $this->smsClient = $smsClient;
        $this->whatsAppClient = $whatsAppClient;
        $this->viberClient = $viberClient;
    }
    public function send(string $msg, string $number)
    {
        $response = new SendResponse();


        if($this->viberClient && !$response->getStatus())
        {
            $res = $this->viberClient->send($msg, $number);
            $response->setStatus($res->getStatus());
            $response->setService($res->getService());
            $response->addLog($res);
        }
        if($this->whatsAppClient && !$response->getStatus())
        {
            $res = $this->whatsAppClient->send($msg, $number);
            $response->setStatus($res->getStatus());
            $response->setService($res->getService());
            $response->addLog($res);
        }
        if($this->smsClient && !$response->getStatus())
        {
            $res = $this->smsClient->send($msg, $number);
            $response->setStatus($res->getStatus());
            $response->setService($res->getService());
            $response->addLog($res);
        }
        $adapter = new SendResponseAdapter();
        return $adapter->getClientModelData($response);
    }
}