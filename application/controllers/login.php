<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->login_view();
	}

	public function login_view(){
		$this->load->view('login');
	}

	public function validate_login()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

		if($this->form_validation->run())
		{

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->load->model('User_Model');
			$id = $this->User_Model->get_id_by_credentials($username, $password);
			$role = $this->User_Model->get_current_role($id);

			$data = array(
					'ilo_session_user' => $username,
					'is_logged_in' => '1',
					'ilo_session_id' => $id,
					'ilo_session' => $id,
					'ilo_session_role' => $role
				);

			$this->session->set_userdata($data);
			

			redirect();
		}else{
			$this->login_view();
		}

		
	}

	public function validate_credentials()
	{
		$this->load->model('User_Model');
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($this->User_Model->can_login($username, $password))
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials', 'Incorrect Username/Password');
			return false;
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}

/* End of file login.php */