<?php
namespace MobileNotify\Lib\Response;
class SendResponse
{
    protected $status;
    protected $service;
    protected $logs;

    public function setStatus(bool $status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setService(string $service)
    {
        $this->service = $service;
    }
    public function getService()
    {
        return $this->service;
    }
    public function addLog(SendAttempt $sendAttempt)
    {
        $this->logs[] = $sendAttempt;
    }
    public function getLogs()
    {
        return $this->logs;
    }
}