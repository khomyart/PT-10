<?php

class Contact
{
    public function getList($filter = '') {
        $query = 'SELECT * FROM `contact` WHERE 1 ';
        $params = [];

        if (is_string($filter) && (trim($filter) != '')) {
            $query .= ' AND ( (`first_name` LIKE :filter) OR (`last_name` LIKE :filter) OR (`phone` LIKE :filter) )';
            $params['filter'] = '%' . $filter . '%';
        }

        return DB::getInstance()->getAllRows($query, $params);
    }

    public function addContact($firstName, $lastName, $phone) {
        //TODO: Finish me
        return true;
    }
}
