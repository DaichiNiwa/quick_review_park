<?php

class ReviewStoreService
{
    public function execute($db, $review, $shop_id, $user_id)
    {
        // TODO: トランザクション入れる

        // TODO: APIリクエスト送信して受け取る

        $review = Review::store($db, $shop_id, $user_id);
        $review_id = $db->lastInsertId();

        $order_number = 1;
        foreach ($sentences as $sentence) {
            Sentence::store($sentence, $review_id, $order_number);
            $order_number ++;
        }

        // TODO: true, false返す
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
}



