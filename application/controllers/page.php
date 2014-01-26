<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {

	public function index()
	{
		$this->home();
	}

	public function no_permission(){
		$data = array(
			'title' => 'No Permission',
          	'main_group' => '',
          	'description' => ''
        );
		$this->load->view('includes/header', $data);
		$this->load->view('no-permission');
		$this->load->view('includes/footer');
	}

	public function home(){
		$this->load->helper('url');
		$current_page = uri_string();

		$data = array(
			'title' => 'Dashboard',
          	'main_group' => '',
          	'description' => '',
          	'current_page' => $current_page
        );
		$this->load->view('includes/header', $data);
		$this->load->view('index');
		$this->load->view('includes/footer');
	}

	public function about_us(){

		

		$data = array(
			'title' => 'About Us',
          	'main_group' => '',
          	'description' => '',
          	
        );
		$this->load->view('includes/header', $data);
		$this->load->view('about-us');
		$this->load->view('includes/footer');
	}

	public function error_404(){
		$data = array(
			'title' => '',
          	'main_group' => '',
          	'description' => ''
        );
		$this->load->view('includes/header', $data);
		$this->load->view('error-404');
		$this->load->view('includes/footer');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */