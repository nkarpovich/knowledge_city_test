<?php

namespace KnowledgeCity;

use KnowledgeCity\Exceptions\Http500Exception;
use PDO;

/**
 * Connection to the database
 * implements singleton pattern
 */
class DataBase
{
    private static ?self $instance = null;

    protected PDO $db;

    private function __construct() {
        $this->db = new \PDO($_ENV['DB_CONNECTION'] . ':host=' .
            $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public static function instance() {
        return self::$instance === null ? self::$instance = new static() : self::$instance;
    }

    /**
     * executes prepared sql and return fecthAll result
     * @param string $sql
     * @param $class
     * @param array $params
     * @return array
     * @throws Http500Exception
     */
    public function query(string $sql, $class, array $params = []): array {
        $sth = $this->db->prepare($sql);
        $res = $sth->execute($params);
        if (!$res) {
            throw new Http500Exception('Database query error: ' . $sql,500);
        }
        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }

    /**
     * executes SQL
     * @param string $sql
     * @param array $options
     * @return bool
     */
    public function execute(string $sql, array $options = []): bool {
        $statement = $this->db->prepare($sql);
        return $statement->execute($options);
    }
}