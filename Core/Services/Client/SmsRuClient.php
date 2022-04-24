<?
namespace MobileNotify\Core\Services\Client; 
use Lib\SmsRu\SMSRU;
use Lib\Response\SendAttempt;

class SmsRuClient implements IClient
{
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
    final public function getTypeMethod()
    {
        return 'Sms';
    }
    public function send(string $msg, string $number)
    {
        $smsru = new SMSRU($this->apiKey); // Ваш уникальный программный ключ, который можно получить на главной странице

        $data = new \stdClass();
        $data->to = $number;
        $data->text = $msg; // Текст сообщения
        // $data->from = ''; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
        // $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
        // $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
        // $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
        // $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
        $sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

        if ($sms->status == "OK") { // Запрос выполнен успешно
            $sms->sms_id;
            $sms->balance;
            return new SendAttempt(true, $this->getTypeMethod());
        } else {
            return new SendAttempt(false, $this->getTypeMethod());
            /**
             * TODO Логировать?
             *$sms->status_text;
             */

        }
    }
}