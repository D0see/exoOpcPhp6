<?php

class DBManager 
{
    private static $instance;

    private $pdo;

    private function __construct() 
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public static function getInstance() : DBManager
    {
        if (!self::$instance) {
            self::$instance = new DBManager();
        }
        return self::$instance;
    }

    public function getPDO() : PDO
    {
        return $this->pdo;
    }
}