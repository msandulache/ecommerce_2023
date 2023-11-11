<?php

namespace App\Repository;

class Repository
{
    protected $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=' . HOST . ';dbname=' . DB_NAME, USER, PASSWORD);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        if (!$this->db) {
            throw new \Exception('Error creating a database connection ');
        }
    }
}