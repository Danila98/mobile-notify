<? 
namespace Lib\Response;

class SendAttempt
{
    protected bool $status;
    protected string $service;

    public function __construct(bool $status, string $service)
    {
        $this->status = $status;
        $this->service = $service;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getService()
    {
        return $this->service;
    }
}