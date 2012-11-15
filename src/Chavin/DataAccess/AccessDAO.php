<?php
namespace Chavin\DataAccess;

use \PDO;
use \RuntimeException;
use \InvalidArgumentException as Argument;
use Chavin\DataAccess\Entity\Access;

class AccessDAO
{

    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Access $access)
    {
        $stm = $this->pdo->prepare("
            INSERT INTO access (
                url_id,
                visitor_ip,
                user_agent
            ) VALUES (
                :url_id,
                :visitor_ip,
                :user_agent
            );
        ");

        $stm->bindValue(":url_id", $access->getUrlId(), PDO::PARAM_INT);
        $stm->bindValue(":visitor_ip", $access->getVisitorIp(), PDO::PARAM_STR);
        $stm->bindValue(":user_agent", $access->getUserAgent(), PDO::PARAM_STR);

        if ($stm->execute()) {
            return true;
        }

        throw new RuntimeException("Fail to save access");
    }

    public function count($id)
    {
        if (is_int($id)) {
            $stm = $this->pdo->prepare("
                SELECT COUNT(1) FROM access WHERE url_id = :url_id
            ");

            $stm->bindValue(":url_id", $id, PDO::PARAM_INT);

            if ($stm->execute()) {
                $count = $stm->fetch();

                $stm->closeCursor();
            }

            return $count[0];
        }

        throw new Argument("Id must be setted and must be a integer");
    }
}
