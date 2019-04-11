<?php
include_once 'MySql.php';

class Crud extends MySql
{
    public function execute($id)
    {
        $query = "SELECT * FROM `replies` WHERE `task_id` = $id LIMIT 1";

        $result = $this->connection->query($query);

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            return $result;
        }
    }
}