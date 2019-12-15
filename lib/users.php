<?php

/**
 * Initiation of user session
 */
function initSession() {
    session_start();
}

/**
 * Checks if user authorized:
 * Function returns TRUE if user is authorized, otherwise - FALSE
 *
 * @return bool
 */
function isAuth() {
    return isset($_SESSION['auth']);
}

/**
 * Performs user log in action
 *
 * @param $login
 * @param $password
 * @return bool
 */
function userLogIn($login, $password) {
    //$passwordHash = md5($password);
    $passwordHash = $password;
    $data = getRow(
        'SELECT * FROM `user` WHERE `email` = :login AND `password` = :password ',
        [
            'login' => $login,
            'password' => $passwordHash
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
function addUser($login, $password, $nickname) {
    $query = 'INSERT INTO `user` (`email`,`password`,`nickname`) VALUES (:login, :password, :nickname)';
    $params = [
        'login' => $login,
        'password' => $password,
        'nickname' => $nickname,
    ];

    $result = execQuery($query, $params);

    return $result === false ? false : true;
}
