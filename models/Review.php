<?php
require_once 'db.php';

class Review
{
    public $id;
    public $shop_id;
    public $user_id;
    public $created_at;
    public $total_score = 0;

    public static function store($db, $shop_id, $user_id)
    {
        $sql = "
            INSERT INTO
              reviews(shop_id, user_id)
            VALUES (:shop_id, :user_id);
          ";

        $params = [
            ':shop_id' => $shop_id,
            ':user_id' => $user_id
        ];

        return execute_query($db, $sql, $params);
    }

    public static function find($db, $id)
    {
        $sql = "
            SELECT
              *
            FROM
              reviews
            WHERE
              id = :id
            LIMIT 1
          ";

        $params = [
            ':id' => $id
        ];

        return fetch_object($db, $sql, 'Review', $params);
    }

    public static function all($db)
    {
        $sql = "
            SELECT
              *
            FROM
              reviews
          ";

        return fetch_all_objects($db, $sql, 'Review');
    }
}



