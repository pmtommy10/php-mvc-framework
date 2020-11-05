<?php

namespace App\Core;

use \ClanCats\Hydrahon\Builder;
use \ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use PDO;
use PDOException;

final class Database
{

    private $host = DB_HOST;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private static $dbname = DB_NAME;

    private static $instance = null;
    private $connection;

    function __construct()
    {
        $dbname = self::$dbname;
        $dsn = "mysql: host={$this->host}; dbname=$dbname; charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        ];
        try {
            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            if (ENV === 'dev') {
                echo '<pre>'.print_r($e, true).'</pre>';
            } else {
                Translate::get('พบข้อบกพร่องในขั้นตอนการเชื่อมต่อกับฐานข้อมูล รหัส:').$e->getCode();
            }
            die();
        }
    }

    static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    static function connect()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }

    static function connectDatabase(string $dbname): PDO
    {
        self::$dbname = $dbname;
        $db = new self();
        return $db->connection;
    }

    static function buildQuery()
    {
        try {
            $pdo = Database::connect();
            $h = new Builder('mysql', function ($query, $queryString, $queryParameters) use ($pdo) {
                $statement = $pdo->prepare($queryString);
                $statement->execute($queryParameters);

                // when the query is fetchable return all results and let hydrahon do the rest
                // (there's no results to be fetched for an update-query for example)
                if ($query instanceof FetchableInterface) {
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                }
            });

            return $h;
        } catch (PDOException $e) {
            if ($pdo && $pdo->inTransaction()) {
                $pdo->rollBack();
            }
            throw new \Exception('พบข้อบกพร่องทางเทคนิค รหัส: ' . $e->getCode(), 1, $e);
        }
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}
