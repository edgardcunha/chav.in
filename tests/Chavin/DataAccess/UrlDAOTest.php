<?php
namespace Chavin\DataAccess;

class UrlDAOTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PDO
     */
    protected $pdo;

    protected function setUp()
    {
        $this->pdo = new \PDO("sqlite::memory:");
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

    public function testInsertAUrl()
    {
        $urlDao = new UrlDAO($this->pdo);
        $url = "http://www.google.com";
        $id = $urlDao->save($url);

        $this->assertEquals(1, $id);

        $retrievedUrl = $urlDao->get($id);

        $this->assertEquals($url, $retrievedUrl);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInsertAUrlWithEmptyUrlParameter()
    {
        $urlDao = new UrlDAO($this->pdo);
        $urlDao->save("");
    }

    /**
     * @depends testInsertAUrl
     */
    public function testComputesAccessAndRetrievesNumberOfAccess()
    {
        $urlDao = new UrlDAO($this->pdo);
        $url = "http://www.google.com";
        $id = $urlDao->save($url);

        for ($i = 0; $i < 10; $i++) {
            $urlDao->access($id);
        }

        $numberOfAccess = $urlDao->count($id);

        $this->assertEquals(10, $numberOfAccess);
    }

    protected function tearDown()
    {
        $this->pdo->exec("DROP TABLE url");
    }
}
