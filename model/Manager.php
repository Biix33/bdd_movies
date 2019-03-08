<?php

class Dbconfig
{
    private $_host = 'localhost';
    private $_dbname = 'w_video';
    private $_username = 'root';
    private $_password = 'president';

    protected function dbConnect()
    {
        return new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';charset=utf8', '' . $this->_username . '', '' . $this->_password . '');
    }
}
