<?php

class Auth
{
    /**
     * @return bool
     */
    public static function check(){
        return get_session('user_id') !== '';
    }

    public static function user($db)
    {
        $login_user_id = get_session('user_id');

        return User::find($db, $login_user_id);
    }

    /**
     * @param $db
     * @param $name
     * @param $password
     * @return false | User
     */
    public static function login($db, $name, $password)
    {
        $user = User::find_by_name($db, $name);
        if (!$user || !password_verify($password, $user->password)) {
            return false;
        }
        set_session('user_id', $user->id);
        return $user;
    }
}



