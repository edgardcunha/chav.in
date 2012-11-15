<?php
namespace Chavin\DataAccess\Entity;

use \InvalidArgumentException as Argument;

class Access
{
    protected $urlId;
    protected $visitorIp;
    protected $userAgent;

    public function __construct()
    {
    }

    public function setUrlId($id)
    {
        if (!is_int($id)) {
            throw new Argument("Url ID must be setted and must be a integer");
        }

        $this->urlId = $id;
    }

    public function getUrlId()
    {
        return $this->urlId;
    }

    public function setVisitorIp($visitorIp)
    {
        if (empty($visitorIp)) {
            throw new Argument("Empty IP is not allowed");
        }

        $this->visitorIp = $visitorIp;
    }

    public function getVisitorIp()
    {
        return $this->visitorIp;
    }

    public function setUserAgent($userAgent)
    {
        if (empty($userAgent)) {
            throw new Argument("Emtpy user agent is not allowerd");
        }
        $this->userAgent = $userAgent;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }
}
