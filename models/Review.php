<?php
require_once 'db.php';

class Review
{
    public $id;
    public $shop_id;
    public $user_id;
    public $created_at;
    private $total_score = 0;
    public $contents;
    public $shop_name = '';
    public $user_name = '';

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

    public static function find_with_contents($db, $id)
    {
        $review = self::find($db, $id);
        $review->contents = $review->fetch_contents($db);

        return $review;
    }

    public static function find($db, $id)
    {
        $sql = "
            SELECT
                id, 
                shop_id,
                user_id,
                created_at,
               (SELECT SUM(score) FROM sentences WHERE review_id = :review_id) as total_score
            FROM
                reviews
            WHERE
                id = :id
            LIMIT 1;
          ";

        $params = [
            ':id' => $id,
            ':review_id' => $id
        ];

        return fetch_object($db, $sql, 'Review', $params);
    }

    /**
     * @return float
     */
    public function formatted_total_score() {
        return round($this->total_score, 1);
    }

    public function fetch_contents($db)
    {
        $sql = "
            SELECT
              *
            FROM
              sentences
            WHERE 
              review_id = :review_id
          ";

        $params = [
            ':review_id' => $this->id
        ];

        return fetch_all_objects($db, $sql, 'Sentence', $params);
    }
}



