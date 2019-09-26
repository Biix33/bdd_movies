<?php
namespace DBMOVIE\Repository;
use \PDO;

class DBConnect
{
    private static $pdo;
    private static $instance;

    private static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }

    private function __construct()
    {
        if (empty(self::$pdo)){
            self::$pdo = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8", $_ENV['DB_USER'], $_ENV['DB_PASS']);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    protected static function getPDO()
    {
        self::getInstance();
        return self::$pdo;
    }
}
