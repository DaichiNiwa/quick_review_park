<?php

class Sentence
{
    public $id;
    public $review_id;
    public $body;
    public $order_number;
    public $score;
    public $created_at;

    public static function store($db, $review_id, $body, $order_number, $score)
    {
        $sql = "
            INSERT INTO
              sentences(review_id, body, order_number, score)
            VALUES (:review_id, :body, :order_number, :score);
          ";

        $params = [
            ':review_id' => $review_id,
            ':body' => $body,
            ':order_number' => $order_number,
            ':score' => $score
        ];

        return execute_query($db, $sql, $params);
    }
}



