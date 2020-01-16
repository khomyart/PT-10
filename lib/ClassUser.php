<?php


class User
{
    public function initSession() {
        session_start();
    }

    public function isAuth() {
        return isset($_SESSION['auth']);
    }

    public function userLogIn($login, $password) {
        //$passwordHash = md5($password);
        $passwordHash = $password;
        $log = $_POST['login'];
        $pwd = $_POST['pwd'];

        $data = DB::getInstance()->getRow(
            'SELECT * FROM `user` WHERE `email` = :l AND `password` = :p ',
            [
                'l' => $login,
                'p' => $passwordHash
            ]
        );

        if (empty($data)) {
            return false;
        }

        $_SESSION['auth'] = [
            'email' => $data['email'],
            'nickname' => $data['nickname'],
        ];

        return true;
    }

    /**
     * Adds a new user to DB
     *
     * @param $login
     * @param $password
     * @param $nickname
     * @return bool
     */
    public function addUser($login, $password, $nickname) {
        $query = 'INSERT INTO `user` (`email`,`password`,`nickname`) VALUES (:login, :password, :nickname)';
        $params = [
            'login' => $login,
            'password' => $password,
            'nickname' => $nickname,
        ];

        $result = DB::getInstance()->execQuery($query, $params);

        return $result === false ? false : true;
    }
}
