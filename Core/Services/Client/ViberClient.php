<?php
namespace MobileNotify\Core\Services\Client;
use MobileNotify\Lib\Response\SendAttempt;

class ViberClient implements IClient
{
    private string $url_api = "https://chatapi.viber.com/pa/";
    private string $from;
    private string $token;

    public function __construct(string $token, string $adminId)
    {
        $this->token = $token;
        $this->from = $adminId;
    }
    final public function getTypeMethod()
    {
        return 'Viber';
    }
    public function send(string $msg, string $number)
    {
        $data['from']   = $this->from;
        $data['sender'] = $number;
        $data['type']   = 'text';
        $data['text']   = $msg;
        return $this->call('post', $data);
    }
    private function call($method, $data)
    {
        $url = $this->url_api.$method;

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\nX-Viber-Auth-Token: ".$this->token."\r\n",
                'method'  => 'POST',
                'content' => json_encode($data)
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        /**
         * Условие надо уточнить из результата запроса
         */
      $response = json_decode($response);
        if($response['status'] == "OK")
        {
            return new SendAttempt(true, $this->getTypeMethod());
        }else
        {
            return new SendAttempt(false, $this->getTypeMethod());
        }
    }
}