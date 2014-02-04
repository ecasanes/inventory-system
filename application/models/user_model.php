<?php

class User_Model extends MY_Model {

    const DB_TABLE = 'user';
    const DB_TABLE_PK = 'id';

    public $publication_id;
    public $publication_name;

    public function get_accounts(){

        $db_table = User_Model::DB_TABLE;
        $db_primary = User_Model::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table}";
        $query = $this->db->query($sql);

        //query_to_csv($query, TRUE, "admin.csv");
        $admin_data_results = $query->result_array();

        return $admin_data_results;
    }
	
	public function has_permission($role, $current_page){

        if($role == 'superadmin' || $current_page == ''){

            $boolean_result = false;

        }

        else if($role == '' || empty($role)){

            $sql = "SELECT count(id) as permission_count FROM ilo_pages WHERE role IS NULL AND page_uri_segment = '$current_page' AND status = 'restricted'";
            $query = $this->db->query($sql);   

            $result_count = $query->row()->permission_count;

            if($result_count > 0){
                $boolean_result = true;
            }else{
                $boolean_result = false;
            }

        }

        else{

            $sql = "SELECT count(id) as permission_count FROM ilo_pages WHERE role = '$role' AND page_uri_segment = '$current_page' AND status = 'restricted'";
            $query = $this->db->query($sql);   

            $result_count = $query->row()->permission_count;

            if($result_count > 0){
                $boolean_result = true;
            }else{
                $boolean_result = false;
            }
        }

        return $boolean_result;    
    }
	
    public function get_no_of_encoded_records($id){
        $this->db->select('count(id) as counted');
        $this->db->from('name_database');
        $this->db->where(array('admin' => $id));
        $query = $this->db->get();
        $row = $query->row();
        return $row->counted;
    }


    public function can_login($username, $password){
		
	
    	$this->db->where('username', $username);
    	$this->db->where('password', md5($password));
        //todo:md5($password)

    	$query = $this->db->get('user');

    	if($query->num_rows() == 1)
    	{
    		return true;
    	} else {
    		return false;
    	}
    }


    public function get_id_by_credentials($username, $password){
        $this->db->select('id');
        $this->db->from($this::DB_TABLE);
        $this->db->where(array('username' => $username, 'password' => $password));
        $query = $this->db->get();
        $row = $query->row();
        return $row->id;
    }

    public function get_current_role($id){
        $this->db->select('type');
        $this->db->from($this::DB_TABLE);
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $row = $query->row();
        return $row->role;
    }

    public function verify_duplicate($id, $username){
        $current_username = $this->get_current_username($id);

        if($current_username != $username){
            $this->db->select("count(User_Model::DB_TABLE) as user_count");
            $this->db->from(User_Model::DB_TABLE);
            $this->db->where(array('username' => $username));
            $query = $this->db->get();
            $row = $query->row();
            $user_count = $row->user_count;
        }else{
            $user_count = 0;
        }


        if($user_count > 0){
            return true;
        }else{
            return false;
        }
    }

    public function get_firstname($id){
        $this->db->select("firstname");
        $this->db->from(User_Model::DB_TABLE);
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $row = $query->row();
        $firstname = $row->firstname;

        return $firstname;
    }


    public function get_current_username($id){
        $this->db->select("username");
        $this->db->from(User_Model::DB_TABLE);
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $row = $query->row();
        $username = $row->username;

        return $username;
    }


    public function add($username, $password, $firstname, $lastname, $role, $date_registered){

        $db_table = User_Model::DB_TABLE;
        $db_primary = User_Model::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (id, type, username, password, firstname, lastname, date_registered) VALUES ('', '{$role}', '{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$date_registered}')";
        $query = $this->db->query($sql);

        $last_insert_id = $this->db->insert_id();

        return $last_insert_id;
    }


    public function update($id, $username, $password, $firstname, $lastname, $role){

        $db_table = User_Model::DB_TABLE;
        $db_primary = User_Model::DB_TABLE_PK;

        if($password == ''){
            $sql = "UPDATE {$db_table} SET username = '{$username}', firstname = '{$firstname}', lastname = '{$lastname}',  type = '{$role}' WHERE id = {$id}";
        }else{
            $sql = "UPDATE {$db_table} SET username = '{$username}', password = '{$password}', firstname = '{$firstname}', lastname = '{$lastname}',  type = '{$role}' WHERE id = {$id}";
        }
        
        $query = $this->db->query($sql);

        $last_insert_id = $this->db->insert_id();

        return $last_insert_id;
    }


}