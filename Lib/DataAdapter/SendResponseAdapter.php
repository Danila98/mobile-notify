<?
namespace Lib\DataAdapter;
use Lib\Response\SendResponse;

class SendResponseAdapter
{
    public function getModelName()
    {
        return 'SendResponse';
    }
    public function getClientModelData(SendResponse $sendResponse)
    {
        $logs = [];
        foreach($sendResponse->getLogs() as $log)
        {
            $logs[] = ['status' => $log->getStatus(), 'service' => $log->getService()];
        }
        return [
            'status' => $sendResponse->getStatus(),
            'service' => $sendResponse->getService(),
            'logs' => $logs
        ];
    }
    public function getClientArrayModelData(array $sendResponses)
    {
        foreach($sendResponses as $sendResponse)
        {
            yield $this->getClientModelData($sendResponse);
        }
    }
}