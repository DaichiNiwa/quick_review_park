<?php

class User
{
    public $id;
    public $name;
    public $password;

    public static function store($db, $name, $password)
    {
        $sql = "
            INSERT INTO
              users(name, password)
            VALUES (:name, :password);
          ";

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $params = [
            ':name' => $name,
            ':password' => $hash
        ];
        return execute_query($db, $sql, $params);
    }

    public static function find($db, $id)
    {
        $sql = "
            SELECT
              id, 
              name
            FROM
              users
            WHERE
              id = :id
            LIMIT 1
          ";

        $params = [
            ':id' => $id
        ];

        return fetch_object($db, $sql, 'User', $params);
    }

    public static function find_by_name($db, $name){
        $sql = "
        SELECT
          id,
          name,
          password
        FROM
          users
        WHERE
          name = :name
        LIMIT 1
        ";

        $params = [
            ':name' => $name
        ];

        return fetch_object($db, $sql, 'User', $params);
    }

    public function fetch_reviews($db)
    {
        $sql = "
            SELECT
                id,
                shop_id,
                user_id,
                created_at,
                id as self_id,
               (SELECT SUM(score) FROM sentences WHERE review_id = self_id) as total_score,
               (SELECT name FROM shops WHERE id = shop_id) as shop_name
            FROM
                reviews
            WHERE 
              user_id = :user_id
          ";

        $params = [
            ':user_id' => $this->id
        ];

        return fetch_all_objects($db, $sql, 'Review', $params);
    }
}



