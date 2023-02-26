<?php
namespace App\Core;

use PDO;
use App\Config;

class Database extends Config
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO($this->dbDsn, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("SET NAMES 'utf8'");
    }

    public function prepare($sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }
    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}
