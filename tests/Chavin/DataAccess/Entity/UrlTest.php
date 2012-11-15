<?php
namespace Chavin\DataAccess\Entity;

use \DateTime;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Chavin\DataAccess\Entity\Url'),
            'Class not found: '.$class
        );
    }

    public function testInstantiationWithoutArgumentsShouldWork()
    {
        $url = new Url();
        $this->assertInstanceOf("Chavin\DataAccess\Entity\Url", $url);
    }

    public function testSetUrlWithValidDataShouldWork()
    {
        $url = new Url();
        $urlParameter = "http://www.google.com";
        $url->setUrl($urlParameter);
        $this->assertAttributeEquals($urlParameter, "url", $url,
            "Attribute was not correctly set");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetUrlWithEmtpyParameterShouldThrownAnException()
    {
        $url = new Url();
        $url->setUrl("");
    }

    /**
     * @depends testSetUrlWithValidDataShouldWork
     */
    public function testGetUrlShouldReturnADefinedUrl()
    {
        $url = new Url();
        $urlParameter = "http://www.google.com";
        $url->setUrl($urlParameter);

        $this->assertEquals($urlParameter, $url->getUrl());
    }

    public function testSetDateTimeShouldWorksWithDateTimeObjectParameter()
    {
        $url = new Url();
        $dateTimeParameter = new DateTime("now");
        $url->setDateTime($dateTimeParameter);
        $this->assertAttributeEquals($dateTimeParameter, 'dateTime', $url,
            "Attribute was not correctly set");
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetDateTimeWithInvalidDataShouldThrownAnException()
    {
        $url = new Url();
        $url->setDateTime("");
    }

    /**
     * @depends testSetDateTimeShouldWorksWithDateTimeObjectParameter
     */
    public function testGetDateTimeShouldReturnAStringWithDataTimeFormated()
    {
        $url = new Url();
        $expectedDate = "2001-09-11 23:59:59";
        $url->setDateTime(new DateTime($expectedDate));

        $this->assertEquals($expectedDate, $url->getDateTime());
    }

    public function testSetUserIpWithValidDataShouldWork()
    {
        $url = new Url();
        $userIp = "192.168.1.6";
        $url->setUserIp($userIp);

        $this->assertAttributeEquals($userIp, "userIp", $url,
            "Attribute was not correctly set");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetUserIpWithInvalidDataShouldThrownAnException()
    {
        $url = new Url();
        $url->setUserIp("");
    }

    /**
     * @depends testSetUserIpWithValidDataShouldWork
     */
    public function testGetUserIpShouldReturnTheDefineUserIp()
    {
        $url = new Url();
        $userIp = "192.168.1.6";
        $url->setUserIp($userIp);

        $this->assertEquals($userIp, $url->getUserIp());
    }
}
