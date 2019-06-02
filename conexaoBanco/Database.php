<?php

class Database
{
    /**
     * Connect with MySQL PDO
     * @return PDO
     */
    public function connect()
    {
        return new PDO('mysql:host=localhost;dbname=lanchonete', 'root', '', [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
    }
}