<?php
namespace Chavin\DataAccess;

use \PDO;
use \DateTime;
use \Chavin\DataAccess\Entity\Url;

class UrlDAOTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PDO
     */
    protected $pdo;

    protected function setUp()
    {
        $this->pdo = new PDO("sqlite::memory:");
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS url (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                original_url TEXT NOT NULL,
                log_datetime DATETIME NOT NULL,
                log_ip TEXT NOT NULL
            );
        ");
    }

    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Chavin\DataAccess\UrlDAO'),
            'Class not found: '.$class
        );
    }

    public function testInsertAUrlAndGetRetrievedUrlShouldWork()
    {
        $urlEntity = new Url();
        $url = "http://www.google.com";
        $urlEntity->setUrl($url);
        $urlEntity->setDateTime(new DateTime("now"));
        $urlEntity->setUserIp("192.168.1.6");

        $urlDao = new UrlDAO($this->pdo);
        $id = $urlDao->save($urlEntity);

        $this->assertEquals(1, $id);

        $retrievedUrl = $urlDao->get($id);

        $this->assertInstanceOf("Chavin\DataAccess\Entity\Url", $retrievedUrl);
        $this->assertEquals($retrievedUrl->getUrl(), $urlEntity->getUrl());
        $this->assertEquals($retrievedUrl->getDateTime(), $urlEntity->getDateTime());
        $this->assertEquals($retrievedUrl->getUserIp(), $urlEntity->getUserIp());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testInsertAUrlWithEmptyUrlParameterShouldThrownAnException()
    {
        $urlEntity = new Url();
        $urlDao = new UrlDAO($this->pdo);
        $id = $urlDao->save($urlEntity);

        $this->assertNotEquals(1, $id);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetAUrlWithEmptyIdParameterShouldThrownAnException()
    {
        $urlDao = new UrlDAO($this->pdo);
        $urlDao->get("");
    }

    protected function tearDown()
    {
        $this->pdo->exec("DROP TABLE url");
    }
}
