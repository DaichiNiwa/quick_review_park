<?php

class Validator
{
    /**
     * @param $name
     * @param $password
     * @param $password_confirmation
     * @param $db
     * @return bool
     */
    public function signup($name, $password, $password_confirmation, $db)
    {
        // 短絡評価を避けるため一旦代入。
        $is_valid_user_name = $this->is_valid_user_name($name, $db);
        $is_valid_password = $this->is_valid_password($password, $password_confirmation);
        return $is_valid_user_name && $is_valid_password;
    }

    /**
     * @param $name
     * @param $db
     * @return bool
     */
    private function is_valid_user_name($name, $db)
    {
        $is_valid = true;
        if (!$this->is_valid_length($name, USER_NAME_LENGTH_MIN, USER_NAME_LENGTH_MAX)) {
            set_error('名前は' . USER_NAME_LENGTH_MIN . '文字以上、' . USER_NAME_LENGTH_MAX . '文字以内にしてください。');
            $is_valid = false;
        }
        if (!$this->is_alphanumeric($name)) {
            set_error('名前は半角英数字で入力してください。');
            $is_valid = false;
        }
        if(!$this->is_unique_user_name($db, $name)){
            set_error('この名前はすでに使われています。');
            $is_valid = false;
        }
        return $is_valid;
    }

    /**
     * @param $db
     * @param $name
     * @return bool
     */
    private function is_unique_user_name($db, $name)
    {
        if ($this->count_name($db, $name, 'users') <= 0) {
            return true;
        }

        return false;
    }

    /**
     * @param $password
     * @param $password_confirmation
     * @return bool
     */
    private function is_valid_password($password, $password_confirmation)
    {
        $is_valid = true;
        if (!$this->is_valid_length($password, USER_PASSWORD_LENGTH_MIN, USER_PASSWORD_LENGTH_MAX)) {
            set_error('パスワードは' . USER_PASSWORD_LENGTH_MIN . '文字以上、' . USER_PASSWORD_LENGTH_MAX . '文字以内にしてください。');
            $is_valid = false;
        }
        if (!$this->is_alphanumeric($password)) {
            set_error('パスワードは半角英数字で入力してください。');
            $is_valid = false;
        }
        if ($password !== $password_confirmation) {
            set_error('パスワードがパスワード(確認用)と一致しません。');
            $is_valid = false;
        }

        return $is_valid;
    }

    /**
     * @param $name
     * @param $detail
     * @param $db
     * @return bool
     */
    public function store_shop($name, $detail, $db)
    {
        // 短絡評価を避けるため一旦代入。
        $is_valid_shop_name = $this->is_valid_shop_name($name, $db);
        $is_valid_detail = $this->is_valid_detail($detail);
        return $is_valid_shop_name && $is_valid_detail;
    }

    /**
     * @param string $name
     * @param PDO $db
     * @return bool
     */
    private function is_valid_shop_name($name, $db)
    {
        $is_valid = true;
        if (!$this->is_valid_length($name, SHOP_NAME_LENGTH_MIN, SHOP_NAME_LENGTH_MAX)) {
            set_error('名前は' . SHOP_NAME_LENGTH_MIN . '文字以上、' . SHOP_NAME_LENGTH_MAX . '文字以内にしてください。');
            $is_valid = false;
        }
        if(!$this->is_unique_shop_name($db, $name)){
            set_error('この名前はすでに使われています。');
            $is_valid = false;
        }
        return $is_valid;
    }

    /**
     * @param $db
     * @param $name
     * @return bool
     */
    private function is_unique_shop_name($db, $name)
    {
        if ($this->count_name($db, $name, 'shops') <= 0) {
            return true;
        }

        return false;
    }

    /**
     * @param string $detail
     * @return bool
     */
    private function is_valid_detail($detail)
    {
        if (!$this->is_valid_length($detail, 0, SHOP_DETAIL_LENGTH_MAX)) {
            set_error('説明は' . SHOP_DETAIL_LENGTH_MAX . '文字以内にしてください。');
            return false;
        }
        return true;
    }

    /**
     * @param $review
     * @param $shop_id
     * @param $db
     * @return bool
     */
    public function store_review($review, $shop_id, $db)
    {
        // 短絡評価を避けるため一旦代入。
        $is_valid_review = $this->is_valid_review($review);
        $is_valid_shop_id = $this->is_existing_shop_id($db, $shop_id);
        return $is_valid_review && $is_valid_shop_id;
    }

    /**
     * @param $review
     * @return bool
     */
    private function is_valid_review($review)
    {
        if (!$this->is_valid_length($review, REVIEW_LENGTH_MIN, REVIEW_LENGTH_MAX)) {
            set_error('レビューは' . REVIEW_LENGTH_MIN . '文字以上、' . REVIEW_LENGTH_MAX . '文字以内にしてください。');
            return false;
        }
        return true;
    }

    /**
     * @param $db
     * @param $shop_id
     * @return bool
     */
    private function is_existing_shop_id($db, $shop_id)
    {
        if ($this->count_id($db, $shop_id, 'shops') === 1) {

            return true;
        }

        return false;
    }

    /**
     * @param PDO $db
     * @param int $id
     * @param string $table
     * @return int
     */
    private function count_id($db, $id, $table){
        $sql = "
            SELECT
              COUNT(id) as count
            FROM
              $table
            WHERE
              id = :id
          ";

        $params = [
            ':id' => $id,
        ];
        $count_id = fetch_query($db, $sql, $params);
        return $count_id['count'];
    }

    /**
     * @param PDO $db
     * @param string $name
     * @param string $table
     * @return int
     */
    private function count_name($db, $name, $table){
        $sql = "
            SELECT
              COUNT(name) as count
            FROM
              $table
            WHERE
              name = :name
          ";

        $params = [
            ':name' => $name,
        ];
        $count_name = fetch_query($db, $sql, $params);
        return $count_name['count'];
    }

    /**
     * @param string $string
     * @param int $minimum_length
     * @param int $maximum_length
     * @return bool
     */
    private function is_valid_length($string, $minimum_length, $maximum_length = PHP_INT_MAX)
    {
        $length = mb_strlen($string);
        return ($minimum_length <= $length) && ($length <= $maximum_length);
    }

    /**
     * @param $string
     * @return bool
     */
    private function is_alphanumeric($string)
    {
        return $this->is_valid_format($string, REGEXP_ALPHANUMERIC);
    }

    /**
     * @param $string
     * @param $format
     * @return bool
     */
    private function is_valid_format($string, $format)
    {
        return preg_match($format, $string) === 1;
    }
}