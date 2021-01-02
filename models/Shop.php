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
              id,
              name,
              detail,
              id as self_id,
              (SELECT COUNT(id) FROM reviews WHERE shop_id = self_id) as total_reviews
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
              id,
              name,
              detail,
              id as self_id,
              (SELECT COUNT(id) FROM reviews WHERE shop_id = self_id) as total_reviews
            FROM
              shops
          ";

        return fetch_all_objects($db, $sql, 'Shop');
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
               (SELECT name FROM users WHERE id = user_id) as user_name
            FROM
                reviews
            WHERE 
              shop_id = :shop_id
          ";

        $params = [
            ':shop_id' => $this->id
        ];

        return fetch_all_objects($db, $sql, 'Review', $params);
    }

    public function get_average_score($db) {
        $sql = "
            SELECT
                id as self_id,
               (SELECT SUM(score) FROM sentences WHERE review_id = self_id) as total_score
            FROM
                reviews
            WHERE 
              shop_id = :shop_id
          ";

        $params = [
            ':shop_id' => $this->id
        ];

        $reviews = fetch_all_objects($db, $sql, 'Review', $params);

        return $this->calculate_average_score($reviews);
    }

    private function calculate_average_score($reviews) {
        $sum = 0;
        foreach ($reviews as $review) {
            $sum += $review->formatted_total_score();
        }

        if ($sum === 0) {
            return 0;
        }

        $average = $sum / count($reviews);
        return round($average, 1);
    }
}



