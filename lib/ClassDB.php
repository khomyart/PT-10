<?php

class DB {
    private static $instance = null;
    protected $connection;

    /**
     * @return DB
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static(
                'localhost',
                'p10',
                'root',
                ''
            );
        }

        return static::$instance;
    }

    /**
     * DB constructor.
     * @param $host
     * @param $db
     * @param $user
     * @param $password
     */
    private function __construct($host, $db, $user, $password)
    {
        try {
            $this->connection = new PDO("mysql:host={$host};dbname={$db}", $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Something went wrong with connection to DB');
        }
    }

    /**
     * @param $query string SQL query
     * @param $params array Array of query parameters
     * @return bool|PDOStatement
     */
    protected function performQuery($query, $params)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    /**
     * Returns all rows for a given $query
     *
     * @param $query
     * @return array
     */
    public function getAllRows($query, $params = []) {
        $statement = $this->performQuery($query, $params);

        if ($statement === false) {
            return [];
        }

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Returns a first row for a given $query
     *
     * @param $query
     * @param $params
     * @return array
     */
    public function getRow($query, $params = []) {
        $statement = $this->performQuery($query, $params);

        if ($statement === false) {
            return [];
        }

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Executes SQL query (e.g. INSERT, DELETE, UPDATE)
     *
     * @param $query
     * @param $params
     * @return bool|int
     */
    public function execQuery($query, $params) {
        $statement = $this->performQuery($query, $params);

        return $statement === false ? false : $statement->rowCount();
    }
}
