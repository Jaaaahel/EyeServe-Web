<?php

class Database
{
    protected $host = 'localhost';

    protected $username = 'root';

    protected $password = 'password';

    protected $name = 'eyeserve';

    // -----

    protected $pdo = null;

    public function __construct()
    {
        $this->pdo = new \PDO(
            "mysql:host={$this->host};dbname={$this->name};charset=utf8mb4",

            $this->username, $this->password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ]
        );
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
