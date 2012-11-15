<?php
namespace Chavin\DataAccess\Entity;

class AccessTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Chavin\DataAccess\Entity\Access'),
            'Class not found: '.$class
        );
    }

    public function testInstantiationWithoutArgumentsShouldWork()
    {
        $access = new Access();
        $this->assertInstanceOf("Chavin\DataAccess\Entity\Access", $access);
    }

    public function testSetUrlIdWithValidDataShouldWork()
    {
        $access = new Access();
        $id = 15;
        $access->setUrlId($id);
        $this->assertAttributeEquals($id, "urlId", $access,
            "Attribute was not correctly set");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetUrlIdWithInvalidDataShouldThrownAnException()
    {
        $access = new Access();
        $access->setUrlId("");
    }

    /**
     * @depends testSetUrlIdWithValidDataShouldWork
     */
    public function testGetUrlIdShouldReturnTheDefinedUrlId()
    {
        $access = new Access();
        $id = 69;
        $access->setUrlId($id);

        $this->assertEquals($id, $access->getUrlId());
    }

    public function testSetVisitorIpWithValidDataShouldWork()
    {
        $access = new Access();
        $visitorIp = "192.168.1.6";
        $access->setVisitorIp($visitorIp);

        $this->assertAttributeEquals($visitorIp, "visitorIp", $access,
            "Attribute was not correctly set");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetVisitorIpWithInvalidDataShouldThrownAnException()
    {
        $access = new Access();
        $access->setVisitorIp("");
    }

    /**
     * @depends testSetVisitorIpWithValidDataShouldWork
     */
    public function testGetVisitorIpShouldReturnTheDefinedVisitorIp()
    {
        $access = new Access();
        $visitorIp = "192.168.1.6";
        $access->setVisitorIp($visitorIp);

        $this->assertEquals($visitorIp, $access->getVisitorIp());
    }

    public function testSetUserAgentWithValidDataShouldWork()
    {
        $access = new Access();
        $userAgent = "Mozilla Chrome Mosaic Webkit";
        $access->setUserAgent($userAgent);

        $this->assertAttributeEquals($userAgent, "userAgent", $access,
            "Attributes was not correctly set");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetUserAgentWithInvalidDataShouldThrownAnException()
    {
        $access = new Access();
        $access->setUserAgent("");
    }

    /**
     * @depends testSetUserAgentWithValidDataShouldWork
     */
    public function testGetUserAgentShouldReturnTheDefinedUserAgent()
    {
        $access = new Access();
        $userAgent = "Microsoft Webkit Opera Links";
        $access->setUserAgent($userAgent);

        $this->assertEquals($userAgent, $access->getUserAgent());
    }
}
