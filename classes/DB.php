<?php
class DB{
    private static $_instance = null;
    private $_pdo, 
            $_query,
            $_error = false,
            $_result,
            $_count = 0;
    
    public function __construct(){
        try{
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $e){
            die($e->getMessage());
        }
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
        //;

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
        $sql = "DELETE FROM`users` WHERE `users`.`darb_id` = $id";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function deleteTask($id){
        $sql = "DELETE FROM`tasks` WHERE `tasks`.`task_id` = $id";
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

    public function searchTaskFromAll($search){
        $sql = "SELECT * FROM `tasks` WHERE `tasks`.`title` LIKE '%$search%' OR `tasks`.`task` LIKE '%$search%'";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function searchTaskFromActive($search){
        $sql = "SELECT * FROM `tasks` WHERE `task` LIKE '%".$search.'%\' OR `tasks`.`task` LIKE \'%'.$search.'%\' AND `assigned_to` = '.$_SESSION['user'].' ORDER BY `assigned_to` DESC';
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function searchMyCreatedTasks($search){
        $sql = "SELECT * FROM `tasks` WHERE `tasks`.`title` LIKE '%".$search.'%\' OR `tasks`.`task` LIKE \'%'.$search.'%\' AND `tasks`.`created_by` = '.$_SESSION['user'].' ORDER BY `tasks`.`finished` DESC';
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function getDepartmentEmployee($department){
        $sql="SELECT * FROM `users` WHERE `skyrius` LIKE '$department'";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function uzduotiesPeradresavimas(int $uzd_id, int $darb_id, int $sender_id, string $taskComment){
        $sql="UPDATE `tasks` SET `assigned_to` = '$darb_id' WHERE `tasks`.`task_id` = $uzd_id;";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        try{
            if ($conn->connect_error) {
                return false;
                throw new Exception($conn->connect_error);
            }
            $result = $conn->query($sql);
            $this->insertComment($uzd_id, $sender_id, $taskComment);
        } catch (Exception $e) {
            die("Prisijungti nepavyko: $e");
        }
        finally{
            return $result;
        }
    }

    public function getAllDepartments(){
        $sql="SELECT * FROM `department`";

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

    public function getAllTasks(){
        $sql="SELECT * FROM `tasks`";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function getUserActiveTasks(int $id){
        $sql="SELECT * FROM `tasks` WHERE `assigned_to` LIKE '".$id."'";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

    public function getUserCreatedTasks(int $id){
        $sql="SELECT * FROM `tasks` WHERE `created_by` LIKE '".$id."'";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        return $result;
    }

//    public function countUserCreatedTasks(){
//        $sql="SELECT `created_by`, count(*) as number FROM `tasks` WHERE `created_by` LIKE '".$_SESSION['user']."'";
//
//        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));
//
//        if ($conn->connect_error) {
//            return false;
//            die("Prisijungti nepavyko: " . $conn->connect_error);
//        }
//
//        $result = $conn->query($sql);
//
//        return $result;
//    }

    public static function showResults($id)
    {
        $sql = "SELECT * FROM `replies` WHERE `task_id` = $id";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        //echo $result['reply'];

        return $result;
    }

    public function getUserData($id){
        $sql = "SELECT * FROM `users` WHERE `darb_id` = $id";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }

        $result = $conn->query($sql);
        return $result;
    }

    public function updateTask($taskId, $comment, $userId){

        if ($taskId == "" or $taskId == null and $comment == "" or $comment == null){
            die;
        }else{
            $sql = "UPDATE `tasks` SET `finished` = '".date('Y-m-d H:i:s')."'WHERE `tasks`.`task_id` = ".$taskId.";";
            $sql2 = " INSERT INTO `replies` (`r_id`, `reply`, `task_id`, `reply_by`, `date_time`) VALUES (NULL, '".$comment."', '".$taskId."', '".$userId."', CURRENT_TIMESTAMP);";
            $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

            if ($conn->connect_error) {
                return false;
                die("Prisijungti nepavyko: " . $conn->connect_error);
            }

            $result = $conn->query($sql);
            $result = $conn->query($sql2);

            return $result;
        }
    }

    public function insertComment(int $uzd_id, int $sender_id, string $taskComment){
        $sql="INSERT INTO `replies` (`r_id`, `reply`, `task_id`, `reply_by`, `date_time`) VALUES (NULL, '".$taskComment."', '".$uzd_id."', '".$sender_id."', CURRENT_TIMESTAMP);";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        try{
            if ($conn->connect_error) {
                return false;
                throw new Exception($conn->connect_error);
            }
            $result = $conn->query($sql);
        } catch (Exception $e) {
            die("Prisijungti nepavyko: $e");
        }
        finally{
            return $result;
        }
    }

    private function mysql(string $query){

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        try{
            if ($conn->connect_error) {
                return false;
                throw new Exception($conn->connect_error);
            }
            $result = $conn->query($query);
        } catch (Exception $e) {
            die("Prisijungti nepavyko: $e");
        }
        finally{
            return $result;
        }
    }

    public static function showTasksByDate(string $start, string $end, int $userId){
        $sql = "SELECT * FROM `tasks` WHERE `startline` BETWEEN '".$start."' AND '".$end."' AND `assigned_to` LIKE '".$userId."' ORDER BY `assigned_to` ASC";
        //return (new self)->mysql($sql);

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function atliktuUzduociuSkaicius(string $start, string $end, int $userId){

        $sql = "SELECT * FROM `tasks` WHERE `assigned_to` = ".$userId." AND `finished` BETWEEN '".$start."' AND '".$end."' ORDER BY `assigned_to` DESC";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function showTasksByDateCreatedBy(string $start, string $end, int $userId){
        $sql = "SELECT * FROM `tasks` WHERE `startline` BETWEEN '".$start."' AND '".$end."'AND `created_by` LIKE '".$userId."' ORDER BY `created_by` ASC";
        //return (new self)->mysql($sql);

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function pradelstosUzduotys(string $start, string $end, int $userId){
        $sql = "SELECT * FROM `tasks` WHERE `assigned_to` = ".$userId." AND `deadline` BETWEEN '".$start."' AND '".$end."' ORDER BY `assigned_to` DESC";
        //return (new self)->mysql($sql);

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function userDetails($userId){
        $sql = "SELECT * FROM `users` WHERE `darb_id` = ".$userId." ORDER BY `pavarde` DESC";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public static function getDepartmenEmployees($departmentId){
        $sql = "SELECT * FROM `users` WHERE `skyrius_id` = ".$departmentId." ORDER BY `pavarde` DESC";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function getDepartmentActiveTasksList(array $arr){
        $sql = "SELECT * FROM `tasks` WHERE `assigned_to` = ".$arr[0]." ";

        for($i =1; $i < count($arr);$i++){
            $sql = $sql."OR `assigned_to` = ".$arr[$i]." ";
        }

        $sql = $sql."ORDER BY `assigned_to` DESC";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function getClientTypeList(){
        $sql = "SELECT * FROM `clienttypes`";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);

        return $result;
    }

    public static function getCityList(){
        $sql = "SELECT * FROM `city`";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);

        return $result;
    }

    public static function getStreetsList(){
        $sql = "SELECT * FROM `addresses`";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);

        return $result;
    }

    public static function saveClientData(int $type, String $title, String $email, String $phone, String $code, String $contract_code, String $city, String $street, String $file, String $house_nr, String $vat, int $contract_status){

        $sql = "INSERT INTO `clients` (`client_id`, `client_type_id`, `title`, `email`, `phone`, `city_id`, `street_id`, `house_nb`, `identification_code`, `vat`, `time`) VALUES (NULL, '$type', '$title', '$email', '$phone', '$city', '$street', '$house_nr', '$code', '$vat', CURRENT_TIMESTAMP);";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        $sql2 ="INSERT INTO `contracts` (`contract_id`, `status_id`, `contract_code`, `file_path`, `time`) VALUES (NULL, '$contract_status', '$contract_code', '$file', CURRENT_TIMESTAMP);";



        try {
            if ($conn->connect_error) {throw new Exception('Nepavyko prisijungti prie DB');}

            //ivykde uzklausa pasiimame eiluciu duomenis
            if ($conn->query($sql) === TRUE){

                $client_id = $conn->insert_id;
                if($conn->query($sql2) === TRUE){
                    $contract_id = $conn->insert_id;

                    $sql3 ="INSERT INTO `clientcontracts` (`clientContracts_id`, `client_id`, `contract_id`, `time`) VALUES (NULL, '".$client_id."', '".$contract_id."', CURRENT_TIMESTAMP);";

                    $conn->query($sql3);
                }

            }

        } catch (Exception $e) {
            $result = die($e->getMessage());
        }

        return 'OK';
    }
    public static function getContractList(){

        $sql = "SELECT * FROM `clientcontracts`";

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        try {
            if ($conn->connect_error) {throw new Exception('Nepavyko prisijungti prie DB');}
//WHILE ideti...

            $pivotTableMasyvasResult = $conn->query($sql);
            $array = [];
            $i = 0;

            while($pivotTableMasyvas = $pivotTableMasyvasResult->fetch_assoc()){

                //isitrauksime paiseme to pivot table klinto ID kliento lenteles to iraso info
                $client_sql = "SELECT * FROM `clients` WHERE `client_id` = ".$pivotTableMasyvas['client_id'];
                    if ($client_arr = $conn->query($client_sql)) {
                        $contract_data = $client_arr->fetch_assoc();

                        $array[$i]['client'] = $contract_data;
                    }
                //isitrauksime paiseme to pivot table klinto ID contract lenteles to iraso info

                $contract_sql = "SELECT * FROM `contracts` WHERE `contract_id` = ".$pivotTableMasyvas['contract_id'];
                    if ($contract_arr = $conn->query($contract_sql)) {
                        $contract_data = $contract_arr->fetch_assoc();

                        $array[$i]['contract'] = $contract_data;
                    }

                $i++;
            }
            return $array;

        } catch (Exception $e) {
            $result = die($e->getMessage());
        }
    }

    public static function getCityName(int $cityId){
        $sql = "SELECT * FROM `city` WHERE `city_id` = $cityId";
        //return (new self)->mysql($sql);

        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function getClientTypeName(int $clientTypeId){
        $sql = "SELECT * FROM `clienttypes` WHERE `type_id` = $clientTypeId";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function getStreetName(int $streetId){
        $sql = "SELECT * FROM `addresses` WHERE `address_id` = $streetId";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function getContractInfo(int $contractId){
        $sql = "SELECT * FROM `contracts` WHERE `contract_id` = $contractId";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }

    public static function deleteContract(int $contractId){
        $sql = "START TRANSACTION;

        DELETE FROM `clientcontracts` WHERE `clientcontracts`.`contract_id` = $contractId;
        
        DELETE FROM `contracts` WHERE `contracts`.`contract_id` = $contractId;
        
        COMMIT;";
        $conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

        if ($conn->connect_error) {
            return false;
            die("Prisijungti nepavyko: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        return $result;
    }
}