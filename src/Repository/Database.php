<?php
namespace DBMOVIE\Repository;
use \PDO;

class Database
{
    private $_host;
    private $_dbname;
    private $_username;
    private $_password;
    private static $pdo;
    private static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        }
        return self::$instance;
    }

    private function __construct($host, $name, $user, $password)
    {
        $this->_host = $host;
        $this->_dbname = $name;
        $this->_username = $user;
        $this->_password = $password;
        self::$pdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';charset=utf8', '' . $this->_username . '', '' . $this->_password . '');
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected static function getPDO()
    {
        self::getInstance();
        return self::$pdo;
    }
}
