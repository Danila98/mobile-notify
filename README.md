Установка
------------

### Install via Composer

Установить пакет можно с помощью команды:

~~~
composer require sitisit/mobile-notify
~~~

Использование
------------

Для использования нужно создать экзмпляр Sender и передать в него до трех клиентов  viber, whatsapp, sms. Именно в таком порядке.
Если не нужен какой-либо из способов доставки, следует передать null

~~~
$smsClient = new SmsRuClient('api_key');
$viberClient = new ViberClient('api_key', 'admin_id');
$sender = new Sender($viberClient, null, $smsClient);
$result = $sender->send($model->message, $model->number);
~~~

В ответ вы получите результат подобного вида
~~~
{
"status": true,
"service": "sms",
"log": [
    {"service": ""viber", "status": false},
    {"service": ""whatsapp", "status": false},
    {"service": ""sms", "status": true},
]
}


{
"status": false,
"service": "sms",
"log": [
    {"service": ""viber", "status": false},
    {"service": ""whatsapp", "status": false},
    {"service": ""sms", "status": false},
]
}


{
"status": true,
"service": "viber",
"log": [
{"service": ""viber", "status": true},
]
}
~~~