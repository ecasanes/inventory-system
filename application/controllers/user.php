<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	public function index()
	{
		$this->view_all_user();
	}





	public function edit($id, $success_flag = ''){

		$this->load->model('User_Model');
		$account = new User_Model();

		$data = array(
			'title' => 'Edit User',
          	'main_group' => '',
          	'base_url' => base_url('user'),
          	'description' => '',
          	'account' => '',
          	'success_add' => false,
          	'success_edit' => false
        );

        if($success_flag == 'success'){
			$data['success_add'] = true;
		}

		$user_data = $account->get($id);

		foreach($user_data as $user){
			$username = $user->username;
			$firstname = $user->firstname;
			$lastname = $user->lastname;
			$type = $user->type;
		}



		$model_data = array(
			'uname' => $username,
			'password' => '',
			'firstname' => $firstname,
			'lastname' => $lastname,
			'type' => $type,
			'reset' => base_url('user/edit/'.$id),
			'submit_value' => 'Update',
			'action' => base_url('user/save/edit/'.$id)
		);


		$this->load->view('includes/header', $data);
		$this->load->view('submit-user', $model_data);
		$this->load->view('includes/footer');
	}

	public function profile(){

		$id = $this->session->userdata('ilo_session_id');

		$this->edit($id);
	}


	public function check_duplicate_user($value, $action = 'add'){

		$this->load->model('User_Model');
		$account = new User_Model();

		$column_name = 'username';
		$id = $this->input->post('id');

		if($action == 'add'){
			$result = $this->check_duplicate($column_name, $value);
		}else if($action == 'edit'){
			$result = $account->verify_duplicate($id, $value);
		}
		

		if($result){
			$this->form_validation->set_message('check_duplicate_user', $value . ' is already registered. Please input another one.');
			return false;
		}else{
			return true;
		}
	}


	public function save($action = 'add', $id = false){

		$this->load->library('form_validation');
		$this->load->model('User_Model');
		$account = new User_Model();
		
		
		if($action == 'add'){
			//$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|callback_check_duplicate_user[add]');
			$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');
			//$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|md5|trim');
			$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
		}else{
			
			//$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|callback_check_duplicate_user[edit]');
			$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'md5|trim');
			//$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'md5|trim');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim');
		}
		
		

		if($this->form_validation->run())
		{

			//$id = $this->input->post('id');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$role = $this->input->post('type');

			date_default_timezone_set('Asia/Singapore');
			$datetime = strtotime(Date('Y-m-d H:i:s'));
			$date = date('Y-m-d H:i:s',$datetime);

			
			//$id = $this->account->verify_duplicate($id, $username);
			//$role = $this->account->get_current_role($id);

			
			if($action == 'add'){
				$last_insert_id = $account->add($username, $password, $firstname, $lastname, $role, $date);
				redirect('user/edit/'.$last_insert_id.'/success');
			}else{
				$account->update($id, $username, $password, $firstname, $lastname, $role);
				redirect('user/edit/'.$id.'/success');
			}
			
		}else{
			if($action == 'add'){
				$this->add();
			}else{
				$this->edit($id);
			}
			
		}
		
		

	}


	public function view_all_user(){
		$this->load->library('table');
		$this->load->library("pagination");
		$this->load->model('User_Model');

		$data = array(
			'title' => 'View All Users',
          	'main_group' => '',
          	'base_url' => base_url('user'),
          	'description' => ''
        );


		$config = array();
        $config["base_url"] = base_url('user/view-all-user');
        $config["total_rows"] = $this->User_Model->row_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '<i class="icon-double-angle-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="icon-double-angle-left"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
 
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query_accounts = array();
		$accounts = $this->User_Model->get($config["per_page"], $page);
		foreach($accounts as $account){
			$query_accounts[] = array(
				'id' => $account->id,
				'username' => $account->username,
				'firstname' => $account->firstname,
				'lastname' => $account->lastname,
				'type' => $account->type,
				'date_registered' => $account->date_registered
			);
		}

		$model_data = array(
        	'accounts' => $query_accounts
        );

        $model_data["links"] = $this->pagination->create_links();

		
		$this->load->view('includes/header', $data);
		$this->load->view('users', $model_data);
		$this->load->view('includes/footer');
	}

	public function add($success_flag = ''){

		

		$data = array(
			'title' => 'Add New User',
          	'main_group' => '',
          	'base_url' => base_url('user'),
          	'description' => '',
          	'account' => '',
          	'success_add' => false,
          	'success_edit' => false
        );

        if($success_flag == 'success'){
			$data['success_add'] = true;
		}


		$model_data = array(
			'uname' => '',
			'password' => '',
			'firstname' => '',
			'lastname' => '',
			'type' => '',
			'reset' => base_url('user/add'),
			'submit_value' => 'Add Now',
			'action' => base_url('user/save/add')
		);


		$this->load->view('includes/header', $data);
		$this->load->view('submit-user', $model_data);
		$this->load->view('includes/footer');
	}

	

	

	

	

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */