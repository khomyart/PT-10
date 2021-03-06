<?php

/**
 * Returns list\array of contacts
 *
 * @param $filter
 * @return array
 */
function getListOfContacts($filter = '')
{
    $query = 'SELECT * FROM `contact` WHERE `user_id` = :user_id ';
    $params = ['user_id' => $_SESSION['auth']['id']];

    if (is_string($filter) && (trim($filter) != '')) {
        $query .= ' AND ( (`first_name` LIKE :filter) OR (`last_name` LIKE :filter) OR (`phone` LIKE :filter) )';
        $params['filter'] = '%' . $filter . '%';
    }

    return getAllRows($query, $params);
}

/**
 * Returns join list\array of contacts
 *
 * @param $filter
 * @return array
 */
function getJoinListOfContacts($filter = '')
{
    $query = 'SELECT c.id, c.phone, c.first_name, c.last_name, u.email, u.nickname FROM `contact` AS c LEFT JOIN `user` AS u ON c.user_id = u.id WHERE 1';

    if (is_string($filter) && (trim($filter) != '')) {
        $query .= ' AND ( (c.first_name LIKE :filter) OR (c.last_name LIKE :filter) OR (c.phone LIKE :filter) OR (c.id LIKE :filter) OR (u.email LIKE :filter) OR (u.nickname LIKE :filter) )';
        $params['filter'] = '%' . $filter . '%';
    }

    return getAllRows($query, $params);
}

/**
 * Returns list\array of users
 *
 * @param $filter
 * @return array
 */
function getListOfUsers($filter = '')
{
    $query = 'SELECT * FROM `user` WHERE 1';

    if (is_string($filter) && (trim($filter) != '')) {
        $query .= ' AND ( (`email` LIKE :filter) OR (`nickname` LIKE :filter) OR (`type` LIKE :filter) )';
        $params['filter'] = '%' . $filter . '%';
    }

    return getAllRows($query, $params);
}

/**
 * Returns array with error messages
 *
 * @param string $phone
 * @param string $firstName
 * @param string $lastName
 * @return array
 */
function contactErrorList($phone, $firstName, $lastName)
{
    $phone = trim($phone);
    $firstName = trim($firstName);
    $lastName = trim($lastName);

    if (strlen($phone) !== 0) {
        if(strlen($phone) > 20) {
            $feedbackContactError['phone'] = 'Phone max. length is 20 symbols';
        }
    } else {
        $feedbackContactError['phone'] = 'Phone field be empty';
    }

    if (strlen($firstName) !== 0) {
        if(strlen($firstName) > 30) {
            $feedbackContactError['firstName'] = 'First name max. length is 30 symbols';
        }
    } else {
        $feedbackContactError['firstName'] = 'First name cannot be empty';
    }

    if (strlen($lastName) !== 0) {
        if(strlen($lastName) > 30) {
            $feedbackContactError['lastName'] = 'Last name max. length is 30 symbols';
        }
    } else {
        $feedbackContactError['lastName'] = 'Last name cannot be empty';
    }

    return $feedbackContactError;
}

/**
 * Creates a new contact
 *
 * @param $firstName
 * @param $lastName
 * @param $phone
 * @return bool
 */
function addContact($phone, $firstName, $lastName)
{
    $phone = trim($phone);
    $firstName = trim($firstName);
    $lastName = trim($lastName);

    $query = 'INSERT INTO `contact`(`user_id`, `phone`, `first_name`, `last_name`) VALUES (:userId, :phone, :firstName, :lastName);';
    $params = [
        'userId' => $_SESSION['auth']['id'],
        'phone' => $phone,
        'firstName' => $firstName,
        'lastName' => $lastName
    ];

    if(empty(contactErrorList($phone, $firstName, $lastName))) {
        if(performQuery($query, $params)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Edits contact with given id
 *
 * @param $id
 * @param $phone
 * @param $firstName
 * @param $lastName
 * @return bool
 */
function editContact($id, $phone, $firstName, $lastName)
{
    $query = 'UPDATE `contact` SET `phone`= :phone,`first_name`= :firstName,`last_name`= :lastName WHERE `id`= :id;';

    $phone = trim($phone);
    $firstName = trim($firstName);
    $lastName = trim($lastName);

    $params = [
        'id' => $id,
        'phone' => $phone,
        'firstName' => $firstName,
        'lastName' => $lastName,
    ];

    if(empty(contactErrorList($phone, $firstName, $lastName))) {
        if(performQuery($query, $params)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Removes contact with given id
 *
 * @param $id
 * @return bool
 */
function removeContact($id)
{
    $query = 'DELETE FROM `contact` WHERE `id` = :id;';
    $params = ['id' => $id];

    if(performQuery($query, $params)) {
        return true;
    } else {
        return false;
    }
}
