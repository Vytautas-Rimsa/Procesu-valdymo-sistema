<?php
class DB{
    private static $_instance = null;
    private $_pdo, 
            $_query,
            $_error = false,
            $_result,
            $_count = 0;
    
    private function __construct(){
        try{
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $e){
            die($e->getMessage());
        }
        //$this->$conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    protected $conn;

    public function query($sql, $params = array()){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else{
                $this->_error = true;
            }
        }
        return $this;
    }
//DELETE FROM `users` WHERE `users`.`darb_id` = 109"
//action: DELETE
//table: users
//where0: `users`.`darb_id`
//1: =
//2: 109
    public function action($action, $table, $where = array()){
        if(count($where) === 3){
            $operators = array('=', '>', '<', '>=', '<=', '==', '===');

            $field      = $where[0]; // pvz vardas |
            $operator   = $where[1]; //pvz =
            $value      = $where[2]; //pvz Alex

            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()){
                    return $this;
                }
            }
        }
        return false;
    }
    
    public function get($table, $where){
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = array()){
        if(count($fields)){
            $keys = array_keys($fields);
            $values = null;
            $x = 1;

            foreach($fields as $field){
                $values .= '?';
                if($x < count($fields)){
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES({$values})";
            
            if(!$this->query($sql, $fields)->error()){
                return true;
            }
        }
        return false;
    }

    public function update($table, $id, $fields){
        $set = '';
        $x = 1;

        foreach($fields as $name => $value){
            $set .= "{$name} = ?";
            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE darb_id = {$id}";
    
        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
    }

    public function results(){
        return $this->_results;
    }

    public function first(){
        return $this->results()[0];
    }

    public function error(){
        return $this->_error;
    }

    public function count(){
        return $this->_count;
    }

    public function showUsers($action, $table){

        $sql = $action .'FROM'. $table;
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));
// Check connection
        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);
        return $result;
    }

    public function showEmployees($action, $table, $where){

        //$sql = $action .'FROM'. $table;
        $sql = "$action .'FROM'. $table";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));
// Check connection
        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function deleteUser($id){
        //DELETE FROM `users` WHERE `users`.`darb_id` = 109
        $sql = "DELETE FROM`users` WHERE `users`.`darb_id` = $id";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function searchUser($search){
        $sql = "SELECT * FROM `users` WHERE `users`.`vardas` LIKE '%$search%' OR `users`.`pavarde` LIKE '%$search%' OR `users`.`skyrius` LIKE '%$search%'
			 OR `users`.`pareigos` LIKE '%$search%'";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function getDepartmentTech($department){
        $sql="SELECT * FROM `users` WHERE `skyrius` LIKE 'Techninis skyrius'";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function getDepartmentSecurity($department){
        $sql="SELECT * FROM `users` WHERE `skyrius` LIKE 'Apsaugos skyrius'";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function getDepartmentPersonal($department){
        $sql="SELECT * FROM `users` WHERE `skyrius` LIKE 'Personalo skyrius'";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function getDepartmentFinance($department){
        $sql="SELECT * FROM `users` WHERE `skyrius` LIKE 'Finansų skyrius'";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function getDepartmentCommerce($department){
    $sql="SELECT * FROM `users` WHERE `skyrius` LIKE 'Komercijos skyrius'";

    $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

    if ($conn->connect_error) {
        return false;
        die("Prisijungti nepavyko: " . $conn->connect_error);
    }

    $result = $conn->query($sql);

    return $result;
}

    public function getDepartmentAdministration($department){
        $sql="SELECT * FROM `users` WHERE `skyrius` LIKE 'Administracija'";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function insertTask($title, $task, $createdData, $createdBy, $taskTo){
        $sql = "INSERT INTO `tasks` (`task_id`, `title`, `task`, `created_by`, `assigned_to`, `startline`, `deadline`, `finished`) VALUES (NULL, '$title', '$task', '$createdBy', '$taskTo', '$createdData[0]', '$createdData[1]', '');";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }
}