<?php
namespace Chavin\DataAccess\Entity;

use \InvalidArgumentException as Argument;
use \DateTime;

class Url
{
    protected $url;
    protected $dateTime;
    protected $userIp;

    public function __construct()
    {
        $this->dateTime = new DateTime("now");
    }

    public function setUrl($url)
    {
        if (empty($url)) {
            throw new Argument("Empty url is not allowed");
        }

        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setDateTime(DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function getDateTime()
    {
        return $this->dateTime->format("Y-m-d H:i:s");
    }

    public function setUserIp($userIp)
    {
        if (empty($userIp)) {
            throw new Argument("Empty user IP is not allowed");
        }

        $this->userIp = $userIp;
    }

    public function getUserIp()
    {
        return $this->userIp;
    }
}
