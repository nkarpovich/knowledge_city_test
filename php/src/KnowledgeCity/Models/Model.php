<?php

namespace KnowledgeCity\Models;

use KnowledgeCity\DataBase;
use KnowledgeCity\Exceptions\Http500Exception;
use KnowledgeCity\Pagination;

abstract class Model
{
    protected const TABLE = '';

    public static function findAll(): array
    {
        $db = DataBase::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return ['data'=>$db->query($sql, static::class)];
    }

    /**
     * @throws Http500Exception
     */
    public static function find(array $params): array {
        $db = DataBase::instance();
        $sql = 'SELECT * FROM ' . static::TABLE.' WHERE ';
        $data = [];
        $whereStatements = [];
        foreach ($params as $fieldName=>$value){
            $data[':' . $fieldName] = $value;
            $whereStatements[] = $fieldName.' = :'.$fieldName;
        }
        $sql.=implode(' AND ',$whereStatements);
        return $db->query($sql,static::class,$data);
    }

    public static function paginate(int $page=1, int $perPage=5, string $path = ''): array{
        $db = DataBase::instance();
        $totalCount = self::getTotalCount();
        $sql = 'SELECT * FROM ' . static::TABLE. ' LIMIT :limit OFFSET :offset';
        $params = ['limit'=>$perPage,'offset'=>($perPage*($page-1))];
        $pagination = new Pagination($page,$perPage,$totalCount,$path);
        $paginationResponseParams = $pagination->getPaginationParams();
        $res = [
            'data'=>$db->query($sql, static::class,$params),
            'total'=>$totalCount
        ];
        return array_merge($res,$paginationResponseParams);
    }

    public static function getTotalCount(){
        $db = DataBase::instance();
        $totalSql = 'SELECT COUNT(*) as total FROM ' . static::TABLE;
        $totalRes = $db->query($totalSql,static::class);
        return $totalRes[0]->total;
    }

    public function insert()
    {
        $props = get_object_vars($this);

        $columns = [];
        $binds = [];
        $data = [];
        foreach ($props as $name => $value) {
            $columns[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' 
        (' . implode(',', $columns) . ') 
        VALUES (' . implode(',', $binds) . ' )';

        $db = DataBase::instance();
        $db->execute($sql, $data);
    }
}