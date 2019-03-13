<?php
class User{
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;

    public function __construct($user = null){
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);
                
                if($this->find($user)){
                    $this->_isLoggedIn = true;
                } else{

                }
            }
        } else{
            $this->find($user);
        }
    }

    public function update($fields = array(), $id = null){
        if(!$id && $this->isLoggedIn()){
            $id = $this->data()->darb_id;
        }

        if(!$this->_db->update('users', $id, $fields)){
            throw new Exception ('Nepavyko atnaujinti informacijos');
        }
    }

    public function create($fields = array()){
        if(!$this->_db->insert('users', $fields)){
            throw new Exception("Nepavyko sukurti naujo darbuotojo paskyros");
        }
    }

    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'darb_id' : 'elpastas';
            $data = $this->_db->get('users', array($field, '=', $user));

            if($data->count()){
                $this->_data = $data->first();
                return true;
            }            
        }
        return false;
    }

    public function login($elpastas = null, $slaptazodis = null, $remember = false){
        
        if(!$elpastas && !$slaptazodis && $this->exists()){
            Session::put($this->_sessionName, $this->data()->darb_id);
        } else{
            $user = $this->find($elpastas);
            if($user){
                if($this->data()->slaptazodis === Hash::make($slaptazodis, $this->data()->salt)){
                    Session::put($this->_sessionName, $this->data()->darb_id);
                    if($remember){
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('users_session', array('darbuotojo_id', '=', $this->data()->darb_id));//GAL CIA BUS NE ID
                        
                        if(!$hashCheck->count()){
                            $this->_db->insert('users_session', array(
                                'darbuotojo_id' => $this->data()->darb_id,
                                'hash' => $hash
                            ));
                        } else{
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }            
        }
        return false;
    }

    public function hasPermission($key){
        $group = $this->_db->get('groups', array('id', '=', $this->data()->role));

        if($group->count()){
            $permissions = json_decode($group->first()->leidimas, true);

            if($permissions[$key] == true){
                return true;
            }
        }
        return false;
    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    public function logout(){
        $this->_db->delete('users_session', array('darbuotojo_id', '=', $this->data()->darb_id));
        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }

    public function showUsers(){
        return $data = $this->_db->showUsers('SELECT *', '`users`');
    }

    public function deleteUsers($id) {
        return $data = $this->_db->delete('users', array('darbuotojo_id', '=', $this->data()->darb_id));
//
//        $sql = 'DELETE FROM users WHERE darb_id = :darb_id';
//
//        $q = $this->_pdo->prepare($sql);
//
//        return $q->execute([':darb_id' => $id]);
    }
}