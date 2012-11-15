<?php
namespace Chavin\DataAccess;

use \PDO;
use \InvalidArgumentException as Argument;
use \RuntimeException;
use Chavin\DataAccess\Entity\Url;

class UrlDAO
{

    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Url $url)
    {
        $stm = $this->pdo->prepare("
            INSERT INTO url (
                original_url,
                log_datetime,
                log_ip
            ) VALUES (
                :original_url,
                :log_datetime,
                :log_ip
            );
        ");

        $stm->bindValue(":original_url", $url->getUrl(), PDO::PARAM_STR);
        $stm->bindValue(":log_datetime", $url->getDateTime(), PDO::PARAM_STR);
        $stm->bindValue(":log_ip", $url->getUserIp(), PDO::PARAM_STR);

        if ($stm->execute()) {
            return (int) $this->pdo->lastInsertId();
        }

        throw new RuntimeException("Fail to insert URL");
    }

    public function get($id)
    {
        if (is_int($id)) {
            $stm = $this->pdo->prepare("
                SELECT
                    original_url as url,
                    log_datetime as dateTime,
                    log_ip as userIp
                FROM url WHERE id = :id
            ");

            $stm->setFetchMode(PDO::FETCH_CLASS, "Chavin\DataAccess\Entity\Url");
            $stm->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stm->execute()) {
                $url = $stm->fetch();

                $stm->closeCursor();
            }

            return $url;
        }

        throw new Argument("Id must be setted and must be a integer");
    }
}
