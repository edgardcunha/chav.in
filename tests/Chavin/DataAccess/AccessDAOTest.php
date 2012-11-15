<?php
namespace Chavin\DataAccess;

use \PDO;
use Chavin\DataAccess\Entity\Access;

class AccessDAOTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PDO
     */
    protected $pdo;

    protected function setUp()
    {
        $this->pdo = new PDO("sqlite::memory:");
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS access (
                url_id INTEGER NOT NULL,
                visitor_ip TEXT NOT NULL,
                user_agent TEXT NOT NULL
            );
        ");
    }

    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Chavin\DataAccess\AccessDAO'),
            'Class not found: '.$class
        );
    }

    public function testComputesAccessAndRetrievesNumberOfAccess()
    {
        $accessEntity = new Access();
        $id = 76;
        $accessEntity->setUrlId($id);
        $accessEntity->setVisitorIp("192.168.1.6");
        $accessEntity->setUserAgent("Mozilla Internet Explorer");

        $accessDao = new AccessDAO($this->pdo);

        for ($i = 0; $i < 10; $i++) {
            $this->assertTrue($accessDao->save($accessEntity));
        }

        $numberOfAccess = $accessDao->count($id);

        $this->assertEquals(10, $numberOfAccess);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testComputeAnAccessWithInvalidParameterShouldThrownAnException()
    {
        $accessEntity = new Access();
        $accessDao = new AccessDAO($this->pdo);
        $this->assertFalse($accessDao->save($accessEntity));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetTheNumberOfAccessWithInvalidIdShouldThrownAnException()
    {
        $accessDao = new AccessDAO($this->pdo);
        $accessDao->count("");
    }

    protected function tearDown()
    {
        $this->pdo->exec("DROP TABLE access");
    }
}
