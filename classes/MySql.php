<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 2019-03-27
 * Time: 16:57
 */

//require_once '../core/init.php';

class MySql
{

    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'pvs';

    protected $connection;

    public function __construct()
    {
        if (!isset($this->connection)) {

            $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }
        }

        return $this->connection;
    }
}