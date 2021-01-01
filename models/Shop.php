<?php

class Shop
{
    public $id;
    public $name;
    public $detail;
    public $created_at;
    public $total_reviews = 0;
    public $average_score = 0;

    public static function store($db, $name, $detail)
    {
        $sql = "
            INSERT INTO
              shops(name, detail)
            VALUES (:name, :detail);
          ";

        $params = [
            ':name' => $name,
            ':detail' => $detail
        ];

        return execute_query($db, $sql, $params);
    }

    public static function find($db, $id)
    {
        $sql = "
            SELECT
              *
            FROM
              shops
            WHERE
              id = :id
            LIMIT 1
          ";

        $params = [
            ':id' => $id
        ];

        return fetch_object($db, $sql, 'Shop', $params);
    }

    public static function all($db)
    {
        $sql = "
            SELECT
              *
            FROM
              shops
          ";

        return fetch_all_objects($db, $sql, 'Shop');
    }
}



