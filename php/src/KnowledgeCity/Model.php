<?php

namespace KnowledgeCity;

abstract class Model
{
    protected const TABLE = '';

    public static function findAll(): array
    {
        $db = DataBase::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, static::class);
    }
}