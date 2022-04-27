<?
namespace MobileNotify\Core\Services\Client;
use MobileNotify\Core\Services\Client\IClient;
use MobileNotify\Lib\Response\SendAttempt;

class WhatsAppClient implements IClient
{
    protected string $token;
    protected string $instanceId;

    public function __construct(string $token, string $instanceId)
    {
        $this->token = $token;
        $this->instanceId = $instanceId;
    }
    final public function getTypeMethod()
    {
        return 'WhatsApp';
    }
    public function send(string $msg, string $number)
    {
        $data = [
            'phone' => $number,  // Телефон получателя
            'body' => $msg, // Сообщение
        ];
        $json = json_encode($data); // Закодируем данные в JSON
        // URL для запроса POST /message
        $url = 'https://api.chat-api.com/instance'.$this->instanceId.'/message?token='.$this->token;
        // Сформируем контекст обычного POST-запроса
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Отправим запрос
        $result = file_get_contents($url, false, $options);
                /**
         * Условие надо уточнить из результата запроса
         */
        if($result)
        {
            return new SendAttempt(true, $this->getTypeMethod());
        }else
        {
            return new SendAttempt(false, $this->getTypeMethod());
        }
    }
}