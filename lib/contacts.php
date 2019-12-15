<?php

/**
 * Returns list\array of contacts
 *
 * @param $filter
 * @return array
 */
function getListOfContacts($filter = '') {
    $query = 'SELECT * FROM `contact` WHERE 1 ';
    $params = [];

    if (is_string($filter) && (trim($filter) != '')) {
        $query .= ' AND ( (`first_name` LIKE :filter) OR (`last_name` LIKE :filter) OR (`phone` LIKE :filter) )';
        $params['filter'] = '%' . $filter . '%';
    }

    return getAllRows($query, $params);
}

/**
 * Creates a new contact
 *
 * @param $firstName
 * @param $lastName
 * @param $phone
 * @return bool
 */
function addContact($firstName, $lastName, $phone) {
    //TODO: Finish me
    return true;
}
