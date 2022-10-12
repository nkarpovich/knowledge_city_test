<?php

namespace KnowledgeCity;
use KnowledgeCity\Exceptions\Http500Exception;
use PDO;

class DataBase
{
    private static $instance = null;

    protected PDO $db;

    private function __construct() {
        $this->db = new \PDO($_ENV['DB_CONNECTION'].':host='.
            $_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']);
    }

    public static function instance() {
        return self::$instance === null ? self::$instance = new static() : self::$instance;
    }

    public function query($sql, $class, $params = []): array
    {
        $sth = $this->db->prepare($sql);
        $res = $sth->execute($params);
        if (!$res) {
            throw new Http500Exception('Ошибка запроса: ' . $sql);
        }
        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function execute($sql, $options=[]): bool
    {
        $statement = $this->db->prepare($sql);
        return $statement->execute($options);
    }
}