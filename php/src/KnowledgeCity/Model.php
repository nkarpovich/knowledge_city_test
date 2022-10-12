<?php

namespace KnowledgeCity;

abstract class Model
{
    protected const TABLE = '';

    public static function findAll(): array
    {
        $db = DataBase::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return ['data'=>$db->query($sql, static::class)];
    }

    public static function paginate(int $page=1, int $perPage=5): array{
        $db = DataBase::instance();
        $totalCount = self::getTotalCount();
        $sql = 'SELECT * FROM ' . static::TABLE. ' LIMIT :limit OFFSET :offset';
        $params = ['limit'=>$perPage,'offset'=>($perPage*($page-1))];
        $pagination = new Pagination($page,$perPage,$totalCount);
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
}